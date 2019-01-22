<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 21.01.19
 * Time: 18:03
 */

/**
 * Class Pugnet_Uploader_Block_Form
 */
class Pugnet_Uploader_Block_Form extends Mage_Core_Block_Template
{
    /**
     * @return string
     */
    protected function getUploaderFormAction()
    {
        return Mage::getUrl('pugnet_uploader/index/save');
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::helper('pugnet_uploader')->isEnabled();
    }

    /**
     * @return mixed
     */
    public function getProductId() {
        return Mage::registry('current_product')->getId();
    }

    /**
     * @return Mage_Eav_Model_Entity_Collection_Abstract|Varien_Data_Collection_Db
     */
    public function getCollection()
    {
        return Mage::getModel('pugnet_uploader/images')->getCollection()
            ->addFieldToFilter('accepted', true)
            ->setOrder('position', 'ASC');
    }
}
