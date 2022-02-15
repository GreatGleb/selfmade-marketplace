<?php
session_start();

if ($_SESSION['user']) {
    header('Location: profile');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="App/templates/files/css/main.css">
    <link rel="stylesheet" href="App/templates/files/css/signin.css">
</head>
<body>
	
    <form method="post">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин"
			<?php
			
			if ($_SESSION['dataOfSign']) {
				echo 'value="'.$_SESSION['dataOfSign']['login'].'"';
			}
			?>
		>
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль"
			<?php
		
            if ($_SESSION['dataOfSign'] && !$_SESSION['user']) {
				echo 'value="'.$_SESSION['dataOfSign']['password'].'"';
			}
			?>
		>
        <button type="submit">Войти</button>

        <?php
		
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
			
			if ($_SESSION['errors']) {
				
				foreach ($_SESSION['errors']['fields'] as $value) {
					echo '<script> '. 'document.querySelector(\'input[name="' . $value . '"]\').className += "error"; </script>';
				}
				
				 echo '<p class="msg"> ' . $_SESSION['errors']['message'] . ' </p>';

			}
			unset($_SESSION['errors']);
		?>
    </form>

</body>
</html>