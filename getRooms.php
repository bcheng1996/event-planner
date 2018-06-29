<?php

require_once('dbLoad.php');
require_once('support.php');

$db = connect();

/*getting building id*/
$query = "SELECT * FROM ref_building WHERE building_name=\"{$_GET["building"]}\"";
$res = $db->query($query);

$row = $res->fetch_assoc();
$building_id = $row["building_id"];


$query = "SELECT * FROM xref_building_room WHERE building_id=$building_id";
$res = $db->query($query);

$room_ids = array();

 while ($row = $res->fetch_assoc()) {
     $room_ids[] = $row["room_id"];
 }

$query = "SELECT * FROM ref_room WHERE room_id=";
for($x = 0; $x < sizeof($room_ids)-1; $x++){
    $query .= $room_ids[$x] . " OR room_id= ";
}

$query .= $room_ids[$x];
$res = $db->query($query);

$rooms = array();
while ($row = $res->fetch_assoc()) {
    $room[] = $row;
}
$db->close();
echo json_encode($room);


?>
