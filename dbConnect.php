<?php
    function connect(){
        $host = "localhost";
        $user = "dbuser";
        $password = "goodbyeWorld";
        $database = "challenge_db";
        $db_connection = new mysqli($host, $user, $password, $database);
        return $db_connection;
    }


?>
