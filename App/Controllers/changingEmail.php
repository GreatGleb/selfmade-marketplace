<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\User;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data ); 

session_start();

$id = $_SESSION['user']['id'];
$email = $data;

if(User::setEmail($id, $email)) {
	$_SESSION['user']['email'] = $email;
} else {
	return false;
}
echo 1;

?>