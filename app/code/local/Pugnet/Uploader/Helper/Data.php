<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Helper_Data
 */
class Pugnet_Uploader_Helper_Data extends Mage_Core_Helper_Abstract
{
    const IS_ENABLED = 'pugnet_uploader/general/active';

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::getStoreConfigFlag(self::IS_ENABLED);
    }
}
