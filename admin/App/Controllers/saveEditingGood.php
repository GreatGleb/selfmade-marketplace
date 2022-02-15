<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\ShopProduct;
use App\Models\ShopProductAtribute;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

$goodId = $_POST['goodId'];

$types = explode(",|,", $_POST['typeAtribut']);

$values = explode("]]]", $_POST['valuesAtribut']);

for($i = 0; $i < sizeof($values); $i++) {
	$pos = strrpos($values[$i], ",|,");
	if($pos !== false) {
		$values[$i] = substr($values[$i], 0, $pos);
	}
}

for($i = 0; $i < sizeof($types); $i++) {
	$values[$i] = substr($values[$i], 3);
	$values[$i] = explode(",|,", $values[$i]);
}

$images = explode("]]]", $_POST['imagesAtribut']);
$arrayImages = [];

for($i = 0; $i < sizeof($images); $i++) {
	$pos = strrpos($images[$i], ",|,");
	if($pos !== false) {
		$images[$i] = substr($images[$i], 0, $pos);
	}
}

for($i = 0; $i < sizeof($types); $i++) {
	$images[$i] = substr($images[$i], 3);
	$images[$i] = explode(",|,", $images[$i]);
	
	foreach ($images[$i] as $img) {
		if(strlen($img) > 0) {
			$arrayImages[] = $img;
		}
	}
}

unset($images[sizeof($images)-1]);

//var_dump($disconts);

$disconts = explode("]]]", $_POST['disconts']);

unset($disconts[sizeof($disconts)-1]);

for($i = 0; $i < sizeof($disconts); $i++) {
	$disconts[$i] = explode(",|,", $disconts[$i]);
}

//var_dump($disconts);

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		
		$product = ShopProduct::findById($goodId);
		
		ShopProduct::setValueToTable($goodId, 'typeProduct', $_POST['goodName']);
		
		$arrBrand = Models\ShopProductBrand::findTablesByField('brand', $_POST['goodBrand']);
				
		if(sizeof($arrBrand) > 0) {
			ShopProduct::setValueToTable($goodId, 'brandId', $arrBrand[0]->id);
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
			
			ShopProduct::setValueToTable($goodId, 'brandId', $brand->id);
		}
		
		$arrModel = Models\ShopProductModel::findTablesByField('model', $_POST['goodModel']);
		
		if(sizeof($arrModel) > 0) {
			ShopProduct::setValueToTable($goodId, 'modelId', $arrModel[0]->id);
		} else {
			$model = new Models\ShopProductModel();
			$modelId = $model->findMaxId() + 1;
			
			$brandId = ShopProduct::findById($goodId)->brandId;
			
			$model->id = $modelId;
			$model->brandId = $brandId;
			$model->model = $_POST['goodModel'];
			
			$model->insert();
			
			ShopProduct::setValueToTable($goodId, 'modelId', $model->id);
		}
		
		ShopProduct::setValueToTable($goodId, 'description', $_POST['goodDescription']);
		ShopProduct::setValueToTable($goodId, 'url', $_POST['goodURL']);
		ShopProduct::setValueToTable($goodId, 'sellerPrice', $_POST['sellerPrice']);
		
		ShopProduct::setValueToTable($goodId, 'length', $_POST['goodLength']);
		ShopProduct::setValueToTable($goodId, 'width', $_POST['goodWidth']);
		ShopProduct::setValueToTable($goodId, 'height', $_POST['goodHeight']);
		ShopProduct::setValueToTable($goodId, 'weight', $_POST['goodWeight']);
		
		ShopProduct::setValueToTable($goodId, 'quantity', $_POST['quantityGood']);
		ShopProduct::setValueToTable($goodId, 'minOrderQuantity', $_POST['tradeQuantityGood']);
		
		ShopProduct::setValueToTable($goodId, 'isInStock', $_POST['isInStock']);
		
		ShopProduct::setValueToTable($goodId, 'stockroomId', $_POST['stockId']);
		ShopProduct::setValueToTable($goodId, 'stockCode', $_POST['articulGood']);
		ShopProduct::setValueToTable($goodId, 'mainCategoryId', $_POST['mainCategoryId']);
		
		$categoriesGood = Models\ShopProductShowInCategories::findTablesByField('productId', $goodId);
		
		foreach ($categoriesGood as $categoryGood) {
			if($categoryGood !== NULL) {
				$categoryGood->delete();
			}
		}
		
		$shownGoodcategories = explode("|", $_POST['strCategories']);
		
		foreach ($shownGoodcategories as $categoryGood) {
			if(strlen($categoryGood) > 0) {
				$showCategory = new Models\ShopProductShowInCategories();
				$showCategoryId = $showCategory->findMaxId() + 1;
				
				$showCategory->id = $showCategoryId;
				$showCategory->productId = $goodId;
				$showCategory->categoryId = $categoryGood;
				
				$showCategory->insert();
			}
		}
		
		ShopProduct::setValueToTable($goodId, 'isIncluded', $_POST['isIncluded']);
		
		if($_SESSION['user']["typeofuser"] == 'Admin') {
			ShopProduct::setValueToTable($goodId, 'isTrading', $_POST['isTrading']);		
			ShopProduct::setValueToTable($goodId, 'statusOfTrading', $_POST['statusOfTrading']);
		}
		
		$textValues = ShopProductAtribute::findTablesByFieldOneAndFieldNULL('productId', $goodId, 'imageId');
		
		foreach ($textValues as $textValue) {
			if($textValue !== NULL) {
				$textValue->delete();
			}
		}
		
		//var_dump($arrayImages);
		
		$imgValues = ShopProductAtribute::findTablesByFieldOneAndFieldNotNULL('productId', $goodId, 'imageId');
		
		foreach ($imgValues as $atribut) {
			$isNotInArrayOfImg = true;
			
			$finedImg = Models\Images::findById($atribut->imageId);
			$url = $finedImg->url;
			$name = $finedImg->name;
			$path = $url . $name;
			
			foreach ($arrayImages as $arrImg) {
				if($path == $arrImg) {
					$isNotInArrayOfImg = false;
				}	
			}
			
			if($isNotInArrayOfImg) {		
				if($atribut->delete()) {					
					$target_dir = realpath(__DIR__ . "/../templates/files/img/product-attributes");
					$target_dir = $target_dir . "//";
					
					if($finedImg !== NULL) {
						$finedImg->delete();
					}
					deleting($name, $target_dir);
				}
			}
		}
		
		for($i = 0; $i < sizeof($types); $i++) {
			$type = $types[$i];
			if(strlen($type) < 1) {
				break;
			}
			
			$arrValues = $values[$i];
			$arrImages = $images[$i];
			
			for($j = 0; $j < sizeof($arrValues); $j++) {
				if(strlen($arrImages[$j]) <= 0) {
					$productAtribut = new ShopProductAtribute();
					$productAtributId = $productAtribut->findMaxId() + 1;
					
					$productAtribut->id = $productAtributId;
					$productAtribut->productId = $goodId;
					$productAtribut->type = $type;
					$productAtribut->value = $arrValues[$j];
					
					$productAtribut->insert();
				} else {
					$posSlesh = strrpos($arrImages[$j], "/");
					
					$url = substr($arrImages[$j], 0, $posSlesh + 1);
					$name = substr($arrImages[$j], $posSlesh + 1);
					
					$imageId = Models\Images::findImage($name, $url)->id;
					
					$productAtribut = ShopProductAtribute::findTablesByTwoFields('productId', $goodId, 'imageId', $imageId)[0];
					
					ShopProductAtribute::setValueToTable($productAtribut->id, 'type', $type);
					
					if(strlen($arrValues[$j]) > 0) {
						ShopProductAtribute::setValueToTable($productAtribut->id, 'value', $arrValues[$j]);
					} else {
						ShopProductAtribute::setValueToTable($productAtribut->id, 'value', NULL);
					}
				}
			}
		}
		
		$productEmptyAtributes = ShopProductAtribute::findTablesByFieldNULL('type');
		
		foreach ($productEmptyAtributes as $atribut) {
			$image = Models\Images::findById($atribut->imageId);
		
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
		
		
		$oldDisconts = Models\ShopProductDiscont::findTablesByField('productId', $goodId);
		
		foreach($oldDisconts as $oldDiscont) {
			if($oldDiscont !== NULL) {
				$oldDiscont->delete();
			}
		}
		
		for($i = 0; $i < sizeof($disconts); $i++) {
			$newDiscont = new  Models\ShopProductDiscont();
			$newDiscontId = $newDiscont->findMaxId() + 1;
			
			$newDiscont->id = $newDiscontId;
			$newDiscont->productId = $goodId;
			$newDiscont->newPrice = $disconts[$i][0];
			$newDiscont->dateStart = $disconts[$i][1];
			$newDiscont->dateFinish = $disconts[$i][2];
			$newDiscont->insert();
		}
		
		echo 1;
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

function deleting($img, $target_dir)
{
	$pos_ext = strripos($img, '.');			
	$minuspos = strlen($img)-$pos_ext-1;
	$file_ext = strtolower(substr($img, $pos_ext+1, $minuspos));			
	$file_nameWithoutExt = substr($img, 0, $pos_ext);
	$short_file_name = $file_nameWithoutExt . '_150x150.' . $file_ext;
	
	$short_file_name = $target_dir . $short_file_name;
	$img = $target_dir . $img;
	
	if(file_exists($img)) unlink($img);
	if(file_exists($short_file_name)) unlink($short_file_name);
	if(file_exists($img) == FALSE && file_exists($short_file_name) == FALSE) {}
	//echo $img." файл удален";  
}

?>