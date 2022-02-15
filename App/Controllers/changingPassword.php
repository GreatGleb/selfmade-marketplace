<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\User;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data ); 

session_start();

$id = $_SESSION['user']['id'];
$password = $data;

if(User::setPassword($id, $password)) {
	echo 1;
} else {
	return false;
}

?>