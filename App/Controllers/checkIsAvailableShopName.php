<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\Seller;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$isAvailableShopName = 1;

$shops = Models\Shop::findAll();

foreach($shops as $shop) {
	if($data === $shop->name) {
		$isAvailableShopName = 0;
		break;
	}
}

echo($isAvailableShopName);

?>