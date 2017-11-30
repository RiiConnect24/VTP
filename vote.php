<?php
require "config/config.php";
require "lib/snowflake.php";

$typeCD = $_GET['typeCD'];
$questionID = $_GET['questionID'];
$wiiNo = $_GET['wiiNo'];
$countryID = $_GET['countryID'];
$regionID = $_GET['regionID'];
$ansCNT = $_GET['ansCNT'];

$db = connectMySQL();

$stmt = $db->prepare('INSERT INTO `votes` (`uuid`,
  `typeCD`,
  `questionID`,
  `wiiNo`,
  `countryID`,
  `regionID`,
  `ansCNT`
) VALUES (?, ?, ?, ?, ?, ?, ?)');

$stmt->bind_param('iiiiiis', utc2snowflake(time()), $typeCD, $questionID, $wiiNo, $countryID, $regionID, $ansCNT);

if (!$stmt->execute())
	error_log('DATABASE ERROR ON vote - ' . $stmt->error);

echo("100");
?>
