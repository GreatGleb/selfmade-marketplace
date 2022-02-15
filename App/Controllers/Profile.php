<?php

namespace App\Controllers;

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\MultiException;
use App\View;

class Profile
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

    protected function actionProfile()
    {
		session_start();
		//var_dump($_SESSION);
		
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;		
		
        $this->view->title = 'Мой крутой сайт!';
		$this->view->display(__DIR__ . '/../templates/profile.php');
    }

}