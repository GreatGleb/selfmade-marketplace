<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\User;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1') {

	//Seller

	$seller = Models\Seller::findTablesByField('jurName', $_POST["jurName"])[0];

	//Deleting image from server

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
	}

	//Shop

	$shop = new Models\Shop();

	$lastShopId = $shop->findMaxId();
	$lastShop = Models\Shop::findById($lastShopId);

	if($lastShop == NULL) {
		$shop->id = $lastShopId + 1;
	} else if($lastShop->name == NULL) {
		$shop->id = $lastShopId;
		
		$imageForShop = new Models\ImagesForShop();
		$imagesForShop = $imageForShop->findTablesByTwoFields('shopId', $shop->id, 'isCurrent', 0);
		
		foreach($imagesForShop as $table) {
			$imageForShop->id = $table->id;
			$image = Models\Images::findById($table->imageId);
			$imageObject = new Models\Images();
			$imageObject->id = $image->id;
			
			$imageName = $image->name;
			$target_dir = realpath(__DIR__ . "/../templates/files/img/shops/");
			$target_dir = $target_dir . "//";
			
			if($imageForShop->delete()) {
				if($imageObject->delete()) {
					deleting($imageName, $target_dir);
				}
			}
		}
	} else {
		$shop->id = $lastShopId + 1;
	}

	if($shop->id == $lastShopId + 1) {
		//new Shop
		$shop->name = $_POST["shopName"];
		$shop->description = $_POST["shopDescription"];
		
		if($_POST["shopUrl"] !== NULL) {
			$shop->url = $_POST["shopUrl"];
		}
		
		$shop->sellerId = $seller->id;	
		
		$shop->insert();
	} else {
		Models\Shop::setValueToTable($shop->id, 'name', $_POST["shopName"]);
		Models\Shop::setValueToTable($shop->id, 'description', $_POST["shopDescription"]);
		
		if($_POST["shopUrl"] !== NULL) {
			Models\Shop::setValueToTable($shop->id, 'url', $_POST["shopUrl"]);
		}
		
		Models\Shop::setValueToTable($shop->id, 'sellerId', $seller->id);
	}

	$shop->date_added = Models\Shop::findById($shop->id)->date_added;

	$strShopContact = $_POST['shopPhones'];
	$fieldsShopContact = explode(",", $strShopContact);

	foreach($fieldsShopContact as $contact) {
		$shopContact = new Models\ShopContact();

		$newContact = new Models\Contact();
		$newContactNewId = $newContact->findMaxId() + 1;
		$newContact->id = $newContactNewId;
		$newContact->typeId = Models\ContactsType::findTablesByField('type', 'phone')[0]->id;
		$newContact->contact = $contact;
		
		$newContact->insert();
		
		$shopContactNewId = $shopContact->findMaxId() + 1;
		$shopContact->id = $shopContactNewId;
		$shopContact->shopId = $shop->id;
		$shopContact->contactId = $newContact->id;
		
		$shopContact->insert();
	}

	$user = Models\User::findById($seller->userId);

	$imageId = Models\ImagesForShop::findTablesByTwoFields('shopId', $shop->id, 'isCurrent', 1)[0]->imageId;
	$imageName = Models\Images::findById($imageId)->name;

	$jurSelectedTypeId = $seller->jurTypeId;
	$jurSelectedType = Models\SellerJuridicEntityType::findById($jurSelectedTypeId)->type;
	$jurType = $seller->jurType;

	echo $shop->id, ",", $shop->date_added, ",", $seller->id, ",", $user->full_name, ",", $imageName, ",", $jurSelectedType, ",", $jurType, ",", $seller->isTrading;
}

?>