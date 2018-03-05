<?php

if (isset($_SERVER['HTTP_USER_AGENT'])) // EVC does not have a UA
    die();

$typeCD = $_GET['typeCD'];
$questionID = $_GET['questionID'];
$wiiNo = $_GET['wiiNo'];
$countryID = $_GET['countryID'];
$regionID = $_GET['regionID'];
$ansCNT = $_GET['ansCNT'];

// This still won't check the addition to the duplicate key but will help
function validAns(string $ans) : bool {
    $sum = 0;
    foreach (str_split($ans) as $x)
        $sum += intval($x);
    return $sum > 0 && $sum < 7;
}

if (!(
    isset($typeCD) &&
    isset($questionID) &&
    isset($wiiNo) &&
    isset($countryID) &&
    isset($regionID) &&
    isset($ansCNT) &&
    is_numeric($typeCD) &&
    is_numeric($questionID) &&
    is_numeric($wiiNo) &&
    is_numeric($countryID) &&
    is_numeric($regionID) &&
    is_numeric($ansCNT) &&
    strlen($wiiNo) == 16 &&
    strlen($ansCNT) == 4 &&
    in_array(intval($countryID), [1, 10, 16, 18, 20, 21, 22, 25, 30, 36, 40, 42, 49, 52, 65, 66, 67, 74, 76, 77, 78, 79, 82, 83, 88, 94, 95, 96, 98, 105, 107, 108, 110]) &&
    in_array(intval($typeCD), [0, 1]) && // PriceychecksRus
    validAns($ansCNT)
    // TODO Better checks on questionID, wiiNo, regionID
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

if ($stmt = $conn->prepare('INSERT INTO `votes` (
    `uuid`,
    `typeCD`,
    `questionID`,
    `wiiNo`,
    `countryID`,
    `regionID`,
    `ansCNT`
) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `ansCNT` = `ansCNT` + VALUES(`ansCNT`)')) {
    $stmt->bind_param('iiiiiii', $uuid, $typeCD, $questionID, $wiiNo, $countryID, $regionID, $ansCNT);
    DataDogStatsD::increment("votes.total_votes");
    if ($stmt->execute())
        echo(100);
    else {
        error_log("SQL statement error on vote: " . $stmt->error);
        echo(500);
    }
    $stmt->close();
} else {
    error_log("SQL statement preparation error: " . $conn->error);
    echo(500);
}

$conn->close();
