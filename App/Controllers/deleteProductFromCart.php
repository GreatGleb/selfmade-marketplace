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
$atributes = explode(",", $_POST['atributes']);

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		
		if($_POST['atributes'] == NULL) {
			$findedProducts = Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $buyCart->id, 'productId', $productId);
			if($findedProducts != NULL) {
				if($findedProducts[0]->delete()) {
				    echo $findedProducts[0]->number;
				} else {
				    return 0;
				}
			}
		} else {
			$findedProducts = Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $buyCart->id, 'productId', $productId);
			
			$needProduct = 1;
			
			foreach($findedProducts as $product) {
			    $countAtributes = 0;
			    foreach($atributes as $atributId) {
		            $atribut = Models\BuyCartProductAtributes::findTablesByTwoFields('buyCartProductsId', $product->id, 'atributId', $atributId);
		            if($atribut != NULL) {
		                $countAtributes++;
		            }
			    }
			    if($countAtributes == sizeof($atributes)) {
			        $needProduct = $product;
			    }
		    }
		    
		    $isGood = 1;
		    
		    if($needProduct !== 1) {
		        foreach($atributes as $atributId) {
		            $atribut = Models\BuyCartProductAtributes::findTablesByTwoFields('buyCartProductsId', $needProduct->id, 'atributId', $atributId)[0];
		            if($atribut != NULL) {
		                if($atribut->delete() != true) {
		                    $isGood = 0;
		                }
		            } else {
		                $isGood = 0;
		            }
			    }
			    if($needProduct->delete() != true) {
			        $isGood = 0;
			    }
		    } else {
                $isGood = 0;
            }
            
            if($isGood == 1) {
                echo $needProduct->number;
            }
		}
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>