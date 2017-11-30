<?php
require "config/config.php";
require "lib/snowflake.php";

$wiiNo = $_POST['wiiNo'];
$countryID = $_POST['countryID'];
$regionID = $_POST['regionID'];
$langCD = $_POST['langCD'];
$content = $_POST['content'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];

$sf = new SnowFlake(1,1);
$uuid = $sf->generateID();

$db = connectMySQL();

$stmt = $db->prepare('INSERT INTO `suggestions` (`uuid`,
  `wiiNo`,
  `countryID`,
  `regionID`,
  `langCD`,
  `content`,
  `choice1`,
  `choice2`
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

$stmt->bind_param('iiiiisss', $uuid, $wiiNo, $countryID, $regionID, $langCD, $content, $choice1, $choice2);

if (!$stmt->execute())
	error_log('DATABASE ERROR ON suggest - ' . $stmt->error);
	die();

echo("100");
?>
