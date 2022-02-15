<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

try {	
	session_start();

	$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
	$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
		
	if ($_SESSION['user']['isfounder'] > 0
		|| ($_SESSION['user']['isblocked'] !== '1')) {
		$stock = Models\ShopStockRoom::findById($_POST['stockId']);
		$seller = Models\Seller::findById($stock->sellerId);
		
		$shops = Models\Shop::findTablesByField('sellerId', $seller->id);
		
		foreach($shops as $shop) {
		    $goods = Models\ShopProduct::findTablesByField('shopId', $shop->id);
		    foreach($goods as $good) {
		        $good->setValueToTable($good->id, 'stockroomId', $stock->id);
		    }
		}
		
		echo 1;
	
	}
} catch (PDOException $e) {
	var_dump($e);
}	
	
?>