<?php
global $db;

// MySQL code for connecting to the database
function connectMySQL()
{
    global $db;

    if (!$db) {
        $db = new mysqli('127.0.0.1', 'USERNAME', 'PASS', 'DATABASE');
    }
    return $db;
}

$sentryurl = "SETME";
?>
