<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\User;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

session_start();
$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

$user = User::findById($data);

$date = new \DateTime();
$diff = $date->getTimestamp() - strtotime($user->date_added);

define('DAY',60*60*24);
define('MONTH',DAY*30);
define('YEAR',DAY*365);

$years = floor($diff / (YEAR));
$months = floor(($diff - $years * YEAR) / (MONTH));
$days = floor(($diff - $years * YEAR - $months*MONTH ) / (DAY));

$userDiff = $date->getTimestamp() - strtotime($_SESSION['user']['date_added']);

$userYears = ($userDiff / (YEAR));
$userMonths = ($userDiff / (MONTH));
$userDays = floor($userDiff / (DAY));

$user->typeofuser = \App\Models\TypeOfUsers::findTypeOfUsers($user->id)->type;

if ($_SESSION['user']['id'] !== $user->id 
	&& $user->isfounder !== '1'
	&& (($_SESSION['user']['isfounder'] > 0)
	|| ($_SESSION['user']["typeofuser"] == 'Admin'
		&& $_SESSION['user']['isblocked'] !== '1' 
		&& $userDays > 29
		&& ($user->typeofuser !== 'Admin' || $days <= 29)))) {
			
	if($user->isfounder > 1) {
		if(User::setValueToTable($user->id, 'iswasblocked', 0)) {
			echo 1;
		} else {
			return false;
		}
	} else {
		if($user->isblocked == '1') {
			if(User::unblockingUser($data)) {
				echo 1;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
} else {
	return false;
}

?>