<?php

namespace App\Models;

use App\Model;

/**
 * Class User
 * @package App\Models
 *
 */
class Model extends Model
{
    public function getlogin()
    {
        if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
			if($_REQUEST['username'] == 'Salma' && $_REQUEST['password'] == 'Noreen') {
				return 'login';
			} else {
				return 'invalid user';
			}
		}
    }

}