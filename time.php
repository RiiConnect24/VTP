<?php
if(isset($_SERVER['HTTP_USER_AGENT'])){ // if not the Wii
    die("Hi! You're not a Wii.");
}
date_default_timezone_set('GMT');
header("Last-Modified: " . gmdate('D, d M Y H:i:s T'));
header("Connection: keep-alive");
?>
