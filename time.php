<?php

if (isset($_SERVER['HTTP_USER_AGENT'])) // if not the Wii
    die();

date_default_timezone_set('GMT');
header("Last-Modified: " . gmdate('D, d M Y H:i:s T'));

require_once "vendor/autoload.php";

use DataDog\DogStatsd;

$statsd = new DogStatsd();

$statsd->increment("votes.total_time_syncs");
