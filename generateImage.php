<?php
if( isset($_GET["pname"]) && isset($_GET["pgender"]) ){

	//Set the Content Type
	header('Content-type: image/jpeg');

	$x=0;
	$y=0;
	$size=0;
	// Create Image From Existing File
	if(($_GET["pgender"]=="Masculino") && ($_GET["planguage"]=="Español")){
		$jpg_image = imagecreatefromjpeg('images/hombre.jpg');
		$x=255;
		$y=290;
		$size=12;	
	}else
	if(($_GET["pgender"]=="Femenino") && ($_GET["planguage"]=="Español")){
		$jpg_image = imagecreatefromjpeg('images/mujer.jpg');
		$x=255;
		$y=290;
		$size=12;
	}else
	if($_GET["planguage"]=="Ingles"){
		$jpg_image = imagecreatefromjpeg('images/man.jpg');
		$x=255;
		$y=270;
		$size=10;
	}


	// Allocate A Color For The Text
	$blue = imagecolorallocate($jpg_image, 31, 78, 121);

	// Set Path to Font File
	$font_path = 'ariblk.ttf';

	// Set Text to Be Printed On Image
	$text = $_GET["pname"];

	// Print Text On Image
	imagettftext($jpg_image, $size, 0, $x, $y, $blue, $font_path, $text);

	$hoy = date("YmdHis"); 
	$name="image".$hoy;
	$file='images/generate/'.$name.'.jpg';
	// Send Image to Browser
	imagejpeg($jpg_image,$file);

	$msg= $file;

	echo $msg;
	// Clear Memory
	imagedestroy($jpg_image);
}

?>