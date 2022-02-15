<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

$isOk = 1;

$user = Models\User::findTablesByField('email', $_POST['email'])[0];

if($user == NULL) {
    $isOk = 0;
} else {
    if($user->email !== $_POST['email']) {
        $isOk = 0;
    } else {
        if($user->password !== $_POST['password']) {
            $isOk = 0;
        }
    }
}

if($isOk) {
    session_start();
    
    $_SESSION['customer'] = $user;
    
    $fullName = $user->full_name;
    
    echo $fullName;
    
    $userContact = Models\UserContacts::findTablesByField('userId', $user->id)[0];
    if($userContact != NULL) {
	    $contact = Models\Contact::findById($userContact->contactId)->contact;
	    echo ']' . $contact;
	    $_SESSION['customer']->number = $contact;
    }
} else {
    echo $isOk;
}

?>