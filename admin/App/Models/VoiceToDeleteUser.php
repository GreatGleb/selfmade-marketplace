<?php

namespace App\Models;

use App\Model;

/**
 * Class User
 * @package App\Models
 *
 */
class VoiceToDeleteUser extends Model
{
    const TABLE = 'voicesfordeleteusers';
	
    public $id;
    public $userId;
    public $deleteUserId;
	
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