<?php
require_once('dbLoad.php');
require_once('support.php');

$title = trim($_POST['title']);
$topic = trim($_POST['topic']);
$date = trim($_POST['date']);
$speaker = trim($_POST['speaker']);
$building = trim($_POST['building']);
$room = trim($_POST['room']);
$event_id = ($_POST['event_id']);
$date = date_create($date);
$date = date_format($date, "Y-m-d");
echo($date);


$db = connect();





/*topic_id*/
$query = "SELECT topic_id FROM topic WHERE topic_name=\"$topic\"";
$res = $db->query($query);
$row = $res->fetch_assoc();
$topic_id = $row["topic_id"];

/*speaker_id*/
$query = "SELECT speaker_id FROM ref_speaker WHERE speaker_name=\"$speaker\"";
$res = $db->query($query);
$row = $res->fetch_assoc();
$speaker_id = $row["speaker_id"];

/*building_id*/
$query = "SELECT building_id FROM ref_building WHERE building_name=\"$building\"";
$res = $db->query($query);
$row = $res->fetch_assoc();
$building_id = $row["building_id"];

/*room_id*/
$query = "SELECT room_id FROM ref_room WHERE room_name=\"$room\"";
$res = $db->query($query);
$row = $res->fetch_assoc();
$room_id = $row["room_id"];

$stmt = $db->prepare("UPDATE events SET title = ?, topic_id= ?, speaker = ?, building = ?, room = ?, event_date = ? WHERE event_id = ?");
$stmt->bind_param("siiiisi", $title, $topic_id, $speaker_id, $building_id, $room_id, $date, $event_id);
$stmt->execute();
$stmt->close();
$db->close();



?>
