<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'account';
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
    <link rel="stylesheet" href="App/templates/files/css/account.css">
	<link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
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
				
		<?php 
			$user = App\Models\User::findById($_SESSION['user']['id']);
			
			if($user->iswasdeleted > 0) {
				echo '<p>Вы были удалены основателем.</p>';
			} else if($user->iswasadmin > 0) {
				echo '<p>С вас были сняты права администратора.</p>';
			} else if($user->isblocked > 0) {
				echo '<p>Вы были заблокированны.</p>';
			}
		?>
		
		<form class="accountForm">
			<div class="divAvatar">
				<img src="<?php echo $_SESSION['user']["avatar_url"] ?><?php echo $_SESSION['user']["avatar_name"] ?>" alt="" class="avatar">
				<a>
					<svg title="change" class="iconEdit toggleModal0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
						<?php include __DIR__ . "/files/img/icons/edit.svg" ?>
					</svg>		
				</a>
			</div>
			<div class="login">
				<h3><?php echo $_SESSION['user']["login"] ?></h3>
				<a>
					<svg title="change" class="iconEdit" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
						<?php include __DIR__ . "/files/img/icons/edit.svg" ?>
					</svg>	
				</a>
			</div>
			<div class="FIO">
				<h3><?php echo $_SESSION['user']["full_name"] ?></h3>
			</div>
			<div class="email">
				<span class="email"><?php echo $_SESSION['user']["email"] ?></span>
				<a>
					<svg title="change" class="iconEdit" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
						<?php include __DIR__ . "/files/img/icons/edit.svg" ?>
					</svg>		
				</a>
			</div>
			<div class="password">
				<h4 class="password">Изменить пароль</h4>
				<a>
					<svg title="change" class="iconEdit" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
						<?php include __DIR__ . "/files/img/icons/edit.svg" ?>
					</svg>		
				</a>
			</div>
		</form>
				
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
							foreach ($avatarImages as $img) {
								if($img["name"] == $_SESSION['user']["avatar_name"]) {
									$select = 'select';
								} else {
									$select = 'notSelect';
								}
								
								echo "<div class=\"imageCart\">
									<div class='hoverForSelect " . $select . "'>
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
		
		<div class="modalBlock error toggleModal1 level3" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal1 level3" data-toggle="true">
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
		
		<div id="cover"></div>
		<div id="cover2"></div>
		<div id="cover3"></div>
		
	</div>

	<script>
		let emailText = '<?php echo $_SESSION['user']["email"] ?>';
		let loginText = '<?php echo $_SESSION['user']["login"] ?>';
		let userIdForLoadingImages = '<?php echo $_SESSION['user']["id"] ?>';
	</script>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/loadingImagesInPopUp.js"></script>
	<script src="App/templates/files/js/accountImagesPopUp.js"></script>
	<script src="App/templates/files/js/accountLogin.js"></script>
	<script src="App/templates/files/js/accountEmail.js"></script>
	<script src="App/templates/files/js/accountPassword.js"></script>

</body>
</html>