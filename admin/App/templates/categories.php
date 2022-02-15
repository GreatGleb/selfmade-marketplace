<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'categories';
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
	<link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpAddNew.css">
    <link rel="stylesheet" href="App/templates/files/css/categories.css">
	<link rel="stylesheet" href="App/templates/files/css/loadingImages.css">
	<link rel="stylesheet" href="App/templates/files/css/toggleSwitch.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
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
				
		<h2>Категории товаров</h2>
		
		<?php if($_SESSION['user']['isblocked'] !== '1') { ?>
		
		<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
			<div class="add_new_category toggleModal1">Добавить<br>новую категорию</div>
		<?php } ?>
						
		<div class="table_categories">
			<table class="content-table">
				<thead>
					<tr>
						<th>Название</th>
						<th>Описание</th>
						<th>Родительская категория</th>
						<th>Изображение</th>
						<th>Html-title</th>
						<th>Meta-keywords</th>
						<th>URL</th>
						<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
							<th>Статус<br>включения</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					
		
					<?php 
					
						foreach ($categories as $category) {
							echo "<tr data-id='" . $category->id . "'>";
							echo "<td>"
							. $category->name . 
							"</td>";
							echo "<td>" . $category->description . "</td>";
							echo "<td>" . $category->parent_category . "</td>";
							if($category->imageUrl) {
								echo "<td> <img src=\"" . $category->imageUrl;
								
								$pos_ext = strripos($category->imageName, '.');			
								$minuspos = strlen($category->imageName)-$pos_ext-1;								
								$file_ext = strtolower(substr($category->imageName, $pos_ext+1, $minuspos));			
								$file_name = substr($category->imageName, 0, $pos_ext);								
								$file_name = $file_name . '_150x150.' . $file_ext;
								
								echo $file_name  . "\" width=\"50px\" height=\"50px\" data-src=\"" . $category->imageUrl . $file_name . "\"></td>";
							} else {
								echo "<td></td>";
							}
							echo "<td>" . $category->title . "</td>";
							echo "<td>" . $category->keywords . "</td>";
							echo "<td>" . $category->url . "</td>";
							if($_SESSION['user']["typeofuser"] == 'Admin') {
								echo "<td><div class=\"isShow\">" . $category->isShow . "</div></td>";
								if($_SESSION['user']['isblocked'] !== '1'
									&& $_SESSION['user']["typeofuser"] == 'Admin') {
									echo "<td class=\"editCategory\">
									<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
										<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>
									</svg><br>Редактировать
										</td>";
								}
								
								echo "<td class=\"deleteCategory\">
									<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
										<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"/><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/></g>
									</svg><br>Удалить
										</td>";
							}
							echo "</tr>";
						}
					
					?>
				</tbody>
			</table>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
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
				<button class="modal__close toggleModal0" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>

			<div id="drop-area">
				<div class="areaBackground">
						<input type="file" multiple accept="image/*" name="fileToUpload0" id="fileToUpload0" class="none">
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
			
			<label class="modalLoadNewPhoto" for="fileToUpload0">
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
							foreach ($categoriesImages as $img) {
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
		<div class="modalBlock toggleModal1 addNewTable newCategory" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Добавление новой категории</div>
				<div class="save-new-table">
					<svg width="25" height="25" fill="#fff">
						<?php include __DIR__ . "/files/img/icons/save.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal1" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>
					<label for="add_new_category_name">Название:</label>
					<input type="text" id="add_new_category_name">
				</div>
				<div>				
					<label for="add_new_category_desc">Описание:</label>
					<input type="text" id="add_new_category_desc">
				</div>
				<div>
					<label for="add_new_parent_category">Родительская категория:</label>
					<select class="add_new_parent_category" id="add_new_parent_category">
						<option value=""></option>
					<?php
						echo "<option value=\"";
						foreach ($categoriesNameAndId as $categoryNameAndId) {
							for($i = 0; $i < sizeof($categoryNameAndId); $i++) {
								if($i == 0) {
									$name = $categoryNameAndId[$i];
								} else {
									echo $categoryNameAndId[$i] . "\">" . $name . "</option>";
								}					
							}
						}
						
					?>					
					</select>
				</div>
				<div>
					<label for="add_new_category_html_title">Html-title:</label>
					<input type="text" id="add_new_category_html_title">
				</div>
				<div>
					<label for="add_new_category_keyword">Meta-keywords:</label>
					<input type="text" id="add_new_category_keyword">
				</div>
				<div>
					<label for="add_new_category_url">URL:</label>
					<input type="text" id="add_new_category_url">
				</div>
				<div>
					<label for="add_new_category_status">Статус:</label>
					<div class="isShow" id="add_new_category_status">Включено</div>
					<label class="switch">
						<input type="checkbox" checked="">
						<span class="slider round"></span>								
					</label>
				</div>
			
			</div>
			
		  </div>
		</div>
		
		<?php } else {
			echo '<p>У заблокированных пользователей нет доступа для просмотра и редактирования категорий.</p>';
		}?>
		
		<div class="modalBlock error toggleModal2 level2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal2 level2" data-toggle="true">
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
		
		<div class="modalBlock error warning toggleModal3" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error warning">
			<div class="modalHeaderError">
				<div class="title">Предупреждение</div>
				<button class="modal__close error toggleModal3" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>Ошибка</div>
				<div class="buttons">
					<div class="ok">Да</div>
					<div class="cancel toggleModal3">Нет</div>
				</div>
			</div>
			
		  </div>
		</div>
		
		<div id="cover"></div>
		<div id="cover2"></div>
	</div>
	<script>
		let categoriesNames = [];
		<?php
			if($categoriesNameAndId !== NULL) {
				foreach ($categoriesNameAndId as $categoryNameAndId) {
					echo "categoriesNames.push([\"";
					
					for($i = 0; $i < sizeof($categoryNameAndId); $i++) {
						if($i == 0) {
							echo $categoryNameAndId[$i] . "\", ";
						} else {
							echo $categoryNameAndId[$i];
						}					
					}
					
					echo "]);";
				}
			}
		?>
	</script>
	
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/tableHead.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/loadingImagesInPopUp.js"></script>
	<script src="App/templates/files/js/categoryImagesPopUp.js"></script>
	<script src="App/templates/files/js/editCategory.js"></script>
	<script src="App/templates/files/js/addNewCategory.js"></script>

</body>
</html>