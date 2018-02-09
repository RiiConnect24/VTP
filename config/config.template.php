<?php
/*
 * Example configuration. Modify these parameters.
 */

function connectMySQL() {
    $conn = new mysqli('127.0.0.1', 'USERNAME', 'PASS', 'DATABASE');

    if ($conn->connect_error) {
        error_log("MySQL connection error: " . $conn->connect_error);
        die();
    }

    return $conn;
}

$sentryurl = "SETME";
