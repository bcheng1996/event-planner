<?php
require_once('dbLoad.php');
require_once('support.php');

$db = connect();
$page = "";
$query = "SELECT * FROM vw_events";

$res = $db->query($query);

 while ($row = $res->fetch_assoc()) {
     $page .= "<tr>" . "<th>" . $row['event_id'] . "</th> <th>" . $row['title'] . "</th> <th>" . $row['topic_name'] . "</th> <th>" .
$row['topic_description'] . "</th> <th>" . $row['event_date'] . "</th> <th>" . $row['speaker_name'] . "</th> <th>" .
$row['building_name'] . "</th> <th>" . $row['room_name'] . "</th>". "</tr>";
 }

echo($page);
