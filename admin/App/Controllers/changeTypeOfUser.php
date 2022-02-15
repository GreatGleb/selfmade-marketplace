<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\User;
use App\MultiException;

try {
	$data = file_get_contents( "php://input" );
	$data = json_decode( $data );

	session_start();

	define('DAY',60*60*24);
	define('MONTH',DAY*30);
	define('YEAR',DAY*365);

	$userDate = new \DateTime();
	$userDiff = $userDate->getTimestamp() - strtotime($_SESSION['user']['date_added']);

	$userYears = ($userDiff / (YEAR));
	$userMonths = ($userDiff / (MONTH));
	$userDays = floor($userDiff / (DAY));

	$user = User::findById($data[0]);

	$user->typeofuser = \App\Models\TypeOfUsers::findTypeOfUsers($user->id)->type;

	if ($_SESSION['user']['id'] !== $user->id 
		&& $user->isfounder !== '1'
		&& (($_SESSION['user']['isfounder'] > 0)
			|| ($_SESSION['user']["typeofuser"] == 'Admin'
				&& $_SESSION['user']['isblocked'] !== '1' 
				&& $userDays > 29
				&& ($user->typeofuser !== 'Admin' || $days <= 29)))) {
					
					$idUser = $data[0];
					$typeOfUser = $data[1];
					
					if($user->isfounder > 0) {
						if($user->typeofuser !== 'Admin') {
							User::updateUserWasAdmin($idUser, $typeOfUser);
						} else {
							User::updateUserWasAdmin($idUser, 1);						
						}
					} else {

						$typeofuser_id = \App\Models\TypeOfUsers::findIdTypeOfUsersByType($typeOfUser)->id;

						if($user->typeofuser == 'Admin') {
							User::updateUserWasAdmin($idUser, 0);
						}

						User::setTypeOfUser($idUser, $typeofuser_id);
					}
					echo 'Success!';
	} else {
		return false;
	}
} catch (PDOException $e) {
	var_dump($e);
}
?>