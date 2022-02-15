<?php
namespace App\Models;

use App\Model;
use App\MultiException;

/**
 * Class Signin
 * @package App\Models
 *
 */
class Signin
    extends Model
{

    const TABLE = 'users';

    protected $login;
    protected $password;
    protected $error_fields;

    /**
     * LAZY LOAD
     *
     * @param $k
     * @return null
     */
    public function __get($k)
    {
        switch ($k) {
            case 'user':
                return User::findById($this->id);
                break;
            default:
                return null;
        }
    }

    public function __isset($k)
    {
        switch ($k) {
            case 'user':
                return !empty($this->id);
                break;
            default:
                return false;
        }
    }


}

?>
