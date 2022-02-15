<?php

namespace App\Models;

use App\Model;

/**
 * Class User
 * @package App\Models
 *
 */
class User extends Model
{
    const TABLE = 'users';
	
    public $id;
    public $full_name;
    public $login;
    public $email;
    public $password;
    public $typeofuser_id;

    /**
     * Метод, возвращающий адрес e-mail
     * @deprecated
     * @return string Адрес электронной почты
     */
    public function getEmail()
    {
        return $this->email;
    }

}