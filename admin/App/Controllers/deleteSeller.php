<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$seller = Models\Seller::findById($data);

session_start();

$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1'
	&& $_SESSION['user']["typeofuser"] == 'Admin') {

	$shops = Models\Shop::findTablesByField('sellerId', $data);
	
	foreach($shops as $shop) {
		$shopImages = Models\ImagesForShop::findTablesByField('shopId', $shop->id);
		
		foreach($shopImages as $shopImage) {
			$image = Models\Images::findById($shopImage->imageId);
			
			if($shopImage !== NULL) {
				if($shopImage->delete()) {				
					$imgName = $image->name;
					
					$target_dir = realpath(__DIR__ . "/../templates/files/img/shops");
					$target_dir = $target_dir . "//";
					
					if($image !== NULL) {
						$image->delete();
					}
					deleting($imgName, $target_dir);
				}
			}
		}
		
		$shopProducts = Models\ShopProduct::findTablesByField('shopId', $shop->id);
		
		foreach($shopProducts as $shopProduct) {
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
				$shopProduct->delete();
			}
		}
		
		$shopContacts = Models\ShopContact::findTablesByField('shopId', $shop->id);
		foreach($shopContacts as $shopContact) {
			$contact = Models\Contact::findById($shopContact->contactId);
			
			if($shopContact !== NULL) {
				if($shopContact->delete()) {
					if($contact !== NULL) {
						$contact->delete();
					}
				}
			}
		}
		
		$shop->delete();
	}
	
	$stockRooms = Models\ShopStockRoom::findTablesByField('sellerId', $data);
	
	foreach($stockRooms as $stockRoom) {
		$stockRoom->delete();
		
		$address = Models\Address::findById($stockRoom->addressId);
		if($address !== NULL) {
			$address->delete();
		}
		$stockContact = Models\Contact::findById($stockRoom->contactId);
		if($stockContact !== NULL) {
			$stockContact->delete();
		}
	}
	
	$requisites = Models\SellerRequisites::findById($seller->requisitesId);
	
	$userId = $seller->userId;
	
	$seller->delete();
	
	$jurAddress = Models\Address::findById($requisites->juridicalAddressId);
	$factAddress = Models\Address::findById($requisites->facticalAddressId);
	
	$requisites->delete();
	
	$jurAddress->delete();
	$factAddress->delete();
	
	$user = Models\User::findById($userId);
	
	$userContacts = Models\UserContacts::findTablesByField('userId', $userId);
		
	foreach($userContacts as $userContact) {
		$contact = Models\Contact::findById($userContact->contactId);
		
		if($userContact !== NULL) {
			if($userContact->delete()) {
				if($contact !== NULL) {
					$contact->delete();
				}
			}
		}
	}
	
	$userImages = Models\ImagesForAdmin::findTablesByField('userId', $userId);
	
	foreach($userImages as $userImage) {
		$tableImage = Models\Images::findById($userImage->imageId);
		if($userImage->delete()) {				
			$imgOrigName = $tableImage->name;
			
			$target_dir = realpath(__DIR__ . "/../templates/files/img/accounts");
			$target_dir = $target_dir . "//";
	
			$tableImage->delete();
			deleting($imgOrigName, $target_dir);
		}
	}
	
	if($user->delete()) {
		echo 1;
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