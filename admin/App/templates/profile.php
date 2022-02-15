<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'profile';
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
			} else if($user->iswasblocked > 0) {
				echo '<p>Вы были заблокированны.</p>';
			}
		?>
	</div>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script>
	changeLeftMenuHeight();
	</script>

</body>
</html>