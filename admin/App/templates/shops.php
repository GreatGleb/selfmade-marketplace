<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'shops';
    header('Location: home');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админка</title>
    <link rel="stylesheet" href="App/templates/files/css/main.css">
    <link rel="stylesheet" href="App/templates/files/css/adminpanel.css">
    <link rel="stylesheet" href="App/templates/files/css/table.css">
	<link rel="stylesheet" href="App/templates/files/css/toggleSwitch.css">
    <link rel="stylesheet" href="App/templates/files/css/shops.css">
    <link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpAddNew.css">
	<link rel="stylesheet" href="App/templates/files/css/loadingImages.css">
</head>
<body>

    <!-- Админка -->
	<?php include __DIR__ . "/files/html/blocks/header.php";?>
	<?php include __DIR__ . "/files/html/blocks/leftMenu.php";?>

	<div class="<?php
					if($_SESSION['leftMenu'] == 'hidden') {
						echo "mainHtmlContent htmlContenToLeft";
					} else {
						echo "mainHtmlContent";
					}
				?>">
		<?php if($_SESSION['user']['isblocked'] !== '1') { ?>
			
			<h2 class="main-title">Магазины</h2>
		
			<div class="add_new_shop toggleModal0">Добавить<br>новый магазин</div>
		
		<div class="table_shops">
			<table class="content-table">
				<thead>
					<tr>
					<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
						<th>ФИО продавца</th>
					<?php } ?>
						<th>Название</th>
						<th>Дата добавления</th>
						<th>Разрешение<br>на продажу</th>
						<th>Статус<br>разрешения</th>
						<th>Статус<br>включения</th>
					</tr>
				</thead>
				<tbody>
					<?php
						  
					foreach ($shops as $shop) {
						
						echo '<tr>
								  <td class="none" data-id="' . $shop->id . '" ';
					
						if($shop->img) {
							echo "data-img-url=\"" . $shop->img->url . "\" ";
							
							$pos_ext = strripos($shop->img->name, '.');			
							$minuspos = strlen($shop->img->name)-$pos_ext-1;								
							$file_ext = strtolower(substr($shop->img->name, $pos_ext+1, $minuspos));			
							$file_name = substr($shop->img->name, 0, $pos_ext);								
							$file_name = $file_name . '_150x150.' . $file_ext;
							
							echo "data-img-name=\"" . $file_name  . "\"";
						}
						echo "data-phones";
						if($shop->phones) {
							echo "=\"[";
							foreach($shop->phones as $phone) {
								echo "'" . $phone->contact . "', ";
							}
							echo "']\" ";
						} else {
							echo " ";
						}
						
						echo "data-shop-description=\"";
						echo $shop->description;
						echo "\" ";
						
						echo "data-shop-url=\"";
						echo $shop->url;
						echo "\" ";
						
						echo "data-jur-selected-type=\"";
						echo $shop->seller->jurSelectedType;
						echo "\" ";
						
						echo "data-jur-type=\"";
						echo $shop->seller->jurType;
						echo "\" ";
						
						echo "data-jur-name=\"";
						echo $shop->seller->jurName;
						echo "\" ";
						
						echo "data-isTrading=\"";
						echo $shop->seller->isTrading;
						echo "\" ";
						
						echo "data-status-of-trading=\"";
						echo $shop->seller->statusOfTrading;
						echo "\" ";
						
						echo "data-is-included=\"";
						echo $shop->seller->isIncluded;
						echo "\" ";
						
						echo "data-shopIsTrading=\"";
						echo $shop->isTrading;
						echo "\" ";
						
						echo "data-shop-status-of-trading=\"";
						echo $shop->statusOfTrading;
						echo "\" ";
						
						echo "data-shop-is-included=\"";
						echo $shop->isIncluded;
						echo "\" >";
						
						echo '</td>';
						
						if($_SESSION['user']["typeofuser"] == 'Admin') {
							echo '<td class="full_name">' . $shop->user->full_name . '</td>';
						}
						
						echo ' <td class="name">' . $shop->name . '</td>';
						echo ' <td>' . $shop->date_added . '</td>';
						if($shop->seller->isTrading == "1" && $shop->isTrading == "1") {
							echo  '<td>Одобрен</td>';
						} else {
							echo  '<td>Неодобрен</td>';							
						}
						
						if($shop->seller->statusOfTrading !== NULL) {
							echo  '<td>' . $shop->seller->statusOfTrading . '</td>';
						} else if($shop->statusOfTrading !== NULL) {
							echo  '<td>' . $shop->statusOfTrading . '</td>';
						} else {
							echo '<td></td>';
						}
						
						if($shop->seller->isIncluded == "1" && $shop->isIncluded == "1") {
							echo  '<td>Включён</td>';
						} else {
							echo  '<td>Выключен</td>';							
						}
						echo "<td class=\"editShop\">
								<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
									<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>
								</svg><br>Редактировать
									</td>";
						echo "<td class=\"deleteShop\">
								<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
									<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"/><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/></g>
								</svg><br>Удалить
									</td>";
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		
		<div class="editing_shop none">
			<div class="header">
				<span>Редактирование магазина</span>
				<div class="save-shop">
					<svg width="25" height="25" fill="#fff">
						<svg title="change" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 -256 1792 1792" enable-background="new 0 0 1000 1000" xml:space="preserve">
							<g transform="matrix(1,0,0,-1,129.08475,1270.2373)">
								<path d="m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z"></path>
							</g>
						</svg>
					</svg>
				</div>
				<div class="reply-shop">
					<svg width="25" height="25" fill="#fff">
						<svg title="Отменить" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480.000000 480.000000" preserveAspectRatio="xMidYMid meet">
							<g transform="translate(0.000000,480.000000) scale(0.100000,-0.100000)" stroke="none">
								<path d="M1045 3285 c-567 -480 -1030 -878 -1030 -885 0 -7 463 -405 1030
								-885 l1030 -871 3 478 2 478 223 0 c721 0 1238 -98 1692 -320 264 -129 466
								-278 683 -504 l122 -128 0 80 c0 112 -18 364 -36 507 -128 1009 -597 1625
								-1410 1854 -278 78 -474 101 -921 108 l-353 6 -2 476 -3 477 -1030 -871z"/>
							</g>
						</svg>
					</svg>
				</div>
				<button class="close" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
					</svg>
				</button>
			</div>
			<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
				<div class="field editFio">
					<label>ФИО продавца:</label>
					<span class="input"></span>
				</div>
				<div class="field editJurName">
					<label>Юридическое название:</label>
					<span class="input"></span>
				</div>
			<?php } ?>
			<div class="field">				
				<label for="shop_name">Название магазина:</label>
				<div class="input">
					<input type="text" id="shop_name">
				</div>
			</div>
			<div class="field">				
				<label for="shop_description">Описание магазина:</label>
				<textarea type="text" id="shop_description">
				</textarea>
			</div>
			<div class="field editURL">				
				<label for="shop_url">URL магазина:</label>
				<div class="input">
					<input type="text" id="shop_url">
				</div>
			</div>
			<div class="field editPhoto">
				<label>Логотип магазина:</label>
				<div class="input">
				</div>
			</div>
			<div class="field editPhone">
				<label>Телефон(ы) для отслеживания покупок:</label>
				<div class="input"></div>
			</div>
			
			<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
			<div class="field editShopIsTrading">				
				<label>Разрешение на продажу для этого магазина:</label>
				<div class="input">
					<div class="isShow"></div>
				</div>
			</div>
			<div class="field">				
				<label for="shop_statusOfTrading">Статус разрешения для этого магазина:</label>
				<div class="input">
					<input type="text" id="shop_statusOfTrading">
				</div>
			</div>
			<div class="field editShopIsIncluded">				
				<label>Статус включения для этого магазина:</label>
				<div class="input">
					<div class="isShow"></div>
				</div>
			</div>
			<div class="field editIsTrading">				
				<label>Разрешение на продажу для продавца:</label>
				<div class="input">
					<div class="isShow"></div>
				</div>
			</div>
			<div class="field">				
				<label for="seller_statusOfTrading">Статус разрешения для продавца:</label>
				<div class="input">
					<input type="text" id="seller_statusOfTrading">
				</div>
			</div>
			<div class="field editIsIncluded">				
				<label>Статус включения для продавца:</label>
				<div class="input">
					<div class="isShow"></div>
				</div>
			</div>
			<?php } else { ?>
			    <div class="field editShopIsIncluded">				
			    	<label>Статус включения для этого магазина:</label>
			    	<div class="input">
			    		<div class="isShow"></div>
			    	</div>
		    	</div>
			<?php } ?>
		</div>
		
		<?php if($_SESSION['user']["typeofuser"] == 'Seller') {?>
			<script>
				let sellerJuridicName = "<?php echo $jurName; ?>";
			</script>
		<?php } ?>
		
		<!--Modal Window-->
		<div class="modalBlock toggleModal1" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Изменение фотографии</div>
				<div class="select-all">
					<svg width="19" height="19" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/select-all.svg" ?>
					</svg>					
				</div>
				<div class="delete-bin">
					<svg width="17" height="17"  viewBox="0 0 225.000000 225.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/delete-bin.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal1" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>

			<div id="drop-area">
				<div class="areaBackground">
						<input type="file" multiple accept="image/*" name="fileToUpload1" id="fileToUpload1" class="none">
						<div class="camera">
							<svg width="45" height="45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
								<?php include __DIR__ . "/files/img/icons/camera.svg" ?>
							</svg>
						</div>
						<div class="title">
							Отпустите, чтобы начать загрузку
						</div>
				</div>
			</div>
			
			<label class="modalLoadNewPhoto" for="fileToUpload1">
				<div class="title">
					<svg class="iconPlus" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
					<span>Загрузить новую фотографию</span> 
				</div>
			</label>
			
			<div class="modalBody">
				<div class="fileUploadError"></div>
				<div class="fileLoading"></div>
				
				<div class="windowAllImages">
				
					<div class="rowImages">
						<?php
							foreach ($images as $img) {								
								echo "<div class=\"imageCart\">
									<div class='hoverForSelect notSelect'>
									<div class='shadow'></div>
									<div class='before1'></div>
									<div class='before2'></div>
									<div class='after1'></div>
									<div class='after2'></div>
									<div class='selectImages'><div class='item'><div class='galka'></div></div></div>
								
								<img src='" . $img["url"];
								
								$pos_ext = strripos($img["name"], '.');			
								$minuspos = strlen($img["name"])-$pos_ext-1;								
								$file_ext = strtolower(substr($img["name"], $pos_ext+1, $minuspos));			
								$file_name = substr($img["name"], 0, $pos_ext);								
								$file_name = $file_name . '_150x150.' . $file_ext;
								
								$dataFileName = $img["name"];
					
								echo $file_name . "' alt='' class='avatarImages' width='153px' height = '153px' data-filename='";
								echo $dataFileName . "'></div></div>";
							}
						 ?>
					</div>	
				</div>
			</div>
			
		  </div>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock addNewTable toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Добавление нового магазина</div>
				<div class="save-new-table level2">
					<svg width="25" height="25" fill="#fff">
						<?php include __DIR__ . "/files/img/icons/save.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal0" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
					<div class="juridic_name">
						<label for="addNewSeller_jurName">Юридическое название зарегестрированного продавца:</label>
						<div class="input">
							<input type="text" id="addNewSeller_jurName">
						</div>
					</div>
					<div class="title_for_input">
						Пишется без кавычек. Для ИП - ФИО.
					</div>
				<?php } ?>
				<div class="addNewSeller_shopName">
					<label for="addNewSeller_nameOfShop">Название магазина:</label>
					<input type="text" id="addNewSeller_nameOfShop">
				</div>
				<div class="title_for_input">
					В данном пункте пишем только название магазина по которому продавец хотел бы, чтобы его искали в Яндексе и которое будет размещено на странице магазина в Saterno. (Это не название ИП или юр. лица, а бренд магазина)
				</div>
				<div class="addNewSeller_URLShop">
					<label for="addNewSeller_URLShop">URL магазина:</label>
					<input type="text" id="addNewSeller_URLShop">
				</div>
				<div class="title_for_input">
					В данном пункте пишем то, как продавец хотел бы, чтобы писался адрес его магазина в адресной строке, по типу: www.saterno.ru/vashadresmagazina,
					где URL это vashadresmagazina, без обратного слеша /
				</div>
				<div class="addNewSeller_descriptionOfShop">
					<label for="addNewSeller_descriptionOfShop">Описание магазина:</label>
					<textarea type="text" id="addNewSeller_descriptionOfShop"></textarea>
				</div>
				<div class="title_for_input">
					Этот текст будет в описании магазина на его странице в Saterno. 
					Описание должно быть уникальным, не скопированным из сети.
				</div>
				<div class="addNewSeller_logoOfShop">
					<label>Логотип магазина:</label>
					<img src="App/templates/files/img/shops/default.png" width="50px" height="50px">
					<svg class="toggleModal3 level2" width="15px" height="15px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
						<g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g>
					</svg>
				</div>
				<div class="title_for_input">
					Логотип появится на странице магазина в Saterno.					
				</div>
				<div class="addNewSeller_phone">
					<label for="addNewSeller_phoneCode">Телефон(ы) для отслеживания покупок:</label>
					<div>
						<div class="input">
							<div class="code">
								<input type="text" id="addNewSeller_phoneCode" value="+">
								<label for="addNewSeller_phoneCode">Код страны</label>
							</div>
							<div class="number">
								<input type="text" id="addNewSeller_phone">
								<label for="addNewSeller_phone">Номер телефона</label>
							</div>
						</div>
					</div>					
				</div>
				<div class="title_for_input">
					В данном пункте пишем телефон(ы), куда смогут звонить покупатели для отслеживания покупок или консультаций.
				</div>
			</div>
			
		  </div>
		</div>
		
		
		<!--Modal Window-->
		<div class="modalBlock loadNewLogoOfShop toggleModal3 level2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Изменение фотографии</div>
				<div class="select-all">
					<svg width="19" height="19" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/select-all.svg" ?>
					</svg>					
				</div>
				<div class="delete-bin">
					<svg width="17" height="17"  viewBox="0 0 225.000000 225.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/delete-bin.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal3 level2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>

			<div id="drop-area">
				<div class="areaBackground">
						<input type="file" accept="image/*" name="fileToUpload3" id="fileToUpload3" class="none">
						<div class="camera">
							<svg width="45" height="45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
								<?php include __DIR__ . "/files/img/icons/camera.svg" ?>
							</svg>
						</div>
						<div class="title">
							Отпустите, чтобы начать загрузку
						</div>
				</div>
			</div>
			
			<label class="modalLoadNewPhoto" for="fileToUpload3">
				<div class="title">
					<svg class="iconPlus" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
					<span>Загрузить новую фотографию</span> 
				</div>
			</label>
			
			<div class="modalBody">
				<div class="fileUploadError"></div>
				<div class="fileLoading"></div>
				
				<div class="windowAllImages">
				
					<div class="rowImages">
					</div>	
				</div>
			</div>
			
		  </div>
		</div>

		<?php } ?>
		
		<div class="modalBlock error toggleModal2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<p>Ошибка</p>
			</div>
			
		  </div>
		</div>
		<div class="modalBlock error toggleModal4 level2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal4 level2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<p>Ошибка</p>
			</div>
			
		  </div>
		</div>
		<div class="modalBlock error toggleModal5 level3" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal5 level3" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<p>Ошибка</p>
			</div>
			
		  </div>
		</div>
		<div class="modalBlock error warning toggleModal6" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error warning">
			<div class="modalHeaderError">
				<div class="title">Предупреждение</div>
				<button class="modal__close error toggleModal6" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>Ошибка</div>
				<div class="buttons">
					<div class="ok">Да</div>
					<div class="cancel toggleModal6">Нет</div>
				</div>
			</div>
			
		  </div>
		</div>
		
		<div id="cover"></div>
		<div id="cover2"></div>
		<div id="cover3"></div>
		
	</div>
	
	
	
	<script>
		let entityTypes = [];
		<?php
			if($entitytypes !== NULL) {
				foreach ($entitytypes as $entityType) {
					echo "entityTypes.push([\"";
					
					foreach ($entityType as $prop => $value) {
						if($prop !== "type") {
							echo $value . "\", \"";
						} else {
							echo $value;
						}
					}
					
					echo "\"]);";
				}
			}
		?>
	</script>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/tableHead.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/loadingImagesInPopUp.js"></script>
	<script src="App/templates/files/js/shopsImagesPopUp.js"></script>
	<script src="App/templates/files/js/closeEditingShop.js"></script>
	<script src="App/templates/files/js/saveEditingShop.js"></script>
	<script src="App/templates/files/js/editShop.js"></script>
	<script src="App/templates/files/js/addNewShop.js"></script>

</body>
</html>