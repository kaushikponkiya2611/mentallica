<?php
require 'config.php';
$youtubevideo=$_REQUEST['youtubevideo'];
$youtube=str_replace("https://www.youtube.com/watch?v=","",$youtubevideo);
$youtube=str_replace("https://www.youtube.com/watch?v=/","",$youtube);
$youtube=str_replace("https://youtu.be/","",$youtube);
$img="http://img.youtube.com/vi/".$youtube."/0.jpg";

grab_image($img,"images/$youtube.jpg");

// Load the stamp and the photo to apply the watermark to
$im = imagecreatefromjpeg("images/$youtube.jpg");
$stamp = imagecreatefrompng('images/play.png');

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 170;
$marge_bottom = 100;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo
// width to calculate positioning of the stamp.
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output and free memory
header('Content-type: image/jpg');
$save = "images/$youtube.jpg";
imagepng($im,$save);
imagedestroy($im);

//echo $path."images/$youtube.jpg";

function grab_image($url,$saveto){
    $ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw=curl_exec($ch);
    curl_close ($ch);
    if(file_exists($saveto)){
        unlink($saveto);
    }
    $fp = fopen($saveto,'x');
    fwrite($fp, $raw);
    fclose($fp);
}
?>
