<?php
session_start();
header ("Content-type: image/png");
if(isset($_SESSION['my_captcha']))
{
unset($_SESSION['my_captcha']);
}
$string1="ABCDEFGHIJKLMNPQRSTUVWXYZ";
$string2="123456789";
$string=$string1.$string2;
$string= str_shuffle($string);
$random_text= substr($string,0,6); 
$_SESSION['my_captcha'] =$random_text;
$im = @ImageCreate (80, 30) or die ("Cannot Initialize new GD image stream");
$background_color = ImageColorAllocate ($im, 204, 204, 204);
$text_color = ImageColorAllocate ($im, 0, 0, 0);
ImageString($im,5,8,2,$_SESSION['my_captcha'],$text_color);
ImagePng ($im);
imagedestroy($im);
?>
