<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

session_start();

if($_SESSION['deliveryOrders'] == NULL) {
    $_SESSION['deliveryOrders'] = [];
    $_SESSION['deliveryOrders'][] = $_POST;
} else {
    $_SESSION['deliveryOrders'][] = $_POST;
}

$buyCart = $_SESSION['buyCart'];
$findedProducts = Models\BuyCartProducts::findTablesByField('buyCartId', $buyCart->id);
$isGood = 1;

foreach($findedProducts as $product) {
    $atributes = Models\BuyCartProductAtributes::findTablesByField('buyCartProductsId', $product->id);
    foreach($atributes as $atribut) {
        if($atribut != NULL) {
            $atribut->delete();
        }
    }
    $product->delete();
}

var_dump($_POST);

?>