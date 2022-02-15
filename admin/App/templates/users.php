<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'users';
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
    <link rel="stylesheet" href="App/templates/files/css/users.css">
    <link rel="stylesheet" href="App/templates/files/css/table.css">
    <link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpAddNew.css">
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
		<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
		
				<div class="add_new_user toggleModal0">Добавить<br>нового пользователя</div>
		
		<div class="table_users">
			<table class="content-table">
				<thead>
					<tr>
						<th>ФИО</th>
						<th>ПОЛНОМОЧИЯ</th>
						<th>ПОЧТА</th>
						<th>ДАТА ДОБАВЛЕНИЯ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						define('DAY',60*60*24);
						define('MONTH',DAY*30);
						define('YEAR',DAY*365);
						

						$userDate = new DateTime();
						$userDiff = $userDate->getTimestamp() - strtotime($_SESSION['user']['date_added']);

						$userYears = ($userDiff / (YEAR));
						$userMonths = ($userDiff / (MONTH));
						$userDays = floor($userDiff / (DAY));
						  
					foreach ($users as $user) {
						  $date = new DateTime();
						  $diff = $date->getTimestamp() - strtotime($user->date_added);

						  $years = $diff / (YEAR);
						  $months = $diff / (MONTH);
						  $days = floor($diff / (DAY));
						  
						if($user->iswasdeleted > 0) {
							continue;
						}
						
						echo '<tr>
								  <td class="none">' . $user->id . '</td>
								  <td class="fio">' . $user->full_name . '</td>
								  <td class="typeOfUser">';
						if ($_SESSION['user']['id'] !== $user->id
								&& $user->isfounder !== '1'
								&& $user->typeofuser !== 'Seller'
								&& (($_SESSION['user']['isfounder'] > 0)
								|| ($_SESSION['user']["typeofuser"] == 'Admin'
									&& $_SESSION['user']['isblocked'] !== '1' 
									&& $userDays > 29
									&& ($user->typeofuser !== 'Admin' || $days <= 29)))) {
								
							echo '<select>';
								foreach ($typesOfUsers as $typeOfUsers) {
									echo '
									  <option value="' . $typeOfUsers . '"';
									  if($user->isfounder > 0 && $user->iswasadmin !== '0') {
										  if($user->iswasadmin == $typeOfUsers) {
											  echo ' selected';
										  }
									  } else if($user->typeofuser == $typeOfUsers) {
										  echo ' selected';
									  }
									echo '>' . $typeOfUsers . '</option>';
								}
							echo '</select>';
						} else {
							echo $user->typeofuser . '</td>';
						}
						
						echo ' <td>' . $user->email . '</td>';						
						echo ' <td>' . $user->date_added . '</td>';
						
						if ($_SESSION['user']['id'] !== $user->id 
								&& $user->isfounder !== '1'
								&& (($_SESSION['user']['isfounder'] > 0)
								|| ($_SESSION['user']["typeofuser"] == 'Admin'
									&& $_SESSION['user']['isblocked'] !== '1' 
									&& $userDays > 29
									&& ($user->typeofuser !== 'Admin' || $days <= 29)))) {
								if($user->isfounder > 1 && $user->iswasblocked == '0') {
									echo '<td class="actionToUser block-user">Заблокировать</td>';
								} else if($user->isfounder > 1 && $user->iswasblocked == '1') {
									echo '<td class="actionToUser unblock-user">Разблокировать</td>';
								} else {
									if(($user->isfounder > 1 && $user->iswasblocked == '0') || $user->isblocked == '0') {
										echo '<td class="actionToUser block-user">Заблокировать</td>';
									} else {
										echo '<td class="actionToUser unblock-user">Разблокировать</td>';
									}
								}
							}							
							
						if($_SESSION['user']['id'] !== $user->id
							&& $user->isfounder !== '1'
							&& (($_SESSION['user']['isfounder'] > 0) 
								|| ($_SESSION['user']['isblocked'] !== '1'
									&& $_SESSION['user']["typeofuser"] == 'Admin'))) {
								
								if($_SESSION['user']['isfounder'] !== '1' && ($user->typeofuser == 'Admin' || ($user->iswasadmin == '1' && $days > 29))) {
									
									$voiseFromUser = \App\Models\VoiceToDeleteUser::countVoicesAgainUserFromUser($_SESSION['user']['id'], $user->id);

									$countVoices;
											
									foreach ($voiseFromUser as $k => $v) {
										if($k == "COUNT(id)") {
											$countVoices = $v;
										}
									}
									
									if($countVoices > 0) {
										echo '<td class="actionToUser cancel-voice-to-delete-user">Снять голос за удаление</td>';
									} else {
										echo '<td class="actionToUser voice-to-delete-user">Голосовать за удаление</td>';	
									}
								} else {
									echo '<td class="actionToUser delete-user">Удалить</td>';	
								}
							}
							
						if($_SESSION['user']['isfounder'] > 0) {
							$voiseAgainUser = App\Models\VoiceToDeleteUser::countVoicesAgainUser($user->id);

							$countVoicesAgainUser;
									
							foreach ($voiseAgainUser as $k => $v) {
								if($k == "COUNT(id)") {
									$countVoicesAgainUser = $v;
								}
							}
							if($countVoicesAgainUser > 0) {
								echo '<td>' . $countVoicesAgainUser . ' - голосов за удаление пользователя</td>';	
							}
						}
						
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock addNewTable toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Добавление нового пользователя</div>
				<div class="save-new-table">
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
				<div>
					<label for="add_new_user_fio">ФИО:</label>
					<input type="text" id="add_new_user_fio">
				</div>
				<div>				
					<label for="add_new_user_login">Логин:</label>
					<input type="text" id="add_new_user_login">
				</div>
				<div>
					<label for="add_new_user_email">Почта:</label>
					<input type="text" id="add_new_user_email">
				</div>
				<div>
					<label for="add_new_user_typeOfUser">Полномочия:</label>
						<select id="add_new_user_typeOfUser">
						    <?php 
							foreach ($typesOfUsers as $typeOfUsers) {
								echo '<option value="' . $typeOfUsers . '">' . $typeOfUsers . '</option>';
							}
							?>
						</select>
				</div>
				<div>
					<label for="add_new_user_password">Пароль:</label>
					<input type="text" id="add_new_user_password">
				</div>
			
			</div>
			
		  </div>
		</div>
		
		<?php } ?>
		
		<div class="modalBlock error toggleModal1" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal1" data-toggle="true">
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
		
		<div class="modalBlock error warning toggleModal2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error warning">
			<div class="modalHeaderError">
				<div class="title">Предупреждение</div>
				<button class="modal__close error toggleModal2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>Ошибка</div>
				<div class="buttons">
					<div class="ok toggleModal2">Да</div>
					<div class="cancel toggleModal2">Нет</div>
				</div>
			</div>
			
		  </div>
		</div>
		
		<div id="cover"></div>
		
	</div>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/tableHead.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/addNewUser.js"></script>
	<script src="App/templates/files/js/changeTypeOfUser.js"></script>
	<script src="App/templates/files/js/blockingUser.js"></script>

</body>
</html>