<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 20.01.19
 * Time: 16:30
 */

/**
 * Class Pugnet_Uploader_Model_Resource_Images_Collection
 */
class Pugnet_Uploader_Model_Resource_Images_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('pugnet_uploader/images');
    }
}
