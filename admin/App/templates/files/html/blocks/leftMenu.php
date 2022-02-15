<div class="<?php
		if($_SESSION['leftMenu'] == 'hidden') {
			echo "admin-block-left hiddenLeft";
		} else {
			echo "admin-block-left";
		}
	?>">
	<div class="profile">
		<img src="<?php echo $_SESSION['user']["avatar_url"] ?>
		
		<?php $pos_ext = strripos($_SESSION['user']["avatar_name"], '.');			
			$minuspos = strlen($_SESSION['user']["avatar_name"])-$pos_ext-1;								
			$file_ext = strtolower(substr($_SESSION['user']["avatar_name"], $pos_ext+1, $minuspos));			
			$file_name = substr($_SESSION['user']["avatar_name"], 0, $pos_ext);								
			$file_name = $file_name . '_150x150.' . $file_ext;

			echo $file_name 
		?>" alt="">
		<div class="names">
			<div class="login"><?php echo $_SESSION['user']["login"] ?></div>
			<div class="email"><?php echo $_SESSION['user']["email"] ?></div>
		</div>
	</div>
	
	<a href="categories">
		<div class="list">
			Категории товаров
		</div>
	</a>
	
	<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
		<a href="sellers">
			<div class="list">
				Продавцы
			</div>
		</a>
	<?php } ?>
	
	<a href="shops">
		<div class="list">
		<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
			Магазины
		<?php } else if($_SESSION['user']["typeofuser"] == 'Seller') {?>
			Мои магазины
		<?php } ?>
		</div>
	</a>
	
	<a href="stockrooms">
		<div class="list">
		<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
			Склады
		<?php } else if($_SESSION['user']["typeofuser"] == 'Seller') {?>
			Мои склады
		<?php } ?>
		</div>
	</a>
	
	<a href="goods">
		<div class="list">
		<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
			Товары
		<?php } else if($_SESSION['user']["typeofuser"] == 'Seller') {?>
			Мои товары
		<?php } ?>
		</div>
	</a>

	<a href="account">
		<div class="list" id="menuListAccountId">
			Мой аккаунт	
		</div>
	</a>
	
	<?php if($_SESSION['user']["typeofuser"] == 'Admin') { ?>
		<a href="users">
			<div class="list">
				Пользователи	
			</div>
		</a>
	<?php } ?>
	
	<!--
	<div class="list">
		Система
		<div class="arrowDown"></div>	
	</div>
	<ul class="listDown closed">
		<li class="list">Настройки</li>
		<li class="list">
			Пользователи
			<div class="arrowDown"></div>	
		</li>	
			<ul class="listDown closed">
				<a href='users'><li class="list">Пользователи</li></a>
				<li class="list">Группы пользователей</li>	
			</ul>
	</ul>
	-->
</div>

<script>
	let leftMenuEmail = document.querySelector('.admin-block-left .profile .names .email');
	if(leftMenuEmail.innerText.length > 14) leftMenuEmail.innerText = leftMenuEmail.innerText.substring(0,14)+"…";
	
	let leftMenuLogin = document.querySelector('.admin-block-left .profile .names .login');
	if(leftMenuLogin.innerText.length > 14) leftMenuLogin.innerText = leftMenuLogin.innerText.substring(0,14)+"…";
</script>