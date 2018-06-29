<?php

require_once('dbLoad.php');
require_once('support.php');

$db = connect();

$query = "SELECT * FROM topic";
$res = $db->query($query);

$topics = array();

 while ($row = $res->fetch_assoc()) {
     $topics[] = $row;
 }

echo json_encode($topics);


?>
