<?php
require 'config.php';
$group = $_POST['group'];

$directory = __DIR__.DIRECTORY_SEPARATOR.'elements'.DIRECTORY_SEPARATOR.$group.DIRECTORY_SEPARATOR;
$scanned_files = array_diff(scandir($directory), array('..', '.'));

$buffer = '';

foreach ($scanned_files as $n => $file) {
    if (file_exists($directory.$file) && strstr($file, '.html')) {
     $buffer.= file_get_contents($directory.$file);
     $buffer=str_replace("{PATH}",$path,$buffer);
    }
}
echo $buffer;
