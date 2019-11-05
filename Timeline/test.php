<?php
error_reporting(0);
//Audio File information library
require_once('getid3/getid3.php');

$getID3 = new getID3;

$path = 'Kalimba.mp3';
$mixinfo = $getID3->analyze($path);

getid3_lib::CopyTagsToComments($mixinfo);

$bit_rate = $mixinfo['audio']['bitrate'];
$play_time = $mixinfo['playtime_string'];

list($mins, $secs) = explode(':', $play_time);

if ($mins > 60) {
    $hours = intval($mins / 60);
    $mins = $mins - $hours * 60;
}

$play_time = sprintf("%02d:%02d:%02d", $hours, $mins, $secs);

echo $play_time;

$directory = 'mp3';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
echo "<br />";
echo "<pre>";
print_r($scanned_directory);
?>