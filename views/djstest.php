<?php
 $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
 $latilongi= json_decode($location);
 echo '<pre/>'; print_r($latilongi); die;
?>