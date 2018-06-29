<?php

require_once('dbLoad.php');
require_once('support.php');

$db = connect();

$query = "SELECT * FROM ref_building";
$res = $db->query($query);

$buildings = array();

 while ($row = $res->fetch_assoc()) {
     $buildings[] = $row;
 }

echo json_encode($buildings);


?>
