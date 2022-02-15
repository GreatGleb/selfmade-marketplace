<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\VoiceToDeleteUser;
use App\Models\User;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

session_start();

$user = User::findById($data);

$date = new \DateTime();
$diff = $date->getTimestamp() - strtotime($user->date_added);

define('DAY',60*60*24);
define('MONTH',DAY*30);
define('YEAR',DAY*365);

$years = floor($diff / (YEAR));
$months = floor(($diff - $years * YEAR) / (MONTH));
$days = floor(($diff - $years * YEAR - $months*MONTH ) / (DAY));

$user->typeofuser = \App\Models\TypeOfUsers::findTypeOfUsers($user->id)->type;

if($_SESSION['user']['id'] !== $user->id
	&& $user->isfounder !== '1'
	&& (($_SESSION['user']['isfounder'] > 0) 
		|| ($_SESSION['user']['isblocked'] !== '1'
			&& $_SESSION['user']["typeofuser"] == 'Admin'))) {

	if($user->isfounder > 0) {
		if(User::updateUserWasDeleted($user->id)) {
			echo 'Success!';
		} else {
			return false;
		}
	} else if($_SESSION['user']['isfounder'] == '1' || ($user->typeofuser !== 'Admin' && ($user->iswasadmin !== '1' || $days <= 29))) {
		$isDeletedUser = $user->delete();	
		if($isDeletedUser) {
			echo 'Success!';
		} else {
			return false;
		}
	} else {
		return false;
	}
} else {
	return false;
}




?>