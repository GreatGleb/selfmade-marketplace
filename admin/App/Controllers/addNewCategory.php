<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\Categories;
use App\MultiException;

try {	
	session_start();

	$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
	$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
		
	if ($_SESSION['user']['isfounder'] > 0
		|| ($_SESSION['user']["typeofuser"] == 'Admin'
			&& $_SESSION['user']['isblocked'] !== '1')) {
						
		$data = file_get_contents( "php://input" );
		$data = json_decode( $data );

		for($i = 0; $i < sizeof($data); $i++) {
			if(strlen($data[$i]) == 0) {
				$data[$i] = NULL;
			}
		}

		$name = $data[0]; 
		$description = $data[1]; 
		$parentCategory = $data[2]; 
		$htmlTitle = $data[3]; 
		$metaKeywords = $data[4]; 
		$url = $data[5]; 
		$statusOfCategory = $data[6]; 

		$categories = new Categories();

		$newId = $categories->findMaxId() + 1;
		$categories->id = $newId;
		$categories->name = $name;
		$categories->description = $description;
		$categories->title = $htmlTitle;
		$categories->keywords = $metaKeywords;
		if(strlen($parentCategory) > 0) {
			$categories->parent_categoryId = $parentCategory;
		}		
		$categories->url = $url;
		$categories->isShow = $statusOfCategory;

		if($categories->insert()) {
			echo $categories->id;
		} else {
			return false;
		}
	}
} catch (PDOException $e) {
	var_dump($e);
}	
	
?>