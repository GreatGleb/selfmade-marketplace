<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\Shop;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;

$shopId = $data[0];
$shopName = $data[1];
$shopDescription = $data[2];
$shopURL = $data[3];

$shopIsTrading = $data[4];
$statusOfShopTrading = $data[5];
$isShopIncluded = $data[6];
$isTrading = $data[7];
$statusOfTrading = $data[8];
$isIncluded = $data[9];

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		$shop = new Shop();

		$shop->setValueToTable($shopId, 'name', $shopName);
		$shop->setValueToTable($shopId, 'description', $shopDescription);
		$shop->setValueToTable($shopId, 'url', $shopURL);
		$shop->setValueToTable($shopId, 'isIncluded', $isShopIncluded);
		
		if($_SESSION['user']["typeofuser"] == 'Admin') {			
			$shop->setValueToTable($shopId, 'isTrading', $shopIsTrading);
			$shop->setValueToTable($shopId, 'statusOfTrading', $statusOfShopTrading);
			
			$sellerId = Shop::findById($shopId)->sellerId;
			
			$seller = new Models\Seller();
			
			$seller->setValueToTable($sellerId, 'isIncluded', $isIncluded);
			$seller->setValueToTable($sellerId, 'isTrading', $isTrading);
			$seller->setValueToTable($sellerId, 'statusOfTrading', $statusOfTrading);
		}
		
		echo 1;
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>