<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Block_Adminhtml_Images_Edit_Tab_Form
 */
class Pugnet_Uploader_Block_Adminhtml_Images_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('pugnet_uploader_form',
            ['legend'   => $this->__('Image Data')]);

        $fieldset->addField('accepted', 'select', [
            'label'     => $this->__('Accepted'),
            'options'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
            'name'      => 'accepted',
        ]);

        $fieldset->addField('image', 'image', [
            'label'     => $this->__('Image'),
            'name'      => 'image',
            'note'      => '(*.jpg, *.png, *.gif)',
        ]);

        $fieldset->addField('product_id', 'text', [
            'label'     => $this->__('Product ID'),
            'name'      => 'product_id',
            'required'  => true,
        ]);

        $fieldset->addField('name', 'text', [
            'label'     => $this->__('Image visible name'),
            'name'      => 'name',
        ]);

        $fieldset->addField('position', 'text', [
            'label'     => $this->__('Position'),
            'name'      => 'position',
        ]);

        if (Mage::getSingleton('adminhtml/session')->getImagesData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getImagesData());
            Mage::getSingleton('adminhtml/session')->getImagesData(null);
        } elseif (Mage::registry('images_data')) {
            $form->setValues(Mage::registry('images_data')->getData());
        }

        return parent::_prepareForm();
    }
}
