<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models\VoiceToDeleteUser;
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

$user->typeofuser = \App\Models\TypeOfUsers::findTypeOfUsers($user->id)->type;

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
				$voiceFromUser = VoiceToDeleteUser::findVoiceToDeleteByUserIdAndUserDelete($_SESSION['user']['id'], $data)->delete();

				if($voiceFromUser) {
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
} else {
	return false;
}

?>