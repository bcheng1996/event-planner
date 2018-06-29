<?php
require_once("dbConnect.php");

function load()
{
    $host = "localhost";
    $user = "dbuser";
    $password = "goodbyeWorld";
    $db = new mysqli($host, $user, $password);


    $sql = file_get_contents('db_scripts/create_database.sql');
    $res = $db->query($sql);
    $sql = file_get_contents('db_scripts/events.sql')  ;

    $sql .= file_get_contents('db_scripts/ref_building.sql')  ;
    $sql .= file_get_contents('db_scripts/ref_speaker.sql')  ;
    // $res = $db->query($sql);
    $sql .= file_get_contents('db_scripts/ref_room.sql')  ;
    // $res = $db->query($sql);
    $sql .= file_get_contents('db_scripts/topic.sql')  ;
    // $res = $db->query($sql);

    // $res = $db->query($sql);
    $sql .= file_get_contents('db_scripts/xref_building_room.sql') ;
    $sql .= file_get_contents('db_scripts/vw_events.sql')  ;
    $res = $db->multi_query($sql);

    return $res;
}
