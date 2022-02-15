<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode($data);

session_start();

$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1') {

	$shopProduct = Models\ShopProduct::findById($data);

	$shopProductImages = Models\ShopProductImages::findTablesByField('productId', $shopProduct->id);
		
		foreach($shopProductImages as $shopProductImage) {
			$tableImage = Models\Images::findById($shopProductImage->imageId);
			
			if($shopProductImage !== NULL) {
				if($shopProductImage->delete()) {				
					$imgOrigName = $tableImage->name;
					
					$target_dir = realpath(__DIR__ . "/../templates/files/img/products");
					$target_dir = $target_dir . "//";
			
					$tableImage->delete();
					deleting($imgOrigName, $target_dir);
				}
			}
		}
		
		$shopProductShowInCat = Models\ShopProductShowInCategories::findTablesByField('productId', $shopProduct->id);
		
		foreach($shopProductShowInCat as $showInCat) {
			if($showInCat !== NULL) {
				$showInCat->delete();
			}
		}
		
		$imgAtributes = Models\ShopProductAtribute::findTablesByFieldOneAndFieldNotNULL('productId', $shopProduct->id, 'imageId');
		
		foreach ($imgAtributes as $atribut) {			
			$finedImg = Models\Images::findById($atribut->imageId);
			$url = $finedImg->url;
			$name = $finedImg->name;
			$path = $url . $name;
			
			if($atribut->delete()) {					
				$target_dir = realpath(__DIR__ . "/../templates/files/img/product-attributes");
				$target_dir = $target_dir . "//";
				
				if($finedImg !== NULL) {
					$finedImg->delete();
				}
				deleting($name, $target_dir);
			}
		}
		
		$allAtributes = Models\ShopProductAtribute::findTablesByField('productId', $shopProduct->id);
		
		foreach ($allAtributes as $atribut) {
			if($atribut !== NULL) {
				$atribut->delete();
			}
		}
		
		$shopProductDisconts = Models\ShopProductDiscont::findTablesByField('productId', $shopProduct->id);
		
		foreach($shopProductDisconts as $discont) {
			if($discont !== NULL) {
				$discont->delete();
			}
		}
		if($shopProduct !== NULL) {
			if($shopProduct->delete()) {
				echo '1';
			}
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
	echo $img." файл удален";  
}


?>