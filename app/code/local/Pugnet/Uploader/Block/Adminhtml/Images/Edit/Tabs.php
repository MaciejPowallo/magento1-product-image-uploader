<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 21.01.19
 * Time: 00:02
 */
/**
 * Class Pugnet_Uploader_Block_Adminhtml_Images_Edit_Tabs
 */
class Pugnet_Uploader_Block_Adminhtml_Images_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Pugnet_Uploader_Block_Adminhtml_Images_Edit_Tabs constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('images_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Image'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     * @throws Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab("form_section", [
            "label"     => $this->__("Image"),
            "title"     => $this->__("Image"),
            "content"   => $this->getLayout()->createBlock("pugnet_uploader/adminhtml_images_edit_tab_form")->toHtml(),
        ]);

        return parent::_beforeToHtml();
    }
}