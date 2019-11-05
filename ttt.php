<?php 
echo '<pre>';
print $_SERVER['REQUEST_SCHEME'];
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
echo $protocol;