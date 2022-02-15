<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\Seller;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$seller = new Seller();

session_start();
$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']["typeofuser"] == 'Admin' && $_SESSION['user']['isblocked'] !== '1') {
	try {
		if($data[4] !== "NULL") {
			$jurTypeId = Models\SellerJuridicEntityType::findTablesByField('type', $data[4])[0]->id;
			$seller->setValueToTable($data[0], 'jurTypeId', $jurTypeId);
			$seller->setValueToTable($data[0], 'jurType', NULL);
		} else if ($data[5] !== "NULL") {
			$seller->setValueToTable($data[0], 'jurTypeId', NULL);
			$seller->setValueToTable($data[0], 'jurType', $data[5]);
		}

		$seller->setValueToTable($data[0], 'jurName', $data[6]);

		$requisitesId = Seller::findById($data[0])->requisitesId;
		Models\SellerRequisites::setValueToTable($requisitesId, 'bank', $data[7]);
		Models\SellerRequisites::setValueToTable($requisitesId, 'currentAccountNumber', $data[8]);
		Models\SellerRequisites::setValueToTable($requisitesId, 'correspondentAccountNumber', $data[9]);
		Models\SellerRequisites::setValueToTable($requisitesId, 'BIK', $data[10]);
		Models\SellerRequisites::setValueToTable($requisitesId, 'INN', $data[11]);

		$juridicalAddressId = Models\SellerRequisites::findById($requisitesId)->juridicalAddressId;

		Models\Address::setValueToTable($juridicalAddressId, 'country', $data[13]);
		Models\Address::setValueToTable($juridicalAddressId, 'region', $data[14]);
		Models\Address::setValueToTable($juridicalAddressId, 'city', $data[15]);
		Models\Address::setValueToTable($juridicalAddressId, 'street', $data[16]);
		Models\Address::setValueToTable($juridicalAddressId, 'home', $data[17]);
		if($data[18] == "") {
			Models\Address::setValueToTable($juridicalAddressId, 'office', NULL);
		} else {
			Models\Address::setValueToTable($juridicalAddressId, 'office', $data[18]);
		}
		if($data[12] == "") {
			Models\Address::setValueToTable($juridicalAddressId, 'postIndex', NULL);
		} else {
			Models\Address::setValueToTable($juridicalAddressId, 'postIndex', $data[12]);
		}

		$facticalAddressId = Models\SellerRequisites::findById($requisitesId)->facticalAddressId;

		Models\Address::setValueToTable($facticalAddressId, 'country', $data[20]);
		Models\Address::setValueToTable($facticalAddressId, 'region', $data[21]);
		Models\Address::setValueToTable($facticalAddressId, 'city', $data[22]);
		Models\Address::setValueToTable($facticalAddressId, 'street', $data[23]);
		Models\Address::setValueToTable($facticalAddressId, 'home', $data[24]);
		if($data[25] == "") {
			Models\Address::setValueToTable($facticalAddressId, 'office', NULL);
		} else {
			Models\Address::setValueToTable($facticalAddressId, 'office', $data[25]);
		}
		if($data[19] == "") {
			Models\Address::setValueToTable($facticalAddressId, 'postIndex', NULL);
		} else {
			Models\Address::setValueToTable($facticalAddressId, 'postIndex', $data[19]);
		}

		$seller->setValueToTable($data[0], 'isTrading', $data[26]);
		$seller->setValueToTable($data[0], 'statusOfTrading', $data[27]);
		$seller->setValueToTable($data[0], 'isIncluded', $data[28]);
		$seller->setValueToTable($data[0], 'bankCode', $data[29]);
		
		echo 1;
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>