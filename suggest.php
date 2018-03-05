<?php

if (isset($_SERVER['HTTP_USER_AGENT'])) // EVC does not have a UA
    die();

$wiiNo = $_POST['wiiNo'];
$countryID = $_POST['countryID'];
$regionID = $_POST['regionID'];
$langCD = $_POST['langCD'];
$content = $_POST['content'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];

if (!(
    isset($wiiNo) &&
    isset($countryID) &&
    isset($regionID) &&
    isset($langCD) &&
    isset($content) &&
    isset($choice1) &&
    isset($choice2) &&
    is_numeric($wiiNo) &&
    is_numeric($countryID) &&
    is_numeric($regionID) &&
    is_numeric($langCD) &&
    strlen($wiiNo) == 16 &&
    in_array(intval($countryID), [1, 10, 16, 18, 20, 21, 22, 25, 30, 36, 40, 42, 49, 52, 65, 66, 67, 74, 76, 77, 78, 79, 82, 83, 88, 94, 95, 96, 98, 105, 107, 108, 110])
)) {
    error_log("Request failed checks on vote: GET data: " . json_encode($_GET) . " Request: " . json_encode($_SERVER));
    die(500);
}

require "config/config.php";
require "lib/snowflake.php";
require_once "vendor/autoload.php";

// Setup sentry.io error logging
(new Raven_Client($sentryurl))->install();

$uuid = abs((new SnowFlake(1, 1))->generateID());

$conn = connectMySQL();

use DataDog\DogStatsd;

$statsd = new DogStatsd();

if ($stmt = $conn->prepare('INSERT INTO `suggestions` (
    `uuid`,
    `wiiNo`,
    `countryID`,
    `regionID`,
    `langCD`,
    `content`,
    `choice1`,
    `choice2`
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
    $stmt->bind_param('iiiiisss', $uuid, $wiiNo, $countryID, $regionID, $langCD, $content, $choice1, $choice2);
    $statsd->increment("votes.total_suggestions");
    if ($stmt->execute()) {
        echo(100);
    } else {
        error_log("SQL statement error on vote: " . $stmt->error);
        echo(500);
    }
    $stmt->close();
} else {
    error_log("SQL statement preparation error: " . $conn->error);
    echo(500);
}

$conn->close();
