<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\Models\Categories;
use App\Models\ImagesForCategory;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$idCategory = $data;

$category = new Categories();
$category->id = $idCategory;

session_start();

$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']["typeofuser"] == 'Admin' && $_SESSION['user']['isblocked'] !== '1') {

	try {
		$childСategories = $category->findTablesByField('parent_categoryId', $idCategory);

		for($i = 0; $i < sizeof($childСategories); $i++) {
			$categoryChild = $childСategories[$i];		
			$categoryChild->setValueToTable($categoryChild->id, 'parent_categoryId', NULL);
		}
		
		$imagesOfCategory = new ImagesForCategory();
		$findedImages = $imagesOfCategory->findTablesByField('categoryId', $idCategory);
		
		for($i = 0; $i < sizeof($findedImages); $i++) {
			$imageOfCategory = $findedImages[$i];		
			$imageOfCategory->delete();
		}
		
		$shopProductShowInCategories = Models\ShopProductShowInCategories::findTablesByField('categoryId', $idCategory);
		
		foreach($shopProductShowInCategories as $productShowInCategories) {
			if($productShowInCategories !== NULL) {
				$productShowInCategories->delete();
			}
		}
		
		$shopProductMainCategory = Models\ShopProduct::findTablesByField('mainCategoryId', $idCategory);
		
		foreach($shopProductMainCategory as $productMainCategory) {
			if($productMainCategory !== NULL) {
				$productMainCategory->setValueToTable($productMainCategory->id, 'mainCategoryId', NULL);
			}
		}
		
		if($category->delete()) {
			echo 'Удаление категории было успешно завершено.';
		} else {
			return false;
		}
		
	} catch (PDOException $e) {
		var_dump($e);
	}
} else {
	return false;
}
?>