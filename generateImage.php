<?php
if(isset($_GET["pname"]) && isset($_GET["pgender"])){

	//Set the Content Type
	header('Content-type: image/jpeg');

	// Create Image From Existing File
	if($_GET["pgender"]=="Masculino"){
		$jpg_image = imagecreatefromjpeg('images/man.jpg');	
	}else{
		$jpg_image = imagecreatefromjpeg('images/woman.jpg');
	}


	// Allocate A Color For The Text
	$blue = imagecolorallocate($jpg_image, 31, 78, 121);

	// Set Path to Font File
	$font_path = 'ariblk.ttf';

	// Set Text to Be Printed On Image
	$text = $_GET["pname"];

	// Print Text On Image
	imagettftext($jpg_image, 12, 0, 255, 290, $blue, $font_path, $text);

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