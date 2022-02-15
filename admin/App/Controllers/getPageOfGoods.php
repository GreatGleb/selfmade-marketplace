<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;

$numberOfPage = $_POST['numberOfPage'];
$numberOfProducts = ($numberOfPage-1)*10;

if($_SESSION['user']["isblocked"] == '1') {
    return;
}

$markup = \App\Models\ShopProductMarkup::findById(1)->markup;

$products = [];
    
if($_SESSION['user']["typeofuser"] == 'Seller') {
			
	$sellerId = \App\Models\Seller::findTablesByField('userId', $_SESSION['user']['id'])[0]->id;
	$shops = \App\Models\Shop::findTablesByField('sellerId', $sellerId);
	
	for($j = 0; $j < sizeof($shops); $j++) {
	    $shop = $shops[$j];
	    
		$shopProducts = \App\Models\ShopProduct::findTablesByField('shopId', $shop->id);
		
		for($i = $numberOfProducts; sizeof($products) < 10; $i++) { //$shopProducts
		    if($shopProducts[$i] == NULL) {
		        break;
		    }
		    $product = $shopProducts[$i];
		    if($product != NULL) {
			    $products[] = $product;
		    }
		}
	}
} else {
    $allProducts = \App\Models\ShopProduct::findAll();
		    
    for($i = $numberOfProducts; sizeof($products) < 10; $i++) { //$shopProducts
	    $product = $allProducts[$i];
	    if($product == NULL) {
	        break;
	    } else {
	        $products[] = $product;
	    }
	}
}

foreach($products as $product) {
	$product->brand = \App\Models\ShopProductBrand::findById($product->brandId)->brand;
	$product->model = \App\Models\ShopProductModel::findById($product->modelId)->model;
	
	$product->shop = \App\Models\Shop::findById($product->shopId);
	
	$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
	if($product->seller->jurTypeId !==NULL) {
		$product->seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $product->seller->id)[0]->type;
	}
	$product->seller->fio = \App\Models\User::findById($product->seller->userId)->full_name;
	
	$product->systemPrice = $product->sellerPrice * $markup;
	
	$product->product_images = \App\Models\ShopProductImages::findTablesByField('productId', $product->id);
	
	$product->product_image = \App\Models\ShopProductImages::findRecordWithMinField('orderNumber', 'productId', $product->id);
	$product->image = \App\Models\Images::findById($product->product_image->imageId);
	
	foreach($product->product_images as $product_image) {
		$img = \App\Models\Images::findById($product_image->imageId);
		$img->orderNumber = $product_image->orderNumber;
		$product->images[] = $img;
	}
	
	$product->stockrooms = \App\Models\ShopStockRoom::findTablesByField('sellerId', $product->shop->sellerId);
	
	foreach($product->stockrooms as $stockroom) {
		$stockroom->address = \App\Models\Address::findById($stockroom->addressId);
	}
	
	$product->category = \App\Models\Categories::findById($product->mainCategoryId);
	
	$categories = \App\Models\ShopProductShowInCategories::findTablesByField('productId', $product->id);
	
	foreach($categories as $category) {
		$finedCategory = \App\Models\Categories::findById($category->categoryId);
		
		if($finedCategory->parent_categoryId != NULL) {
			$parent_categoryId = $finedCategory->parent_categoryId;
			while(1) {
				$parentCategory = \App\Models\Categories::findById($parent_categoryId);
				$finedCategory->name = $parentCategory->name . ">" . $finedCategory->name;
				
				if($parentCategory->parent_categoryId != NULL) { 
					$parent_categoryId = $parentCategory->parent_categoryId;
				} else {
					break;
				}
			}
		}
		
		$product->categories[] = $finedCategory;
	}
	
	$productEmptyAtributes = \App\Models\ShopProductAtribute::findTablesByFieldNULL('type');
	
	foreach ($productEmptyAtributes as $atribut) {
		$image = \App\Models\Images::findById($atribut->imageId);
	
		if($atribut->delete()) {				
			$imgName = $image->name;
			
			$target_dir = realpath(__DIR__ . "/../templates/files/img/product-attributes");
			$target_dir = $target_dir . "//";
			
			if($image !== NULL) {
				$image->delete();
			}
			deleting($imgName, $target_dir);
		}
	}
	
	$productAtributes = \App\Models\ShopProductAtribute::findTablesByField('productId', $product->id);
	
	$productTypesOfAtributes = [];
	$product->atributes = [];
	
	foreach($productAtributes as $atribut) {
		$isItNewAtribut = true;
		
		foreach($productTypesOfAtributes as $type) {
			if($atribut->type == $type) {
				$isItNewAtribut = false;
			}
		}		

		if($isItNewAtribut) {
			$productTypesOfAtributes[] = $atribut->type;
			$product->atributes[] = $atribut->type;
		}
	}
	
	foreach($productAtributes as $atribut) {
		$typeIndex = array_search($atribut->type, $productTypesOfAtributes);
		
		$image = "";
		
		if($atribut->imageId != NULL) {
			$image = \App\Models\Images::findById($atribut->imageId)->name;
		}
		
		$product->atributes[$typeIndex] .= ",!," . $atribut->value . ",!," . $image;
	}
	
	$productDisconts = \App\Models\ShopProductDiscont::findTablesByField('productId', $product->id);
	
	foreach($productDisconts as $discont) {			
		$product->disconts .= $discont->newPrice . ",|," . $discont->dateStart . ",|," . $discont->dateFinish . "]]]";
	}
}
//var_dump($products);
echo json_encode($products, JSON_UNESCAPED_UNICODE);

?>