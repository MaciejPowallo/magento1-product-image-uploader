<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 20.01.19
 * Time: 16:30
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
