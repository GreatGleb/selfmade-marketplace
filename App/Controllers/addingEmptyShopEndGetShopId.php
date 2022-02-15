<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\Shop;
use App\MultiException;

try {
	session_start();

	$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
	
	if ($_SESSION['user']['isblocked'] !== '1') {
	
		$shop = new Shop();

		$lastShopId = $shop->findMaxId();
		$lastShop = Shop::findById($lastShopId);

		if($lastShop == NULL) {
			$shop->id = $lastShopId + 1;
		} else if($lastShop->name == NULL) {
			$shop->id = $lastShopId;
		} else {
			$shop->id = $lastShopId + 1;
		}

		if($shop->id == $lastShopId + 1) {
				if($shop->insert()) {
					echo $shop->id;
				} else {
					return false;
				}
			
		} else {
			echo $shop->id;
		}
	}
} catch (PDOException $e) {
	var_dump($e);
}	
?>