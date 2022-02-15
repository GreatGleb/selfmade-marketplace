<?php
namespace App\Models;

use App\Model;
use App\MultiException;

/**
 * Class ImagesForAdmin
 * @package App\Models
 *
 */
class ImagesForAdmin
    extends Model
{

    const TABLE = 'user_images';
	
    public $id;
    public $userId;
    public $imageId;
    public $isCurrent;

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
