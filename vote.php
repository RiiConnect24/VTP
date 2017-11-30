<?php
include "config/config.php";

$typeCD = $_GET['typeCD'];
$questionID = $_GET['questionID'];
$wiiNo = $_GET['wiiNo'];
$countryID = $_GET['countryID'];
$regionID = $_GET['regionID'];
$ansCNT = $_GET['ansCNT'];

$db = connectMySQL();

$stmt = $db->prepare('INSERT INTO `votes` (`typeCD`,
  `questionID`,
  `wiiNo`,
  `countryID`,
  `regionID`,
  `ansCNT`
) VALUES (?, ?, ?, ?, ?, ?)');

$stmt->bind_param('iiiiis', $typeCD, $questionID, $wiiNo, $countryID, $regionID, $ansCNT);

if (!$stmt->execute())
	error_log('DATABASE ERROR ON vote - ' . $stmt->error);
echo("100");
?>
