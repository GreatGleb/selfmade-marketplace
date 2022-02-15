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

	$newAddress = new Models\Address();
	$newAddressId = $newAddress->findMaxId() + 1;

	$newAddress->id = $newAddressId;
	$newAddress->country = $_POST['stockCountry'];
	$newAddress->region = $_POST['stockRegion'];
	$newAddress->city = $_POST['stockCity'];
	$newAddress->street = $_POST['stockStreet'];
	$newAddress->home = $_POST['stockHome'];
	$newAddress->office = $_POST['stockOffice'];
	$newAddress->postIndex = $_POST['stockIndex'];

	if($newAddress->insert()) {
		$newContact = new Models\Contact();
		$newContactId = $newContact->findMaxId() + 1;
		$newContact->id = $newContactId;
		$newContact->typeId = Models\ContactsType::findTablesByField('type', 'phone')[0]->id;
		$newContact->contact = $_POST['phones'];
		
		if($newContact->insert()) {
			$newStockroom = new Models\ShopStockRoom();
			$newStockroomId = $newStockroom->findMaxId() + 1;
			
			$newStockroom->id = $newStockroomId;
			$newStockroom->sellerId = $seller->id;
			$newStockroom->addressId = $newAddress->id;
			$newStockroom->contactId = $newContact->id;
			
			if($newStockroom->insert()) {
				$user = Models\User::findById($seller->userId);
				
				$jurSelectedTypeId = $seller->jurTypeId;
				$jurSelectedType = Models\SellerJuridicEntityType::findById($jurSelectedTypeId)->type;
				$jurType = $seller->jurType;

				echo $seller->id, ",", $user->full_name, ",", $newStockroomId, ",", $jurSelectedType, ",", $jurType;
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

?>