<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'goods';
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
	<link rel="stylesheet" href="App/templates/files/css/calendar.css">
    <link rel="stylesheet" href="App/templates/files/css/goods.css">
    <link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpAddNew.css">
	<link rel="stylesheet" href="App/templates/files/css/loadingImages.css">
	<link rel="stylesheet" href="App/templates/files/css/pagination.css">
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
			
			<h2 class="main-title">Товары</h2>
		
			<div class="add_new_good toggleModal0">Добавить<br>новый товар</div>
		    
		    <div class="pagination pag_1">
              <span class="biggerTxt" id="pag_start_2">«</span>
              <span class="biggerTxt" id="pag_prev_2">‹</span>
              <span data-page="1" id="pag_page1_2" class="paginator_active activePage">1</span>
              <span data-page="2" id="pag_page2_2" class="">2</span>
              <span data-page="center" id="pag_page3_2" class="">...
                <div style="position: absolute;right: 0;width: 90%;padding: 6px;border: 3px solid black;border-radius: 10px;background-color: #d6d6d6; display: none;">
                    <?php
                        for($countI = 3; $countI < $lastPage - 1; $countI++) {
                            echo '<span data-page="' . $countI . '">' . $countI . '</span>';
                        }
                    ?>
                </div>
              </span>
              <span data-page="next" id="pag_page4_2" class=""><?php echo $lastPage - 1 ?></span>
              <span data-page="end" id="pag_page5_2" class=""><?php echo $lastPage ?></span>
              <span class="biggerTxt" id="pag_next_2">›</span>
              <span class="biggerTxt" id="pag_end_2">»</span>
            </div>
		    
		<div class="table_goods">
			<table class="content-table">
				<thead>
					<tr>
						<th>Фото</th>
						<th>Название</th>
						<th>Статусы</th>
						<th>Количество</th>
						<th>Цена</th>
						<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
							<th>Юр. название фирмы продавца</th>
						<?php } ?>
						<th>Категории</th>		
						<th>Дата<br>добавления</th>
					</tr>
				</thead>
				<tbody <?php echo 'data-all-categories="';
						if(is_array($allCategories)) {
							foreach($allCategories as $category) {
								echo $category->id . ",";
								echo $category->name. '|';
							}
						}
						echo '" ';?>>
					<?php
					echo '<div class="none">';
						var_dump($products);
					echo '</div>';
					foreach ($products as $product) {
						
						echo '<tr>
								  <td class="none" data-id="' . $product->id . '" ';
						echo 'data-seller-fio="' . $product->seller->fio . '" ';
						echo 'data-shop-name="' . $product->shop->name . '" ';
						echo 'data-is-included="';
						if($product->isIncluded == "1") {
							echo  '1" ';
						} else {
							echo  '0" ';							
						}
						echo 'data-istrading="';
						if($product->isTrading == "1") {
							echo  '1" ';
						} else {
							echo  '0" ';							
						}
						echo 'data-status-of-trading';
						echo '="' . $product->statusOfTrading . '" ';
						echo 'data-good-type="' . $product->typeProduct . '" ';
						echo 'data-good-brand="' . $product->brand->brand . '" ';
						echo 'data-good-brand-url="' . $product->brand->url . '" ';
						echo 'data-good-model="' . $product->model . '" ';
						echo 'data-good-photos="';
						if($product->images != NULL) {
    						foreach($product->images as $image) {
    							echo $image->url;
    							/*
    							$pos_ext = strripos($image->name, '.');			
    							$minuspos = strlen($image->name)-$pos_ext-1;								
    							$file_ext = strtolower(substr($image->name, $pos_ext+1, $minuspos));			
    							$file_name = substr($image->name, 0, $pos_ext);								
    							$file_name = $file_name . '_150x150.' . $file_ext;
    							*/
    							echo $image->name . "|" . $image->orderNumber . ",";
    						}
						}
						echo "\" ";
						echo 'data-good-description="' . $product->description . '" ';
						echo 'data-good-url="' . $product->url . '" ';
						echo 'data-good-seller-price="' . $product->sellerPrice . '" ';
						echo 'data-good-system-price="' . $product->systemPrice . '" ';
						
						echo 'data-good-quantity="' . $product->quantity . '" ';
						echo 'data-good-orderquantity="' . $product->minOrderQuantity . '" ';
						echo 'data-good-instock="' . $product->isInStock . '" ';
						
						echo 'data-good-length="' . $product->length . '" ';
						echo 'data-good-width="' . $product->width . '" ';
						echo 'data-good-height="' . $product->height . '" ';
						echo 'data-good-weight="' . $product->weight . '" ';
						echo 'data-good-stockroom="' . $product->stockroomId . '" ';
						
						echo 'data-stockrooms="';
						
						foreach($product->stockrooms as $stockroom) {
							echo $stockroom->id . ",";
							echo $stockroom->address->country . ",";
							echo $stockroom->address->region . ",";
							echo $stockroom->address->city . ",";
							echo $stockroom->address->street . ",";
							echo $stockroom->address->home;
							if($stockroom->address->office != NULL && $stockroom->address->office != "" && $stockroom->address->office != " ") {
								echo "," . $stockroom->address->office;
							}
							echo "|";
						}
						echo '" ';
						echo 'data-good-articul="' . $product->stockCode . '" ';
						echo 'data-good-categoryid="' . $product->category->id . '" ';
						echo 'data-good-category="' . $product->category->name . '" ';
						echo 'data-good-categories="';
						if(is_array($product->categories)) {
							foreach($product->categories as $category) {
								echo $category->id . ",";
								echo $category->name. '|';
							}
						}
						echo '" ';
						/*echo 'data-all-categories="';
						if(is_array($product->allCategories)) {
							foreach($product->allCategories as $category) {
								echo $category->id . ",";
								echo $category->name. '|';
							}
						}
						echo '" ';*/
						echo 'data-atributes="';
						if(is_array($product->atributes)) {
							foreach($product->atributes as $atribute) {
								echo $atribute . "]]]";
							}
						}
						echo '" ';
						echo 'data-disconts="';
						if($product->disconts != NULL) {
							echo $product->disconts;
						}
						echo '" ';
						echo ">";
						
						echo '</td>
							  <td class="image">';
						if($product->image !== NULL) {
							echo '<img src="' . $product->image->url;
							  /*
							$pos_ext = strripos($product->image->name, '.');			
							$minuspos = strlen($product->image->name)-$pos_ext-1;								
							$file_ext = strtolower(substr($product->image->name, $pos_ext+1, $minuspos));			
							$file_name = substr($product->image->name, 0, $pos_ext);								
							$file_name = $file_name . '_150x150.' . $file_ext;
                                */
							$dataFileName = $product->image->name;
							  
							echo $product->image->name  . '" alt="" data-filename="' . $dataFileName . '" width="50px" height="50px">';
						}
						echo '</td>';
						echo ' <td class="name">' . $product->typeProduct . " " . $product->model . '</td>';// . " " . $product->brand
						echo  '<td>';
						if($product->seller->isIncluded == "1" 
							&& $product->shop->isIncluded == "1"
							&& $product->isIncluded == "1") {
							echo  'Статус включения:<br>включён<br><br>';
						} else {
							echo  'Статус включения:<br>выключен<br><br>';							
						}
						if($product->seller->isTrading == "1"
							&& $product->shop->isTrading == "1"
							&& $product->isTrading == "1") {
							echo  'Разрешение на продажу:<br>одобрен';
						} else {
							echo  'Разрешение на продажу:<br>неодобрен';							
						}
						echo  '</td>';
						echo ' <td class="quantity">
							<span class="all_quantity">Всего: ' . $product->quantity . ' шт.</span><br><br>
							<span class="trade_quantity">Продажа: от ' . $product->minOrderQuantity . ' шт.</span>						
						</td>';
						echo ' <td class="price">Цена продавца: ' . $product->sellerPrice . '<br><br>Цена Saterno: ' . $product->systemPrice . '</td>';
						
						if($_SESSION['user']["typeofuser"] == 'Admin') {
							echo ' <td class="jur"> Магазин: ' . $product->shop->name . '<br><br>';
							if($product->seller->jurSelectedType != NULL) {
								$product->jurType = $product->seller->jurSelectedType;
							} else {
								$product->jurType = $product->seller->jurType;
							}
							echo 'Юр. лицо:<br><span class="jurName">' . $product->jurType . ' «‎' . $product->seller->jurName . '»‎</span></td>';
						}
						
						echo ' <td class="categories">';
						echo $product->category->name. '<br>';
						if(is_array($product->categories)) {
							foreach($product->categories as $category) {
								echo $category->name. '<br>';
							}
						}						
						echo '</td>';
						echo '<td class="date">' . $product->date_added . '</td>';						
						echo "<td>
								<div class=\"editGood\">
									<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
										<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>
									</svg><br>Редактировать
								</div>";
						echo "<div class=\"deleteGood\">
									<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
										<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"/><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/></g>
									</svg><br>Удалить
								<div>
									</td>";
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	    
	    <div class="pagination">
          <span class="biggerTxt" id="pag_start">«</span>
          <span class="biggerTxt" id="pag_prev">‹</span>
          <span data-page="1" id="pag_page1" class="paginator_active activePage">1</span>
          <span data-page="2" id="pag_page2" class="">2</span>
          <span data-page="center" id="pag_page3" class="">...
            <div style="position: absolute;right: 0;width: 90%;padding: 6px;border: 3px solid black;border-radius: 10px;background-color: #d6d6d6; display: none;">
                <?php
                    for($countI = 3; $countI < $lastPage - 1; $countI++) {
                        echo '<span data-page="' . $countI . '">' . $countI . '</span>';
                    }
                ?>
            </div>
          </span>
          <span data-page="next" id="pag_page4" class=""><?php echo $lastPage - 1 ?></span>
          <span data-page="end" id="pag_page5" class=""><?php echo $lastPage ?></span>
          <span class="biggerTxt" id="pag_next">›</span>
          <span class="biggerTxt" id="pag_end">»</span>
        </div>
	    	
		<div class="editing_good none">
			<div class="header">
				<span>Редактирование товара</span>
				<div class="save-good">
					<svg width="25" height="25" fill="#fff">
						<svg title="change" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 -256 1792 1792" enable-background="new 0 0 1000 1000" xml:space="preserve">
							<g transform="matrix(1,0,0,-1,129.08475,1270.2373)">
								<path d="m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z"></path>
							</g>
						</svg>
					</svg>
				</div>
				<div class="reply-good">
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
					<label>Юридическое лицо:</label>
					<span class="input"></span>
				</div>
			<?php } ?>
			<div class="field editShop">				
				<label>Название магазина:</label>
				<div class="input">
					<span class="input"></span>
				</div>
			</div>
			<div class="field editDateAdd">				
				<label>Дата добавления товара:</label>
				<div class="input">
					<span class="input"></span>
				</div>
			</div>
			<div class="field editGoodName">				
				<label for="good_name">Название товара:</label>
				<span class="input"></span>
			</div>
			<div class="field editGoodType">				
				<label for="good_type">Наименование товара:</label>
				<div class="input">
					<input type="text" id="good_type">
				</div>
			</div>
			<div class="field editGoodBrand">				
				<label for="good_brand">Бренд производителя:</label>
				<div class="input">
					<input type="text" id="good_brand">
				</div>
			</div>
			<div class="field editGoodModel">				
				<label for="good_model">Модель товара:</label>
				<div class="input">
					<input type="text" id="good_model">
				</div>
			</div>
			<div class="field editGoodUrl">				
				<label for="good_page">Страница товара:</label>
				<div class="input">
					<a class="good_page" target="_blank"></a>
				</div>
			</div>
			<div class="field editPhoto">
				<label>Фотографии товара:</label>
				<div class="input">
				</div>
			</div>
			<div class="field">				
				<label for="good_description">Описание товара:</label>
				<div class="input" style="position: inherit;left: 180px;top: -16px;">
					<textarea type="text" id="good_description"></textarea>
				</div>
			</div>
			<div class="field editURL">				
				<label for="good_url">URL товара:</label>
				<div class="input">
					<input type="text" id="good_url">
				</div>
			</div>
			<div class="field editPrice">				
				<label for="good_seller_price">Цена товара:</label>
				<div class="input">
					<label for="good_seller_price">Цена продавца:</label>
					<input type="text" id="good_seller_price">
					<br>
					<br>
					<label>Цена Saterno:</label>
					<span class="good_system_price"></span>
				</div>
			</div>
			<div class="field editQuentity">				
				<label for="good_all_quentity">Количество товара:</label>
				<div class="input">
					<label for="good_all_quentity">Всего:</label>
					<input type="number" id="good_all_quentity">
					<br>
					<br>
					<label for="good_sold_quentity">Продажа:</label>
					от
					<input type="number" id="good_sold_quentity">
				</div>
			</div>
			<div class="field editInStock">				
				<label>Наличие:</label>
				<div class="input">
					<div class="isShow">Есть в наличии</div>
					<label class="switch">
					<input type="checkbox" checked="">
					<span class="slider round"></span>
					</label>
				</div>
			</div>
			<div class="field editSize">				
				<label for="good_length">Размеры товара<br>(в сантиметрах):</label>
				<div class="input">
					<label for="good_length">Длина:</label>
					<input type="number" id="good_length">
					<br>
					<br>
					<label for="good_width">Ширина:</label>
					<input type="number" id="good_width">
					<br>
					<br>
					<label for="good_height">Высота:</label>
					<input type="number" id="good_height">
				</div>
			</div>
			<div class="field editGoodWeight">				
				<label for="good_weight">Вес товара<br>(в граммах):</label>
				<div class="input">
					<input type="number" id="good_weight">
				</div>
			</div>
			<div class="field editStock">				
				<label for="good_stock">Склад:</label>
				<div class="input">
					<select id="good_stock">
						<option value="" disabled="">Выберите склад</option>
					</select>
				</div>
			</div>
			<div class="field editGoodArticul">				
				<label for="good_articul">Артикуль<br>(складской номер):</label>
				<div class="input">
					<input type="text" id="good_articul">
				</div>
			</div>
			<div class="field editCategories">				
				<label>Показывать в категориях:</label>
				<div class="input">
					<label>Основная категория:</label>
					<div class="main_category">
						<svg width="15px" height="15px" title="change" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve"><g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g></svg>
					</div>
					<br>
					<label>Остальные категории:</label>
					<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15" height="15" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
						<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
					</svg>
					<ul></ul>
				</div>
			</div>
			<div class="field editAtributes">				
				<label for="good_atribute">Атрибуты:</label>
				<svg class="addNewAtribute" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25" height="25" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
					<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
				</svg>
				<div class="input">
					<div>Атрибут</div>
					<div>Значение</div>
					<div class="atribut">
						<input type="text" id="good_atribute" placeholder="Введите название...">
						<div class="values">
							<div><input type="text" placeholder="Введите значение..."></div>
						</div>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
							<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
						</svg>
						<div class="add-icon">Добавить иконку</div>
						<svg class="deleteAtribute" fill="000" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
						</svg>
					</div>
				</div>
			</div>
			<div class="field editDisconts">				
				<label for="good_discont">Скидки:</label>
				<svg class="addNewDiscont" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25" height="25" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
					<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
				</svg>
				<div class="input">
					<div>Новая цена<br>(цена Saterno)</div>
					<div>Дата начала</div>
					<div>Дата конца</div>
					<div class="discont">
						<input type="text" id="good_discont" placeholder="Введите новую цену">
						<div class="date first"><span class="text"></span>
							<svg version="1.0"  width="30px" height="30px" xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 800.000000 800.000000" preserveAspectRatio="xMidYMid meet">
								<g transform="translate(0.000000,800.000000) scale(0.100000,-0.100000)" stroke="none"> <path d="M1792 7227 c-49 -15 -122 -85 -148 -142 l-24 -50 0 -515 c0 -324 4 -529 10 -552 16 -56 68 -117 129 -152 46 -25 65 -30 120 -29 38 0 82 7 104 17 54 24 112 79 136 131 21 44 21 57 21 578 l0 533 -27 53 c-27 55 -84 105 -146 128 -39 14 -131 15 -175 0z"/> <path d="M4825 7216 c-60 -28 -111 -77 -136 -131 -17 -37 -19 -75 -19 -570 l0 -530 24 -50 c43 -94 128 -147 236 -148 107 -1 195 56 241 157 17 38 19 77 19 562 0 580 0 580 -67 649 -80 83 -200 107 -298 61z"/> <path d="M1385 6595 c-251 -56 -440 -226 -523 -470 l-27 -80 0 -1795 0 -1795 27 -80 c84 -246 278 -417 530 -469 68 -14 234 -16 1434 -16 l1357 0 -7 46 c-3 26 -6 105 -6 175 l0 129 -1332 0 c-1073 0 -1344 3 -1389 14 -110 25 -189 90 -238 196 l-26 55 -3 1388 -2 1387 2245 -2 2245 -3 3 -757 2 -758 178 -2 178 -3 -3 1135 -3 1135 -25 80 c-38 121 -92 209 -184 301 -66 66 -98 90 -176 128 -99 48 -208 76 -301 76 l-49 0 0 -297 c0 -321 -5 -365 -53 -446 -35 -58 -92 -111 -157 -144 -48 -24 -67 -27 -145 -28 -78 0 -98 4 -150 28 -78 36 -146 104 -182 181 l-28 61 -3 323 -3 322 -1164 0 -1164 0 -3 -322 -3 -323 -29 -63 c-41 -88 -123 -163 -212 -192 -178 -60 -376 34 -446 210 -21 52 -23 73 -25 370 l-3 315 -38 2 c-20 1 -64 -4 -97 -12z"/> <path d="M3142 4508 l3 -253 258 -3 257 -2 0 255 0 255 -260 0 -260 0 2 -252z"/> <path d="M3970 4505 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4772 4508 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z"/> <path d="M1560 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 3688 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4790 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M5706 3439 c-343 -30 -664 -194 -890 -454 -521 -601 -414 -1513 233 -1975 151 -108 312 -179 502 -222 87 -19 132 -23 274 -23 187 0 270 13 431 66 552 181 935 733 911 1314 -15 361 -142 652 -391 901 -61 61 -146 134 -188 162 -262 177 -576 259 -882 231z m369 -414 c341 -97 586 -347 683 -697 13 -48 17 -102 17 -228 0 -142 -3 -176 -23 -245 -120 -420 -491 -705 -917 -706 -230 0 -401 56 -587 193 -216 159 -359 427 -375 704 -16 280 87 547 288 740 147 141 304 222 502 260 111 21 300 12 412 -21z"/> <path d="M5739 2851 l-39 -39 0 -373 c0 -357 1 -375 20 -407 36 -59 55 -62 404 -62 365 0 379 2 416 74 28 53 22 103 -20 149 l-28 32 -266 3 -265 3 -3 287 c-3 262 -5 289 -22 315 -25 37 -66 57 -117 57 -35 0 -48 -6 -80 -39z"/> <path d="M1560 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 2858 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> </g>
							</svg>
							<div class="calendar">
								<div class="month-switcher">
									<button class="prev"></button>
									<div>
										  <span class="month"></span>
										  <span class="year"> 2020</span>
									</div>
									<button class="next"></button>
								</div>
								<div class="days">
									<span>ПН</span>
									<span>ВТ</span>
									<span>СР</span>
									<span>ЧТ</span>
									<span>ПТ</span>
									<span>СБ</span>
									<span>НД</span>
								</div>
							  <div class="monthes"></div>
							</div>
						</div>
						<div class="date second"><span class="text"></span>
							<svg version="1.0"  width="30px" height="30px" xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 800.000000 800.000000" preserveAspectRatio="xMidYMid meet">
								<g transform="translate(0.000000,800.000000) scale(0.100000,-0.100000)" stroke="none"> <path d="M1792 7227 c-49 -15 -122 -85 -148 -142 l-24 -50 0 -515 c0 -324 4 -529 10 -552 16 -56 68 -117 129 -152 46 -25 65 -30 120 -29 38 0 82 7 104 17 54 24 112 79 136 131 21 44 21 57 21 578 l0 533 -27 53 c-27 55 -84 105 -146 128 -39 14 -131 15 -175 0z"/> <path d="M4825 7216 c-60 -28 -111 -77 -136 -131 -17 -37 -19 -75 -19 -570 l0 -530 24 -50 c43 -94 128 -147 236 -148 107 -1 195 56 241 157 17 38 19 77 19 562 0 580 0 580 -67 649 -80 83 -200 107 -298 61z"/> <path d="M1385 6595 c-251 -56 -440 -226 -523 -470 l-27 -80 0 -1795 0 -1795 27 -80 c84 -246 278 -417 530 -469 68 -14 234 -16 1434 -16 l1357 0 -7 46 c-3 26 -6 105 -6 175 l0 129 -1332 0 c-1073 0 -1344 3 -1389 14 -110 25 -189 90 -238 196 l-26 55 -3 1388 -2 1387 2245 -2 2245 -3 3 -757 2 -758 178 -2 178 -3 -3 1135 -3 1135 -25 80 c-38 121 -92 209 -184 301 -66 66 -98 90 -176 128 -99 48 -208 76 -301 76 l-49 0 0 -297 c0 -321 -5 -365 -53 -446 -35 -58 -92 -111 -157 -144 -48 -24 -67 -27 -145 -28 -78 0 -98 4 -150 28 -78 36 -146 104 -182 181 l-28 61 -3 323 -3 322 -1164 0 -1164 0 -3 -322 -3 -323 -29 -63 c-41 -88 -123 -163 -212 -192 -178 -60 -376 34 -446 210 -21 52 -23 73 -25 370 l-3 315 -38 2 c-20 1 -64 -4 -97 -12z"/> <path d="M3142 4508 l3 -253 258 -3 257 -2 0 255 0 255 -260 0 -260 0 2 -252z"/> <path d="M3970 4505 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4772 4508 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z"/> <path d="M1560 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 3688 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4790 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M5706 3439 c-343 -30 -664 -194 -890 -454 -521 -601 -414 -1513 233 -1975 151 -108 312 -179 502 -222 87 -19 132 -23 274 -23 187 0 270 13 431 66 552 181 935 733 911 1314 -15 361 -142 652 -391 901 -61 61 -146 134 -188 162 -262 177 -576 259 -882 231z m369 -414 c341 -97 586 -347 683 -697 13 -48 17 -102 17 -228 0 -142 -3 -176 -23 -245 -120 -420 -491 -705 -917 -706 -230 0 -401 56 -587 193 -216 159 -359 427 -375 704 -16 280 87 547 288 740 147 141 304 222 502 260 111 21 300 12 412 -21z"/> <path d="M5739 2851 l-39 -39 0 -373 c0 -357 1 -375 20 -407 36 -59 55 -62 404 -62 365 0 379 2 416 74 28 53 22 103 -20 149 l-28 32 -266 3 -265 3 -3 287 c-3 262 -5 289 -22 315 -25 37 -66 57 -117 57 -35 0 -48 -6 -80 -39z"/> <path d="M1560 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 2858 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> </g>
							</svg>
							<div class="calendar">
								<div class="month-switcher">
									<button class="prev"></button>
									<div>
										  <span class="month"></span>
										  <span class="year"> 2020</span>
									</div>
									<button class="next"></button>
								</div>
								<div class="days">
									<span>ПН</span>
									<span>ВТ</span>
									<span>СР</span>
									<span>ЧТ</span>
									<span>ПТ</span>
									<span>СБ</span>
									<span>НД</span>
								</div>
							  <div class="monthes"></div>
							</div>
						</div>
						<svg class="deleteDiscont" fill="000" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
						</svg>
					</div>
				</div>
			</div>
			<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
				<div class="field editIsTrading">				
					<label for="seller_isTrading">Разрешение на продажу:</label>
					<div class="input">
						<div class="isShow">Выключено</div>
					<label class="switch">										  <input type="checkbox">										  <span class="slider round"></span>										</label></div>
				</div>
				<div class="field">				
					<label for="seller_statusOfTrading">Статус разрешения:</label>
					<div class="input">
						<input type="text" id="seller_statusOfTrading">
					</div>
				</div>
				<div class="field editIsIncluded">				
					<label for="seller_isIncluded">Статус включения:</label>
					<div class="input">
						<div class="isShow">Включено</div>
						<label class="switch">
							<input type="checkbox" checked="">
							<span class="slider round"></span>
						</label>
					</div>
				</div>
			<?php } else { ?>
				<div class="field editIsIncluded">				
					<label for="seller_isIncluded">Статус включения:</label>
					<div class="input">
						<div class="isShow">Включено</div>
						<label class="switch">
							<input type="checkbox" checked="">
							<span class="slider round"></span>
						</label>
					</div>
				</div>			
			<?php } ?>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock addNewTable toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Добавление нового товара</div>
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
				<div class="shopName">
					<label for="nameOfShop">Название магазина:</label>
					<select id="shopName">
						<option value="" disabled="">Выберите магазин</option>
					</select>
				</div>
				<div class="title_for_input">
					Для появления списка магазинов введите юридическое название продавца
				</div>
				<div class="goodName">				
					<label for="good_name">Название товара:</label>
					<div class="input" style="padding: 0;width: 200px;">
						<span></span>
					</div>
				</div>
				<div class="goodType">				
					<label for="newGood_type">Наименование товара:</label>
					<div class="input">
						<input type="text" id="newGood_type">
					</div>
				</div>
				<div class="goodBrand">				
					<label for="newGood_brand">Бренд производителя:</label>
					<div class="input">
						<input type="text" id="newGood_brand">
					</div>
				</div>
				<div class="goodModel">				
					<label for="newGood_model">Модель товара:</label>
					<div class="input">
						<input type="text" id="newGood_model">
					</div>
				</div>
				<div class="title_for_input">
					Остальные можно будет заполнить при редактировании товара.
				</div>
				<!--<div class="photo">
					<label>Фотографии товара:</label>
					<div class="input">
					</div>
				</div>
				<div class="description">				
					<label for="newGood_description">Описание товара:</label>
					<div class="input">
						<textarea type="text" id="newGood_description"></textarea>
					</div>
				</div>
				<div class="url">				
					<label for="newGood_url">URL товара:</label>
					<div class="input">
						<input type="text" id="newGood_url">
					</div>
				</div>
				<div class="price">				
					<label for="newGood_seller_price">Цена товара:</label>
					<div class="column">
						<div>
							<label for="newGood_seller_price">Цена продавца:</label>						
							<input type="number" class="input" id="newGood_seller_price">
						</div>
						<div>
							<label>Цена Saterno:</label>
							<span class="input good_system_price"></span>
						</div>
					</div>
				</div>
				<div class="quentity">				
					<label for="newGood_all_quentity">Количество товара:</label>
					<div class="column">
						<div>
							<label for="newGood_all_quentity">Всего:</label>
							<input type="number" id="newGood_all_quentity">
						</div>
						<div>
							<label for="newGood_sold_quentity">Продажа:</label>
							от
							<input type="number" id="newGood_sold_quentity">
						</div>
					</div>
				</div>
				<div class="inStock">				
					<label>Наличие:</label>
					<div>
						<div class="isShow">Есть в наличии</div>
						<label class="switch">
						<input type="checkbox" checked="">
						<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="size">				
					<label for="newGood_length">Размеры товара<br><span>(в сантиметрах)</span>:</label>
					<div class="column">
						<div>
							<label for="newGood_length">Длина:</label>
							<input type="number" id="newGood_length">
						</div>
						<div>
							<label for="newGood_width">Ширина:</label>
							<input type="number" id="newGood_width">
						</div>
						<div>
							<label for="newGood_height">Высота:</label>
							<input type="number" id="newGood_height">
						</div>
					</div>
				</div>
				<div class="goodWeight">				
					<label for="newGood_weight">Вес товара<br><span>(в граммах)</span>:</label>
					<div class="input">
						<input type="number" id="newGood_weight">
					</div>
				</div>
				<div class="stock">				
					<label for="newGood_stock">Склад:</label>
					<select id="newGood_stock">
						<option value="" disabled="">Выберите склад</option>
					</select>
				</div>
				<div class="goodArticul">				
					<label for="newGood_articul">Артикуль<br>(складской номер):</label>
					<div class="input">
						<input type="text" id="newGood_articul">
					</div>
				</div>
				<div class="categories">				
					<label>Показывать в категориях:</label>
					<div class="column">
						<div>
							<label>Основная категория:</label>
							<div class="main_category">
								<svg width="15px" height="15px" title="change" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve"><g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g></svg>
							</div>
						</div>
						<div>
							<label>Остальные категории:</label>
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15" height="15" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
								<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
							</svg>
							<ul></ul>
						</div>
					</div>
				</div>
				<div class="atributes">				
					<label for="newGood_atribute">Атрибуты:</label>
					<svg class="addNewAtribute" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25" height="25" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
						<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
					</svg>
					<div class="input">
						<div>Атрибут</div>
						<div>Значение</div>
						<div class="atribut">
							<input type="text" id="newGood_atribute" placeholder="Введите название...">
							<div class="values">
								<div><input type="text" placeholder="Введите значение..."></div>
							</div>
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
								<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
							</svg>
							<div class="add-icon">Добавить иконку</div>
							<svg class="deleteAtribute" fill="000" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
							</svg>
						</div>
					</div>
				</div>
				<div class="disconts">				
					<label for="newGood_discont">Скидки:</label>
					<svg class="addNewDiscont" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25" height="25" viewBox="0 0 510 510" enable-background="new 0 0 510 510" xml:space="preserve">
						<g><g id="unknown-3"><path d="M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
					</svg>
					<div class="input">
						<div>Новая цена<br>(цена Saterno)</div>
						<div>Дата начала</div>
						<div>Дата конца</div>
						<div class="discont">
							<input type="text" id="newGood_discont" placeholder="Введите новую цену">
							<div class="date first"><span class="text"></span>
								<svg version="1.0"  width="30px" height="30px" xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 800.000000 800.000000" preserveAspectRatio="xMidYMid meet">
									<g transform="translate(0.000000,800.000000) scale(0.100000,-0.100000)" stroke="none"> <path d="M1792 7227 c-49 -15 -122 -85 -148 -142 l-24 -50 0 -515 c0 -324 4 -529 10 -552 16 -56 68 -117 129 -152 46 -25 65 -30 120 -29 38 0 82 7 104 17 54 24 112 79 136 131 21 44 21 57 21 578 l0 533 -27 53 c-27 55 -84 105 -146 128 -39 14 -131 15 -175 0z"/> <path d="M4825 7216 c-60 -28 -111 -77 -136 -131 -17 -37 -19 -75 -19 -570 l0 -530 24 -50 c43 -94 128 -147 236 -148 107 -1 195 56 241 157 17 38 19 77 19 562 0 580 0 580 -67 649 -80 83 -200 107 -298 61z"/> <path d="M1385 6595 c-251 -56 -440 -226 -523 -470 l-27 -80 0 -1795 0 -1795 27 -80 c84 -246 278 -417 530 -469 68 -14 234 -16 1434 -16 l1357 0 -7 46 c-3 26 -6 105 -6 175 l0 129 -1332 0 c-1073 0 -1344 3 -1389 14 -110 25 -189 90 -238 196 l-26 55 -3 1388 -2 1387 2245 -2 2245 -3 3 -757 2 -758 178 -2 178 -3 -3 1135 -3 1135 -25 80 c-38 121 -92 209 -184 301 -66 66 -98 90 -176 128 -99 48 -208 76 -301 76 l-49 0 0 -297 c0 -321 -5 -365 -53 -446 -35 -58 -92 -111 -157 -144 -48 -24 -67 -27 -145 -28 -78 0 -98 4 -150 28 -78 36 -146 104 -182 181 l-28 61 -3 323 -3 322 -1164 0 -1164 0 -3 -322 -3 -323 -29 -63 c-41 -88 -123 -163 -212 -192 -178 -60 -376 34 -446 210 -21 52 -23 73 -25 370 l-3 315 -38 2 c-20 1 -64 -4 -97 -12z"/> <path d="M3142 4508 l3 -253 258 -3 257 -2 0 255 0 255 -260 0 -260 0 2 -252z"/> <path d="M3970 4505 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4772 4508 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z"/> <path d="M1560 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 3688 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4790 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M5706 3439 c-343 -30 -664 -194 -890 -454 -521 -601 -414 -1513 233 -1975 151 -108 312 -179 502 -222 87 -19 132 -23 274 -23 187 0 270 13 431 66 552 181 935 733 911 1314 -15 361 -142 652 -391 901 -61 61 -146 134 -188 162 -262 177 -576 259 -882 231z m369 -414 c341 -97 586 -347 683 -697 13 -48 17 -102 17 -228 0 -142 -3 -176 -23 -245 -120 -420 -491 -705 -917 -706 -230 0 -401 56 -587 193 -216 159 -359 427 -375 704 -16 280 87 547 288 740 147 141 304 222 502 260 111 21 300 12 412 -21z"/> <path d="M5739 2851 l-39 -39 0 -373 c0 -357 1 -375 20 -407 36 -59 55 -62 404 -62 365 0 379 2 416 74 28 53 22 103 -20 149 l-28 32 -266 3 -265 3 -3 287 c-3 262 -5 289 -22 315 -25 37 -66 57 -117 57 -35 0 -48 -6 -80 -39z"/> <path d="M1560 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 2858 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> </g>
								</svg>
								<div class="calendar">
									<div class="month-switcher">
										<button class="prev"></button>
										<div>
											  <span class="month"></span>
											  <span class="year"> 2020</span>
										</div>
										<button class="next"></button>
									</div>
									<div class="days">
										<span>ПН</span>
										<span>ВТ</span>
										<span>СР</span>
										<span>ЧТ</span>
										<span>ПТ</span>
										<span>СБ</span>
										<span>НД</span>
									</div>
								  <div class="monthes"></div>
								</div>
							</div>
							<div class="date second"><span class="text"></span>
								<svg version="1.0"  width="30px" height="30px" xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 800.000000 800.000000" preserveAspectRatio="xMidYMid meet">
									<g transform="translate(0.000000,800.000000) scale(0.100000,-0.100000)" stroke="none"> <path d="M1792 7227 c-49 -15 -122 -85 -148 -142 l-24 -50 0 -515 c0 -324 4 -529 10 -552 16 -56 68 -117 129 -152 46 -25 65 -30 120 -29 38 0 82 7 104 17 54 24 112 79 136 131 21 44 21 57 21 578 l0 533 -27 53 c-27 55 -84 105 -146 128 -39 14 -131 15 -175 0z"/> <path d="M4825 7216 c-60 -28 -111 -77 -136 -131 -17 -37 -19 -75 -19 -570 l0 -530 24 -50 c43 -94 128 -147 236 -148 107 -1 195 56 241 157 17 38 19 77 19 562 0 580 0 580 -67 649 -80 83 -200 107 -298 61z"/> <path d="M1385 6595 c-251 -56 -440 -226 -523 -470 l-27 -80 0 -1795 0 -1795 27 -80 c84 -246 278 -417 530 -469 68 -14 234 -16 1434 -16 l1357 0 -7 46 c-3 26 -6 105 -6 175 l0 129 -1332 0 c-1073 0 -1344 3 -1389 14 -110 25 -189 90 -238 196 l-26 55 -3 1388 -2 1387 2245 -2 2245 -3 3 -757 2 -758 178 -2 178 -3 -3 1135 -3 1135 -25 80 c-38 121 -92 209 -184 301 -66 66 -98 90 -176 128 -99 48 -208 76 -301 76 l-49 0 0 -297 c0 -321 -5 -365 -53 -446 -35 -58 -92 -111 -157 -144 -48 -24 -67 -27 -145 -28 -78 0 -98 4 -150 28 -78 36 -146 104 -182 181 l-28 61 -3 323 -3 322 -1164 0 -1164 0 -3 -322 -3 -323 -29 -63 c-41 -88 -123 -163 -212 -192 -178 -60 -376 34 -446 210 -21 52 -23 73 -25 370 l-3 315 -38 2 c-20 1 -64 -4 -97 -12z"/> <path d="M3142 4508 l3 -253 258 -3 257 -2 0 255 0 255 -260 0 -260 0 2 -252z"/> <path d="M3970 4505 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4772 4508 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z"/> <path d="M1560 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 3688 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M4790 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M5706 3439 c-343 -30 -664 -194 -890 -454 -521 -601 -414 -1513 233 -1975 151 -108 312 -179 502 -222 87 -19 132 -23 274 -23 187 0 270 13 431 66 552 181 935 733 911 1314 -15 361 -142 652 -391 901 -61 61 -146 134 -188 162 -262 177 -576 259 -882 231z m369 -414 c341 -97 586 -347 683 -697 13 -48 17 -102 17 -228 0 -142 -3 -176 -23 -245 -120 -420 -491 -705 -917 -706 -230 0 -401 56 -587 193 -216 159 -359 427 -375 704 -16 280 87 547 288 740 147 141 304 222 502 260 111 21 300 12 412 -21z"/> <path d="M5739 2851 l-39 -39 0 -373 c0 -357 1 -375 20 -407 36 -59 55 -62 404 -62 365 0 379 2 416 74 28 53 22 103 -20 149 l-28 32 -266 3 -265 3 -3 287 c-3 262 -5 289 -22 315 -25 37 -66 57 -117 57 -35 0 -48 -6 -80 -39z"/> <path d="M1560 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M2370 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> <path d="M3153 2858 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z"/> <path d="M3980 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z"/> </g>
								</svg>
								<div class="calendar">
									<div class="month-switcher">
										<button class="prev"></button>
										<div>
											  <span class="month"></span>
											  <span class="year"> 2020</span>
										</div>
										<button class="next"></button>
									</div>
									<div class="days">
										<span>ПН</span>
										<span>ВТ</span>
										<span>СР</span>
										<span>ЧТ</span>
										<span>ПТ</span>
										<span>СБ</span>
										<span>НД</span>
									</div>
								  <div class="monthes"></div>
								</div>
							</div>
							<svg class="deleteDiscont" fill="000" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
							</svg>
						</div>-->
					</div>
				</div>
				
			</div>
			
		  </div>
		</div>
		
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
						
					</div>	
				</div>
			</div>
			
		  </div>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock toggleModal2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
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
				<button class="modal__close toggleModal2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>

			<div id="drop-area">
				<div class="areaBackground">
						<input type="file" multiple accept="image/*" name="fileToUpload2" id="fileToUpload2" class="none">
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
			
			<label class="modalLoadNewPhoto" for="fileToUpload2">
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
		
		<div class="modalBlock error toggleModal3" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal3" data-toggle="true">
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
					<div class="ok toggleModal6">Да</div>
					<div class="cancel toggleModal6">Нет</div>
				</div>
			</div>
			
		  </div>
		</div>
		
		<?php if($_SESSION['user']["typeofuser"] == 'Seller') {?>
			<script>
				let sellerJuridicName = "<?php echo $jurName; ?>";
				let listShops = "<?php echo $listShops; ?>";
			</script>
		<?php } ?>
		
		<div id="cover"></div>
		<div id="cover2"></div>
		<div id="cover3"></div>
		
	</div>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/tableHead.js"></script>
	<script src="App/templates/files/js/calendar.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/loadingImagesInPopUp.js"></script>
	<script src="App/templates/files/js/closeEditingGood.js"></script>
	<script src="App/templates/files/js/saveEditingGood.js"></script>
	<script src="App/templates/files/js/goodsImagesPopUp.js"></script>
	<script src="App/templates/files/js/editGood.js"></script>
	<script src="App/templates/files/js/addNewGood.js"></script>
	
	<script src="App/templates/files/js/paginationGoods.js"></script>
</body>
</html>