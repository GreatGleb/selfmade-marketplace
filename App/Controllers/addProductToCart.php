<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\ShopProduct;
use App\Models\ShopProductAtribute;
use App\MultiException;

session_start();
$buyCart = $_SESSION['buyCart'];
$productId = $_POST['productId'];
$atributesId = explode(",", $_POST['atributesId']);

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		
		if($_POST['atributesId'] == NULL) {
			$findedProducts = Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $buyCart->id, 'productId', $productId);
			if($findedProducts == NULL) {
				$product = new Models\BuyCartProducts();
				$productNewId = $product->findMaxId() + 1;
				$product->id = $productNewId;
				$product->buyCartId = $buyCart->id;
				$product->productId = $productId;
				
				$findedProduct = Models\ShopProduct::findById($productId);
				$product->number = $findedProduct->minOrderQuantity;
				
				if($product->number < 1) {
				    $product->number = 1;
				}
				
				$product->insert();
			}
		} else {
		    $product = new Models\BuyCartProducts();
			$productNewId = $product->findMaxId() + 1;
			$product->id = $productNewId;
			$product->buyCartId = $buyCart->id;
			$product->productId = $productId;
			
			$findedProduct = Models\ShopProduct::findById($productId);
			$product->number = $findedProduct->minOrderQuantity;
			
			if($product->number < 1) {
			    $product->number = 1;
			}
			
			$product->insert();
			
			foreach($atributesId as $atribut) {
		        $newAtribut = new Models\BuyCartProductAtributes();
    			$newAtributId = $newAtribut->findMaxId() + 1;
    			$newAtribut->id = $newAtributId;
    			$newAtribut->buyCartProductsId = $product->id;
    			$newAtribut->atributId = $atribut;
			    
			    $newAtribut->insert();
		    }
			
		}
		
		echo 1;
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>