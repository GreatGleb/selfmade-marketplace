<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');
require_once realpath(__DIR__ . '/../../phpQuery/phpQuery/phpQuery.php');

use \phpQuery;
use App\Models;
use App\Models\Seller;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$isAvailableEmail = 1;

$users = Models\User::findAll();

foreach($users as $user) {
	if($data === $user->login || $data === $user->email) {
		$isAvailableEmail = 0;
	}
}

echo($isAvailableEmail);

?>