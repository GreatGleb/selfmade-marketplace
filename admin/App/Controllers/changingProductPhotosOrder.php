<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

session_start();

$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
	
$fieldsImages = explode(",", $data);

if($_SESSION['user']['isblocked'] !== '1') {
	try {
		
		$isGood;
		
		for ($i = 0; $i < sizeof($fieldsImages); $i = $i + 3) {
			
			$imageId = Models\Images::findImage($fieldsImages[$i + 1], $fieldsImages[$i])->id;

			$imageForTable = new Models\ShopProductImages();
			$imagesForTable = $imageForTable->findImageOfTable($imageId)[0];
			
			if($imagesForTable->setValueToTable($imagesForTable->id, 'orderNumber', $fieldsImages[$i + 2])) {
				$isGood = true;
			} else {
				$isGood = false;
			}
		}
		
		if($isGood) {
			echo 1;
		}			
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}

?>