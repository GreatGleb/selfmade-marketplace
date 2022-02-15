<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\Address;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

$stockroomId = $_POST['stockroomId'];
$addrCountry = $_POST['addrCountry'];
$addrIndex = $_POST['addrIndex'];
$addrRegion = $_POST['addrRegion'];

$addrCity = $_POST['addrCity'];
$addrStreet = $_POST['addrStreet'];
$addrHome = $_POST['addrHome'];
$addrOffice = $_POST['addrOffice'];
$phone = $_POST['phone'];
$typePickUp = $_POST['isTypePickupFromPoint'];
$listOfPVZ = json_decode($_POST['listOfPVZ']);

var_dump(is_array($listOfPVZ));

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		$stock = Models\ShopStockRoom::findById($stockroomId);
		
		$stockAddr = new Address();
		$stockAddrId = $stock->addressId;

		$stockAddr->setValueToTable($stockAddrId, 'country', $addrCountry);
		$stockAddr->setValueToTable($stockAddrId, 'postIndex', $addrIndex);
		$stockAddr->setValueToTable($stockAddrId, 'region', $addrRegion);
		$stockAddr->setValueToTable($stockAddrId, 'city', $addrCity);
		$stockAddr->setValueToTable($stockAddrId, 'street', $addrStreet);
		$stockAddr->setValueToTable($stockAddrId, 'home', $addrHome);
		$stockAddr->setValueToTable($stockAddrId, 'office', $addrOffice);
		$stock->setValueToTable($stock->id, 'isDeliveryFromPoint', $typePickUp);
		
		if(is_array($listOfPVZ)) {
    		foreach($listOfPVZ as $pvz) {
    		    $finedPVZ = Models\ShopPoinsAcceptaceOrders::findTablesByTwoFields('stockroomId', $stockroomId, 'deliveryId', $pvz->deliveryId)[0];
    		    if($finedPVZ == NULL) {
    		        $newPVZ = new Models\ShopPoinsAcceptaceOrders();
    		        
            		$newId = $newPVZ->findMaxId() + 1;
            		$newPVZ->id = $newId;
    		        $newPVZ->stockroomId = $stockroomId;
            		$newPVZ->deliveryId = $pvz->deliveryId;
            		$newPVZ->pvzId = $pvz->pvzId;
            		$newPVZ->insert();
    		    } else {
    		        $finedPVZ->setValueToTable($finedPVZ->id, 'pvzId', $pvz->pvzId);
    		    }
    		}
		}
		
		$stockContact = new Models\Contact();
		$stockContactId = $stock->contactId;
		$stockContact->setValueToTable($stockContactId, 'contact', $phone);		

		echo 1;
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>