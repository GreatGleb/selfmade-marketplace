<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1') {
	//Seller

	$seller = Models\Seller::findTablesByField('jurName', $_POST["jurName"])[0];

	$newProduct = new Models\ShopProduct();
	$newProductId = $newProduct->findMaxId() + 1;

	$newProduct->id = $newProductId;
	$newProduct->typeProduct = $_POST['goodType'];

	$arrBrand = Models\ShopProductBrand::findTablesByField('brand', $_POST['goodBrand']);
			
	if(sizeof($arrBrand) > 0) {
		$newProduct->brandId = $arrBrand[0]->id;
	} else {
		$brand = new Models\ShopProductBrand();
		$brandId = $brand->findMaxId() + 1;
		
		$brand->id = $brandId;
		$brand->brand = $_POST['goodBrand'];
		
		$sameUrls = Models\ShopProductBrand::findTablesByField('url', $_POST['goodBrandUrl']);
		$numb = 1;
		
		while($sameUrls != NULL) {
			$numb++;
			
			$sameUrls = Models\ShopProductBrand::findTablesByField('url', $_POST['goodBrandUrl'] . $numb);
		}
		if($numb == 1) {
			$brand->url = $_POST['goodBrandUrl'];
		} else {
			$brand->url = $_POST['goodBrandUrl'] . $numb;
		}
		
		$brand->insert();
		
		$newProduct->brandId = $brand->id;
	}

	$arrModel = Models\ShopProductModel::findTablesByField('model', $_POST['goodModel']);

	if(sizeof($arrModel) > 0) {
		$newProduct->modelId = $arrModel[0]->id;
	} else {
		$model = new Models\ShopProductModel();
		$modelId = $model->findMaxId() + 1;
		
		$brandId = $newProduct->brandId;
		
		$model->id = $modelId;
		$model->brandId = $brandId;
		$model->model = $_POST['goodModel'];
		
		$model->insert();
		
		$newProduct->modelId = $model->id;
	}

	$newProduct->url = $_POST['goodUrl'];
	$newProduct->shopId = $_POST['shopId'];

	if($newProduct->insert()) {
		echo $newProduct->id . '|' . $newProduct->url;
	} else {
		return false;
	}
}

?>