<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\Images;
use App\Models\ImagesForAdmin;
use App\SimpleImage;
use App\MultiException;

session_start();
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

if($_SESSION['user']['isblocked'] !== '1') {		
	if (isset($_FILES['file'])) {
		$model = 'App\Models\\' . $_POST['table'];
		$tableField = $_POST['tableField'];

		$img_path = $_POST['path'];
		$target_dir = realpath(__DIR__ . "/../../admin/App/templates/files/img/" . $img_path);
		$target_dir = $target_dir . "//";
		$file_name = basename($_FILES["file"]["name"]);
		$uploadOk = 1;
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
		
		$pos_ext = strripos($file_name, '.');			
		$minuspos = strlen($file_name)-$pos_ext-1;
		
		$file_ext = strtolower(substr($file_name, $pos_ext+1, $minuspos));			
		$file_name = substr($file_name, 0, $pos_ext);
		
		$file_name = $file_name . '.' . $file_ext;
		
		function fileExisting($target_dir, $file_name, int $num)
		{
			$target_file = $target_dir . $file_name;
			
			if (file_exists($target_file)) {
				if($num <= 2) {
					$pos_ext = strripos($file_name, '.');			
					$minuspos = strlen($file_name)-$pos_ext-1;
					
					$file_ext = substr($file_name, $pos_ext+1, $minuspos);			
					$file_name = substr($file_name, 0, $pos_ext);
					
					$file_name = $file_name . '(' . $num++ . ').' . $file_ext;
										
					return fileExisting($target_dir, $file_name, $num);
				} else {
					$old_num = $num-1 . "";
					$pos = strripos($file_name, $old_num);	
					$pos2 = strripos($file_name, ')');	
					
					$file_name1 = substr($file_name, 0, $pos);
					$file_name2 = substr($file_name, $pos2);
					
					$file_name = $file_name1 . $num++ . $file_name2;
										
					return fileExisting($target_dir, $file_name, $num);
				}			
			} else {			
				return $file_name;
			}
		}
		
		$file_name = fileExisting($target_dir, $file_name, 2);
		
		$target_file = $target_dir . $file_name;
		
		if ($uploadOk == 0) {
				echo "File is not an image.";
		} else {
			try {
				$image = new Images();
				
				$newIdForImages = $image->findMaxId() + 1;
				$image->id = $newIdForImages;
				$image->name = $file_name;
				$image->url = 'App/templates/files/img/' . $img_path;
				if($image->insert()) {
					
					$imageForTable = new $model();
					
					$newIdForImageForTable = $imageForTable->findMaxId() + 1;				
					$imageForTable->id = $newIdForImageForTable;
					
					$imageForTable->$tableField = $_POST['valueTableField'];
					
					$imageForTable->imageId = $newIdForImages;
					if($img_path !== "products/" && $img_path !== "product-attributes/") {
						$imageForTable->isCurrent = 0;
					} else if($img_path == "products/") {
						$fieldMaxOrderNumber = 'MAX(orderNumber)';
						$maxOrderNumber = $imageForTable::findMaxField('orderNumber', $tableField, $_POST['valueTableField'])->$fieldMaxOrderNumber;
						$imageForTable->orderNumber = $maxOrderNumber + 1;
					}
					
					if($imageForTable->insert()) {
						$image_info = getimagesize($_FILES['file']['tmp_name']);
						$image_type = $image_info[2];
						
						$pos_ext = strripos($file_name, '.');			
						$minuspos = strlen($file_name) - $pos_ext-1;
						
						$file_ext = strtolower(substr($file_name, $pos_ext+1, $minuspos));			
						$file_nameWithoutExt = substr($file_name, 0, $pos_ext);
						
						$short_file_name = $file_nameWithoutExt . '_150x150.' . $file_ext;
						$target_short_file = $target_dir . $short_file_name;
						
						//var_dump($_FILES['file']);
						$short_image = new SimpleImage();
						$short_image->load($_FILES['file']['tmp_name']);
						$short_image->resize(150, 150);
						
						$image_info = getimagesize($_FILES['file']['tmp_name']);
						$image_type = $image_info[2];
						
						$pos_ext = strripos($file_name, '.');			
						$minuspos = strlen($file_name)-$pos_ext-1;
						
						$file_ext = strtolower(substr($file_name, $pos_ext+1, $minuspos));			
						$file_nameWithoutExt = substr($file_name, 0, $pos_ext);
						
						$short_file_name = $file_nameWithoutExt . '_150x150.' . $file_ext;
						$target_short_file = $target_dir . $short_file_name;
						
						$isSaveShort_image = $short_image->save($target_short_file, $image_type);
						
						if($img_path == "products/") {
							/*
							$short_image = new SimpleImage();
							$short_image->load($_FILES['file']['tmp_name']);
							$short_image->resize(150, 150);
							
							$ox1 = 150;
							$oy1 = 150;
							
							$targetWatermatk1 = realpath(__DIR__ . "/../templates/files/img/main/");
							$targetWatermatk1 = $targetWatermatk1 . "//";
							$imageWithWaterMark1 = imagecreatefrompng($targetWatermatk1 . "watermarkv2_02.png");
							
							// Установка полей для штампа и получение высоты/ширины штампа
							$sx1 = imagesx($imageWithWaterMark1);
							$sy1 = imagesy($imageWithWaterMark1);
							
							$im1 = imagecreatetruecolor($ox1,$oy1);
							// Prepare alpha channel for transparent background
							$alpha_channel1 = imagecolorallocatealpha($im1, 0, 0, 0, 127); 
							imagecolortransparent($im1, $alpha_channel1); 
							// Fill image
							imagefill($im1, 0, 0, $alpha_channel1); 
							// Copy from other
							imagecopy($im1,$imageWithWaterMark1, 0, 0, 0, 0, $sx1, $sy1); 
							// Save transparency
							imagesavealpha($im1,true);
							
							// Слияние штампа с фотографией. Прозрачность 50%
							imagecopymerge($short_image->image, $im1, $ox1/2 - $sx1/2, $oy1 - $sy1, 0, 0, $sx1, $sy1, 30);

							// Сохранение фотографии в файл и освобождение памяти
							if(imagepng($short_image->image, $target_dir . $file_nameWithoutExt . '_waterMark_150x150.' . $file_ext)) {
							
								imagedestroy($short_image->image);
							*/	
								if( $image_type == IMAGETYPE_JPEG ) {
									$originalImg = imagecreatefromjpeg($_FILES['file']['tmp_name']);
								} elseif( $image_type == IMAGETYPE_PNG ) {
									$originalImg = imagecreatefrompng($_FILES['file']['tmp_name']);
								}
								$ox = imagesx($originalImg);
								$oy = imagesy($originalImg);
								
								$targetWatermatk = realpath(__DIR__ . "/../templates/files/img/main/");
								$targetWatermatk = $targetWatermatk . "//";
								$imageWithWaterMark = imagecreatefrompng($targetWatermatk . "watermarkv2_02.png");
								
								// Установка полей для штампа и получение высоты/ширины штампа
								$sx = imagesx($imageWithWaterMark);
								$sy = imagesy($imageWithWaterMark);
								
								$im = imagecreatetruecolor($sx,$sy);
								// Prepare alpha channel for transparent background
								$alpha_channel = imagecolorallocatealpha($im, 0, 0, 0, 127); 
								imagecolortransparent($im, $alpha_channel); 
								// Fill image
								imagefill($im, 0, 0, $alpha_channel); 
								// Copy from other
								imagecopy($im,$imageWithWaterMark, 0, 0, 0, 0, $sx, $sy); 
								// Save transparency
								imagesavealpha($im,true);
								
								// Слияние штампа с фотографией. Прозрачность 50%
								imagecopymerge($originalImg, $im, $ox - $sx - 10, $oy - $sy - 10, 0, 0, $sx, $sy, 30);

								// Сохранение фотографии в файл и освобождение памяти
								if (imagepng($originalImg, $target_file)) {
									echo $file_name;
								} else {
									$imageForTable->delete();
									$image->delete();
									
									if(file_exists($target_short_file)) unlink($target_short_file);
									
									echo "Sorry, there was an error uploading your file.";
								}
								  
								imagedestroy($originalImg);
								imagedestroy($im);
							//}
						} else {
							if($isSaveShort_image) {
								if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
									echo $file_name;
								} else {
									$imageForTable->delete();
									$image->delete();
									
									if(file_exists($target_short_file)) unlink($target_short_file);
									
									echo "Sorry, there was an error uploading your file.";
								}
							} else {
								$imageForTable->delete();
								$image->delete();
								echo "Sorry, there was an error uploading your file.";
							}
						}
					} else {
						$image->delete();
						echo "Sorry, there was an error uploading your file.";
					}	
				} else {
					echo "Sorry, there was an error uploading your file.";
				}	
				
			} catch (PDOException $e) {
				var_dump($e);
			}			
		}
	}
}

?>