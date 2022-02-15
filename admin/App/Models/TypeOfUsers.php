<?php
namespace App\Models;

use App\Model;

/**
 * Class ImagesForAdmin
 * @package App\Models
 *
 */
class TypeOfUsers
    extends Model
{

    const TABLE = 'typesofuser';

    /**
     * LAZY LOAD
     *
     * @param $k
     * @return null
     */
    public function __get($k)
    {
        switch ($k) {
            case 'typesofuser':
                return User::findById($this->id);
                break;
            default:
                return null;
        }
    }

    public function __isset($k)
    {
        switch ($k) {
            case 'typesofuser':
                return !empty($this->id);
                break;
            default:
                return false;
        }
    }
}

?>
