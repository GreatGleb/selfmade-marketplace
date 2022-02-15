<?php
namespace App\Models\db2;

use App\Model;

/**
 * Class ImagesForAdmin
 * @package App\Models
 *
 */
class UrlSeo
    extends Model
{

    const TABLE = 'oc_seo_url';

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
