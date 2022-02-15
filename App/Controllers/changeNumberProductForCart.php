<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

session_start();
$buyCart = $_SESSION['buyCart'];
$productId = $_POST['productId'];

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		
		$findedProducts = Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $buyCart->id, 'productId', $productId);
		if($findedProducts != NULL) {
			Models\BuyCartProducts::setValueToTable($findedProducts[0]->id, 'number', $_POST["number"]);
			echo 1;
		}
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>