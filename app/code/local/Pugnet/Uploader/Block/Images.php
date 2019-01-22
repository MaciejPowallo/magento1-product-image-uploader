<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 21.01.19
 * Time: 18:03
 */

/**
 * Class Pugnet_Uploader_Block_Images
 */
class Pugnet_Uploader_Block_Images extends Mage_Core_Block_Template
{
    /**
     * @return bool
     */
    public function isEnabled()
    {
        return Mage::helper('pugnet_uploader')->isEnabled();
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return Mage::registry('current_product')->getId();
    }

    /**
     * @return Bold_Linked_Model_Catalog_Product|Mage_Catalog_Model_Product|Mage_Core_Model_Abstract
     */
    public function getProduct()
    {
        return Mage::getModel('catalog/product')->load($this->getProductId());
    }

    /**
     * @return array
     */
    public function getImagesArray()
    {
        return explode(',', $this->getProduct()->getData('upload_images'));
    }

    /**
     * @return Mage_Eav_Model_Entity_Collection_Abstract|Varien_Data_Collection_Db
     */
    public function getCollection()
    {
        return Mage::getModel('pugnet_uploader/images')->getCollection()
            ->addFieldToFilter('image_id', ['in' => $this->getImagesArray()])
            ->setOrder('position', 'ASC');
    }

    /**
     * @param string $image
     * @return string
     */
    public function getImagePath($image)
    {
        return Mage::getBaseUrl('media') . $image;
    }
}
