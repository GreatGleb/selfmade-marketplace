<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\User;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;

if($_SESSION['user']["typeofuser"] == 'Admin' && $_SESSION['user']['isblocked'] !== '1') {

	//var_dump($_POST);

	$new_user = new User();

	$fio = $_POST["fio"];
	$login = $_POST["email"];
	$email = $_POST["email"];
	$new_password = $_POST["accPassword"];
	$typeofuser_id = \App\Models\TypeOfUsers::findIdTypeOfUsersByType('Seller')->id;

	$newIdForUser = $new_user->findMaxId() + 1;
	$new_user->id = $newIdForUser;
	$new_user->full_name = $fio;
	$new_user->login = $login;
	$new_user->email = $email;
	$new_user->password = $new_password;
	$new_user->typeofuser_id = $typeofuser_id;

	if($new_user->insert()) {

		$new_user->date_added = User::findById($new_user->id)->date_added;
		
		$strContact = $_POST['phones'];
		$fieldsContact = explode(",", $strContact);

		foreach($fieldsContact as $contact) {
			$userContact = new Models\UserContacts();

			$newContact = new Models\Contact();
			$newContactNewId = $newContact->findMaxId() + 1;
			$newContact->id = $newContactNewId;
			$newContact->typeId = Models\ContactsType::findTablesByField('type', 'phone')[0]->id;
			$newContact->contact = $contact;
			
			$newContact->insert();
			
			$userContactNewId = $userContact->findMaxId() + 1;
			$userContact->id = $userContactNewId;
			$userContact->userId = $new_user->id;
			$userContact->contactId = $newContact->id;
			
			$userContact->insert();
		}
		//Jur Address
		$strJurAddr = $_POST["jurAddr"];
		$fieldsJurAddr = explode(",", $strJurAddr);
		
		$jurAdd = new Models\Address();

		$jurAddNewId = $jurAdd->findMaxId() + 1;
		$jurAdd->id = $jurAddNewId;
		$jurAdd->country = $fieldsJurAddr[1];
		$jurAdd->region = $fieldsJurAddr[2];
		$jurAdd->city = $fieldsJurAddr[3];
		$jurAdd->street = $fieldsJurAddr[4];
		$jurAdd->home = $fieldsJurAddr[5];

		if($fieldsJurAddr[6] == "") {
			$jurAdd->office = NULL;
		} else {
			$jurAdd->office = $fieldsJurAddr[6];
		}
		if($fieldsJurAddr[0] == "") {
			$jurAdd->postIndex = NULL;
		} else {
			$jurAdd->postIndex = $fieldsJurAddr[0];
		}

		$jurAdd->insert();

		//Fact Address
		$strFactAddr = $_POST["factAddr"];
		$fieldsFactAddr = explode(",", $strFactAddr);

		$factAdd = new Models\Address();

		$factAddNewId = $jurAdd->findMaxId() + 1;
		$factAdd->id = $factAddNewId;
		$factAdd->country = $fieldsFactAddr[1];
		$factAdd->region = $fieldsFactAddr[2];
		$factAdd->city = $fieldsFactAddr[3];
		$factAdd->street = $fieldsFactAddr[4];
		$factAdd->home = $fieldsFactAddr[5];

		if($fieldsFactAddr[6] == "") {
			$factAdd->office = NULL;
		} else {
			$factAdd->office = $fieldsFactAddr[6];
		}
		if($fieldsFactAddr[0] == "") {
			$factAdd->postIndex = NULL;
		} else {
			$factAdd->postIndex = $fieldsFactAddr[0];
		}

		$factAdd->insert();

		//Requisites

		$sellerRequisites = new Models\SellerRequisites();

		$sellerRequisitesId = $sellerRequisites->findMaxId() + 1;
		$sellerRequisites->id = $sellerRequisitesId;

		$sellerRequisites->bank = $_POST["bank"];
		$sellerRequisites->currentAccountNumber = $_POST["currAccNum"];
		$sellerRequisites->correspondentAccountNumber = $_POST["corAccNum"];
		$sellerRequisites->BIK = $_POST["bik"];
		$sellerRequisites->INN = $_POST["inn"];
		$sellerRequisites->juridicalAddressId = $jurAdd->id;
		$sellerRequisites->facticalAddressId = $factAdd->id;

		$sellerRequisites->insert();

		//Seller

		$seller = new Models\Seller();
		$sellerId = $seller->findMaxId() + 1;
		$seller->id = $sellerId;
		$seller->userId = $new_user->id;

		if($_POST["jurSelectedType"] !== "NULL") {
			$jurTypeId = Models\SellerJuridicEntityType::findTablesByField('type', $_POST["jurSelectedType"])[0]->id;
			$seller->jurTypeId = $jurTypeId;
		} else if ($_POST["jurType"] !== "NULL") {
			$seller->jurType = $_POST["jurType"];
		}
		$seller->jurName = $_POST["jurName"];
		$seller->requisitesId  = $sellerRequisites->id;

		$seller->insert();

		//StockRooms
		$strStockRooms = $_POST["stockRooms"];
		$fieldsStockRooms = explode("_", $strStockRooms);

		foreach($fieldsStockRooms as $stockRoom) {
			$strStockAddr = $stockRoom;
			$fieldsStockAddr = explode(",", $strStockAddr);

			$stockAdd = new Models\Address();

			$stockAddNewId = $stockAdd->findMaxId() + 1;
			$stockAdd->id = $stockAddNewId;
			$stockAdd->country = $fieldsStockAddr[1];
			$stockAdd->region = $fieldsStockAddr[2];
			$stockAdd->city = $fieldsStockAddr[3];
			$stockAdd->street = $fieldsStockAddr[4];
			$stockAdd->home = $fieldsStockAddr[5];

			if($fieldsStockAddr[6] == "") {
				$stockAdd->office = NULL;
			} else {
				$stockAdd->office = $fieldsStockAddr[6];
			}
			if($fieldsStockAddr[0] == "") {
				$stockAdd->postIndex = NULL;
			} else {
				$stockAdd->postIndex = $fieldsStockAddr[0];
			}
			
			$stockAdd->insert();
			
			$stockContact = new Models\Contact();
			
			$stockContactNewId = $stockContact->findMaxId() + 1;
			$stockContact->id = $stockContactNewId;
			$stockContact->typeId = Models\ContactsType::findTablesByField('type', 'phone')[0]->id;
			$stockContact->contact = $fieldsStockAddr[7];
			
			$stockContact->insert();
			
			$shopStockRoom = new Models\ShopStockRoom();
			$shopStockRoomNewId = $shopStockRoom->findMaxId() + 1;
			$shopStockRoom->id = $shopStockRoomNewId;
			$shopStockRoom->sellerId = $seller->id;
			$shopStockRoom->addressId = $stockAdd->id;
			$shopStockRoom->contactId = $stockContact->id;
			
			$shopStockRoom->insert();
		}

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

		echo $new_user->id, ",", $new_user->date_added, ",", $seller->id, ",", $jurAdd->id, ",", $factAdd->id;
	} else {
		return false;
	}
}

?>