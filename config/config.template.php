<?php
/*
 * Example configuration. Modify these parameters.
 */

global $db;

function connectMySQL() {
    global $db;

    if (!$db)
        $db = new mysqli('127.0.0.1', 'USERNAME', 'PASS', 'DATABASE');
    
    return $db;
}

$sentryurl = "SETME";
