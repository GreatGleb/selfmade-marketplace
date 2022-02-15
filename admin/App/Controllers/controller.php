<?php

namespace App\Controllers;

require_once('models/models.php');

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\MultiException;
use App\View;

class Controller
{
    public $model;

    public function __construct()
    {
        $this->models = new Model();
    }

    public function invoke()
    {
		$reslt = $this->models->getlogin();
		
		if($reslt == 'login') {
			include 'views/afterlogin.php';
		} else {
			include 'views/login.php';
		}
		
    }

}