<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$stockRoom = Models\ShopStockRoom::findById($data);

session_start();

$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1') {

	$address = Models\Address::findById($stockRoom->addressId);
	
	if($stockRoom->delete()) {
		if($address->delete()) {
			$stockContact = Models\Contact::findById($stockRoom->contactId);
			if($stockContact->delete()) {
				
				echo 1;
				$shopProducts = Models\ShopProduct::findTablesByField('stockroomId', $stockRoom->id);
				
				foreach($shopProducts as $shopProduct) {
					$shopProduct->setValueToTable($shopProduct->id, 'stockroomId', NULL);
				}
			}
		}
	}
	
} else {
	return false;
}

?>