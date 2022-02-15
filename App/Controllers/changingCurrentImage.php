<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\Images;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data ); 

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1') {

	$model = 'App\Models\\' . $data[2];

	$imageForTable = new $model();

	if(strlen($data[0]) > 0 ) {
		if($imageForTable->unSetCurrentImage($data[3], $data[4])) {

			$path = "App/templates/files/img/" . $data[5];
			
			$image = new Images();
			$image->id = $image->findImage($data[0], $path)->id;
					
			if($imageForTable->findConcretImageOfTable($data[4], $data[3], $image->id) == NULL) {
				$newIdForImageForTable = $imageForTable->findMaxId() + 1;	
				$idForImage	 = Images::findImage($data[0], $path)->id;
				$imageForTable->id = $newIdForImageForTable;
				$tableField = $data[3];
				$imageForTable->$tableField = $data[4];	
				$imageForTable->imageId = $idForImage;
				$imageForTable->isCurrent = 0;
				$imageForTable->insert();
			}
			
			if($imageForTable->setCurrentImage($data[3], $data[4], $data[0], $path)) {
				if($data[2] == 'ImagesForAdmin') {
					session_start();
					$_SESSION['user']['avatar_name'] = $data[0];
					$_SESSION['user']['avatar_url'] = "App/templates/files/img/accounts/";
					
					echo 'Текущее изображение в профиле пользователя изменено. ';
				}
				
				echo 1;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	} else if(strlen($data[1]) > 0 ) {
		if($imageForTable->unSetCurrentImage($data[3], $data[4])) {
			if($data[2] == 'ImagesForAdmin') {
				$_SESSION['user']['avatar_name'] = "user.png";
				$_SESSION['user']['avatar_url'] = "App/templates/files/img/accounts/";
			}
			
			echo 1;
		} else {
			return false;
		}
	}
} else {
	return false;
}
?>