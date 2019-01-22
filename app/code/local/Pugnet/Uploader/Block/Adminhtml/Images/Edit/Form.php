<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 20.01.19
 * Time: 22:59
 */
/**
 * Class Pugnet_Uploader_Block_Adminhtml_Images_Edit_Form
 */
class Pugnet_Uploader_Block_Adminhtml_Images_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     * @throws Exception
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
                "id"        => "edit_form",
                "action"    => $this->getUrl("*/*/save", ["id" => $this->getRequest()->getParam("id")]),
                "method"    => "post",
                "enctype"   => "multipart/form-data",
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
