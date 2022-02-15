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

$isAvailableShopJurName = 0;

$sellers = Models\Seller::findAll();

foreach($sellers as $seller) {
	if($data === $seller->jurName) {
		$isAvailableShopJurName = 1;
		break;
	}
}

echo($isAvailableShopJurName);

?>