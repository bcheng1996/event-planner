<?php

require_once('dbLoad.php');
require_once('support.php');

$db = connect();

$query = "SELECT * FROM ref_speaker";
$res = $db->query($query);

$speakers = array();

 while ($row = $res->fetch_assoc()) {
     $speakers[] = $row;
 }

echo json_encode($speakers);


?>
