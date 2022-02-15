<?php

namespace App\Controllers;

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\MultiException;
use App\View;

class Account
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        $methodName = 'action' . $action;
        $this->beforeAction();
        return $this->$methodName();
    }

    protected function beforeAction()
    {
    }

    protected function actionAccount()
    {		
		$this->view->avatarImages = $this->getAvatarImages();
		
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;		
		
        $this->view->title = 'Мой крутой сайт!';
		$this->view->display(__DIR__ . '/../templates/account.php');
    }
	
    protected function getAvatarImages()
    {
		session_start();
		$avatarImages = $this->view->avatar = \App\Models\ImagesForAdmin::findImagesByTableId($_SESSION['user']['id'], 'UserId');
		
		$avatarImagesArray = [];

		foreach ($avatarImages as $object) {
			$valuesArray = [];
			foreach ($object as $prop => $value) {
				$valuesArray[$prop] = $value;
			}
			$avatarImagesArray[] = $valuesArray;
        }
		
		return $avatarImagesArray;
    }

}