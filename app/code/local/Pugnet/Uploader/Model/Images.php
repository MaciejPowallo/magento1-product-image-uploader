<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Model_Images
 */
class Pugnet_Uploader_Model_Images extends Mage_Core_Model_Abstract
{
    /**
     * Pugnet_Uploader_Model_Images constructor.
     */
    protected function _construct()
    {
        $this->_init('pugnet_uploader/images');
    }
}
