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

	$model = 'App\Models\\' . $data[1];
	$imagesUrl = 'App/templates/files/img/' . $data[4];

	$image = new Images();
	$image->id = $image->findImage($data[0], $imagesUrl)->id;

	$imageForTable = new $model();
	$imagesForTable = $imageForTable->findImageOfTable($image->id);
	$isDeleted = true;
	
	foreach($imagesForTable as $table) {
		$imageForTable->id = $table->id;
		
		if($imageForTable->delete() == false) {
			$isDeleted = false;
		}
	}

	if($isDeleted) {
		if($image->delete()) {

			$target_dir = realpath(__DIR__ . "/../templates/files/img/" . $data[4]);
			$target_dir = $target_dir . "//";

			$imgName = $data[0];

			echo $data[0];
			
			deleting($imgName, $target_dir);
		}
	} else {
		return false;
	}
} else {
	return false;
}

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
	//echo $img." файл удален";  
}

?>