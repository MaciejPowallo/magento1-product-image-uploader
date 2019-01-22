<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Model_Product_Attribute_Source_Payment
 */
class Pugnet_Uploader_Model_Product_Attribute_Source_Images extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    /**
     * @return array
     */
    public function getAllOptions()
    {
        if (is_null($this->_options)) {
            $this->_options = [];

            $acceptedCollection = Mage::getModel('pugnet_uploader/images')->getCollection()
                ->addFieldToFilter('accepted', true)
                ->addFieldToFilter('product_id', Mage::registry('current_product')->getId())
                ->setOrder('name', 'DESC');

            foreach ($acceptedCollection as $imageId => $image) {
                $imageName = explode('/', $image['image']);

                $this->_options[] = [
                    'value' => $imageId,
                    'label' => $image['name'] ? $image['name'] . ' (' . end($imageName) . ')' : end($imageName),
                ];
            }
        }

        return $this->_options;
    }
}
