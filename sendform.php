<?php
if(strpos($_SERVER['HTTP_REFERER'],'?')){
	$endPosition = strpos($_SERVER['HTTP_REFERER'],'?');
	$fromPageURL = substr($_SERVER['HTTP_REFERER'],0,$endPosition);
}else{
	$fromPageURL = $_SERVER['HTTP_REFERER'];
}

function send_mail($to, $subject, $message, $from = '', $fromname = ''){
	$now = strtotime("now");
	
	$header = 
	"From: \"$fromname\" <$from>\n".
	"Reply-To:  $to\n".
	"Return-Path: $to\n".
	"Message-ID: <$now daemon@".$_SERVER['SERVER_NAME'].">\n".
	"X-Mailer:PHP/".phpversion()."\n".
	"Mime-Version: 1.0\n".
	"Content-Type: text/html; charset=UTF-8 ";
	
	if(@mail($to, utf8_decode($subject), $message ,$header)){
		return true;
	}else{
		return false;
	}
}
$Get_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URl']."/cumple/";
$to=$_GET["pemail"];
$cc=$_GET["pcc"];
$file=$_GET["pimage"];

$message='<a href="http://ingruplatam.com/"><img src="'.$Get_url.$file.'" alt="INGRUP"></a>';
//echo $message;
//$message="hola";

if(send_mail($to, '¡FELIZ CUMPLEAÑOS! - INGRUP', $message, 'info@ingruplatam.com', 'INGRUP - Fabricamos Confianza desde 1974')){
	if(send_mail($cc, '¡FELIZ CUMPLEAÑOS! - INGRUP', $message, 'info@ingruplatam.com', 'INGRUP - Fabricamos Confianza desde 1974')){
		$msg=true; 
	}else{
		$msg=false;
	}
}else{
	$msg=false;
}
echo $msg;



/*





$message = '<table style="text-align: center; width: 465px; height: 575px;" border="0">
<tbody style="text-align: left;">
<tr style="text-align: left;">
<td style="text-align: left;"><strong style=" font-weight:"><b>Formulario de Contacto</b></strong></td>
</tr>
<tr style="text-align: left;">
<td style="text-align: left;"><b>Nombre y Apellidos:</b></td>
<td style="text-align: left;">'.$_POST['pname'].'</td>
</tr>
<tr style="text-align: left;">
<td style="text-align: left;"><b>Email:</b></td>
<td style="text-align: left;">'.$_POST['pemail'].'</td> 
</tr>
<tr style="text-align: left;">
<td style="text-align: left;"><b>Recibir Informaci&oacute;n de IDC:</b></td>
<td style="text-align: left;">'.$_POST['pmessage'].'</td>
</tr>
</tbody>
</table>'; 

if(send_mail('jchavezlopez9@gmail.com', 'Formulario de Contacto PROYECTO', $message, 'asesores@umg.com.gt', 'Proyecto 1')){
	$msg=true;
	//$msg = 'Thank you!, your message has been sent.';
}else{
	$msg=false;
	//$msg = 'Your message could not been sent, please try again later.';
}
	die($msg);
//header('Location: '.$fromPageURL.'?msg='.urlencode($msg));

*/
?>