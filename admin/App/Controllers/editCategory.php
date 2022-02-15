<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\Categories;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

session_start();

$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']["typeofuser"] == 'Admin' && $_SESSION['user']['isblocked'] !== '1') {
		
	$idCategory = $data[0]; 
	$name = $data[1]; 
	$description = $data[2]; 
	$parentCategory = $data[3]; 
	$htmlTitle = $data[4]; 
	$metaKeywords = $data[5]; 
	$url = $data[6]; 
	$statusOfCategory = $data[7]; 

	$categories = new Categories();
	try {
		$categories->setValueToTable($idCategory, 'name', $name);
		$categories->setValueToTable($idCategory, 'description', $description);
		$categories->setValueToTable($idCategory, 'title', $htmlTitle);
		$categories->setValueToTable($idCategory, 'keywords', $metaKeywords);

		if(strlen($parentCategory) > 0 ) {
			$categories->setValueToTable($idCategory, 'parent_categoryId', $parentCategory);
		} else {
			$categories->setValueToTable($idCategory, 'parent_categoryId', NULL);
		}

		$categories->setValueToTable($idCategory, 'url', $url);

		if($statusOfCategory == "Выключено") {
			$categories->setValueToTable($idCategory, 'isShow', '0');
		} else {
			$categories->setValueToTable($idCategory, 'isShow', '1');
		}
		
		echo 'Изменение категории было успешно сохраненно.';
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}
?>