<?php
session_start();
$string = md5(time());
$string = substr($string, 0, 6);
 
$_SESSION['captcha'] = $string;
 
$img = imagecreate(150,50);
$background = imagecolorallocate($img, 255,255,255);
$text_color = imagecolorallocate($img, 0,6,202);
imagestring($img, 20,45,15, $string, $text_color);
 
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>