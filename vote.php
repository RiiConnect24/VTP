<?php

if (isset($_SERVER['HTTP_USER_AGENT'])) // if not the Wii
    die("Hi! You're not a Wii.");

if (empty($_GET))
    die("Stop hitting our server without actual vote data. Thanks!");

require "config/config.php";
require "lib/snowflake.php";
require_once 'vendor/autoload.php';

$client = (new Raven_Client($sentryurl))->install();

$typeCD = $_GET['typeCD'];
$questionID = $_GET['questionID'];
$wiiNo = $_GET['wiiNo'];
$countryID = $_GET['countryID'];
$regionID = $_GET['regionID'];
$ansCNT = $_GET['ansCNT'];

$sf = new SnowFlake(1,1);
$uuid = abs($sf->generateID());

$db = connectMySQL();

$stmt = $db->prepare('INSERT INTO `votes` (`uuid`,
    `typeCD`,
    `questionID`,
    `wiiNo`,
    `countryID`,
    `regionID`,
    `ansCNT`
) VALUES (?, ?, ?, ?, ?, ?, ?)');

$stmt->bind_param('iiiiiii', $uuid, $typeCD, $questionID, $wiiNo, $countryID, $regionID, $ansCNT);

if (!$stmt->execute()) {
    error_log('DATABASE ERROR ON vote - ' . $stmt->error);
    die(500);
}

echo(100);
