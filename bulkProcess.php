<?php
require_once('dbLoad.php');
require_once('support.php');

$fromCat = $_POST['fromCategory'];
$toCat = $_POST['toCategory'];
$to = $_POST['changeTo'];
$from = $_POST['changeFrom'];
$fromBuilding = false;
$toBuilding = false;
$toCol="";
$toType="";
$fromCol="";
$fromType="";
print_r($_POST);

$db = connect();

$query = "";


/*to*/

if($toCat == 'Topic'){
    $toCol = "topic_id = ?";
    $toType = "i";
    $toQuery = "SELECT topic_id FROM topic WHERE topic_name=\"$to\"";
    $toRes = $db->query($toQuery);
    $toRow = $toRes->fetch_assoc();
    $to_id = $toRow["topic_id"];
}

if($toCat == 'Date'){
    $toCol = "event_date = ?";
    $toType = "s";
    $date = date_create($to);
    $date = date_format($date, "Y-m-d");
    $to_id = $date;
}

if($toCat == 'Title'){
    $toCol = "title = ?";
    $toType = "s";
    $to_id = $to;
}

if($toCat == 'Speaker'){
    $toCol = "speaker = ?";
    $toType = "i";
    $toQuery = "SELECT speaker_id FROM ref_speaker WHERE speaker_name=\"$to\"";
    $toRes = $db->query($toQuery);
    $toRow = $toRes->fetch_assoc();
    $to_id = $toRow["speaker_id"];
}

if($toCat == 'Building/Room'){
    $toBuilding = true;
    $toCol = "building = ?, room = ?";
    $toType = "ii";
    $building = explode(',',$to)[0];
    $room = explode(',',$to)[1];


    $toQuery = "SELECT building_id FROM ref_building WHERE building_name=\"$building\"";
    $toRes = $db->query($toQuery);
    $toRow = $toRes->fetch_assoc();
    $to_building_id = $toRow["building_id"];

    $toQuery = "SELECT room_id FROM ref_room WHERE room_name=\"$room\"";
    $toRes = $db->query($toQuery);
    $toRow = $toRes->fetch_assoc();
    $to_room_id = $toRow["room_id"];
}

/*from*/
if($fromCat == 'Topic'){
    $fromCol = "topic_id = ?";
    $fromType = "i";
    $fromQuery = "SELECT topic_id FROM topic WHERE topic_name=\"$from\"";
    $fromRes = $db->query($fromQuery);
    $fromRow = $fromRes->fetch_assoc();
    $from_id = $fromRow["topic_id"];
}

if($fromCat == 'Date'){
    $fromCol = "event_date = ?";
    $fromType = "s";
    $date = date_create($from);
    $date = date_format($date, "Y-m-d");
    $from_id = $date;
}

if($fromCat == 'Title'){
    $fromCol = "title = ?";
    $fromType = "s";
    $from_id = $from;
}

if($fromCat == 'Speaker'){
    $fromCol = "speaker = ?";
    $fromType = "i";
    $fromQuery = "SELECT speaker_id FROM ref_speaker WHERE speaker_name=\"$from\"";
    $fromRes = $db->query($fromQuery);
    $fromRow = $fromRes->fetch_assoc();
    $from_id = $fromRow["speaker_id"];
}

if($fromCat == 'Building/Room'){
    $fromBuilding = true;
    $fromCol = "building = ? AND room = ?";
    $fromType = "ii";
    $building = explode(',',$from)[0];
    $room = explode(',',$from)[1];

    $fromQuery = "SELECT building_id FROM ref_building WHERE building_name=\"$building\"";
    $fromRes = $db->query($fromQuery);
    $fromRow = $fromRes->fetch_assoc();
    $from_building_id = $fromRow["building_id"];

    $fromQuery = "SELECT room_id FROM ref_room WHERE room_name=\"$room\"";
    $fromRes = $db->query($fromQuery);
    $fromRow = $fromRes->fetch_assoc();
    $from_room_id = $fromRow["room_id"];
}


 $stmt = $db->prepare("UPDATE events SET $toCol WHERE $fromCol");

 if(!$fromBuilding && !$toBuilding){
     $stmt->bind_param($toType.$fromType, $to_id, $from_id);
 }
 if($fromBuilding && !$toBuilding){
     $stmt->bind_param($toType.$fromType, $to_id, $from_building_id, $from_room_id);
 }

 if(!$fromBuilding && $toBuilding){
     $stmt->bind_param($toType.$fromType, $to_building_id, $to_room_id, $from_id);
 }

 if($fromBuilding && $toBuilding){
     $stmt->bind_param($toType.$fromType, $to_building_id, $to_room_id, $from_building_id, $from_room_id);
 }


 $stmt->execute();
 $stmt->close();
 $db->close();




?>
