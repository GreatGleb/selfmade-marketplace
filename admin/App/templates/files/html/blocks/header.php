<div class="admin-block-top">
	<a href='profile'><div class="header"><strong>Admin</strong>Panel</div></a>
	<div class="threeLines"><div></div><div></div><div></div></div>
	
	<div class="icon push">
		<img src="<?php echo $_SESSION['user']["avatar_url"] ?>
		<?php $pos_ext = strripos($_SESSION['user']["avatar_name"], '.');			
			$minuspos = strlen($_SESSION['user']["avatar_name"])-$pos_ext-1;								
			$file_ext = strtolower(substr($_SESSION['user']["avatar_name"], $pos_ext+1, $minuspos));			
			$file_name = substr($_SESSION['user']["avatar_name"], 0, $pos_ext);								
			$file_name = $file_name . '_150x150.' . $file_ext;

			echo $file_name 
		?>" alt="">
	</div>
	<div class="name"><?php echo $_SESSION['user']["login"] ?></div>
	<div class="exit">
		<a href="../admin/logout"><strong>Выйти</strong></a>
	</div>
</div>

<script>
	let headerLogin = document.querySelector('.admin-block-top .name');
	if(headerLogin.innerText.length > 15) headerLogin.innerText = headerLogin.innerText.substring(0,15)+"…";
</script>