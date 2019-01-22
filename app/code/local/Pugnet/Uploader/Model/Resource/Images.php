<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Model_Resource_Images
 */
class Pugnet_Uploader_Model_Resource_Images extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('pugnet_uploader/images', 'image_id');
    }
}
