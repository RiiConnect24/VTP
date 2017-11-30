<?php
include "config/config.php";

$wiiNo = $_POST['wiiNo'];
$countryID = $_POST['countryID'];
$regionID = $_POST['regionID'];
$langCD = $_POST['langCD'];
$content = $_POST['content'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];

$db = connectMySQL();

$stmt = $db->prepare('INSERT INTO `suggestions` (`wiiNo`,
  `countryID`,
  `regionID`,
  `langCD`,
  `content`,
  `choice1`,
  `choice2`
) VALUES (?, ?, ?, ?, ?, ?, ?)');

$stmt->bind_param('iiiisss', $wiiNo, $countryID, $regionID, $langCD, $content, $choice1, $choice2);

if (!$stmt->execute())
	error_log('DATABASE ERROR ON suggest - ' . $stmt->error);

echo("100");
?>
