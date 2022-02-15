<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\User;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data ); 

session_start();

$to  = "<gwelbts@gmail.com>";

$subject = "Saterno. Письмо с формы связи."; 

$message = $data[2];
$message .= "\rМоё имя - " . $data[0] . ". Моя почта - " . $data[1];

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From: От кого письмо <info@saterno.ru>\r\n"; 
$headers .= "Reply-To: gwelbts@gmail.com\r\n"; 

if(mail($to, $subject, $message, $headers)) {
	echo 1;
} else {
	return false;
}

?>