<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\User;
use App\MultiException;

try {	
	session_start();

	$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
	$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
		
	if ($_SESSION['user']['isfounder'] > 0
		|| ($_SESSION['user']["typeofuser"] == 'Admin'
			&& $_SESSION['user']['isblocked'] !== '1')) {
						
		$data = file_get_contents( "php://input" );
		$data = json_decode( $data );

		$fio = $data[0];
		$login = $data[1];
		$email = $data[2];
		$new_password = $data[3];
		$typeOfUser = $data[4];

		$typeofuser_id = \App\Models\TypeOfUsers::findIdTypeOfUsersByType($typeOfUser)->id;

		$new_user = new User();

		$newIdForUser = $new_user->findMaxId() + 1;
		$new_user->id = $newIdForUser;
		$new_user->full_name = $fio;
		$new_user->login = $login;
		$new_user->email = $email;
		$new_user->password = $new_password;
		$new_user->typeofuser_id = $typeofuser_id;
		$new_user->isfounder = 0;
		$new_user->isblocked = 0;
		$new_user->iswasadmin = 0;

		if($new_user->insert()) {
			$AllTypesOfUsers = \App\Models\TypeOfUsers::findAll();
			$typesOfUsers = array();
			
			foreach ($AllTypesOfUsers as $typeOfUsers) {
				$typesOfUsers[] = $typeOfUsers->type;
			}
			echo '<td class="none">' . $new_user->id . '</td>
				  <td>' . $new_user->full_name . '</td>
				  <td>';
			
			if(($_SESSION['user']['isfounder'] == '1'
				&& $new_user->isfounder !== '1') ||			
				($_SESSION['user']['isblocked'] !== '1' &&
				$_SESSION['user']["typeofuser"] == 'Admin' 
				&& $typeOfUser !== 'Admin')) {
						
					echo '<select>';
						foreach ($typesOfUsers as $typeOfUsers) {
							echo '
							  <option value="' . $typeOfUsers . '"';
							  if($typeOfUser == $typeOfUsers) {
								  echo ' selected';
							  }
							echo '>' . $typeOfUsers . '</option>';
						}
					echo '</select>';
			} else {
				echo $typeOfUser . '</td>';
			}
			
			echo ' <td>' . $new_user->email . '</td>';
			
			if(($_SESSION['user']['isfounder'] == '1'
				&& $new_user->isfounder !== '1') ||			
				($_SESSION['user']['isblocked'] !== '1'
				&& $_SESSION['user']["typeofuser"] == 'Admin')
				&& $new_user->isfounder !== '1') {
					if($new_user->isblocked == '0') {
						echo '<td class="actionToUser block-user">??????????????????????????</td>';
					} else {
						echo '<td class="actionToUser unblock-user">????????????????????????????</td>';
					}
					if($typeOfUser == 'Admin') {
						echo '<td class="actionToUser voice-to-delete-user">???????????????????? ???? ????????????????</td>';									
					} else {
						echo '<td class="actionToUser delete-user">??????????????</td>';	
					}
				}
		} else {
			return false;
		}
	}
} catch (PDOException $e) {
	var_dump($e);
}	

?>