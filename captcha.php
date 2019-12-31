<?php


session_start();

header("Content-type: image/png");


$_SESSION["Captcha"]="";

$gbr = imagecreate(200, 50);


imagecolorallocate($gbr, 255, 165, 0);

$grey = imagecolorallocate($gbr, 128, 128, 128);

$black = imagecolorallocate($gbr, 0, 0,0);


$font = "monaco.ttf"; 


for($i=0;$i<=5;$i++) {
	
	$nomor=rand(0, 9);

	$_SESSION["Captcha"].=$nomor;

	$sudut= rand(-35, 40);

	imagettftext($gbr, 20, $sudut, 8+15*$i, 25, $black, $font, $nomor);

	
	imagettftext ($gbr, 20, $sudut, 9+15*$i, 26, $grey, $font, $nomor);
}

imagepng($gbr); 
imagedestroy($gbr);
?>