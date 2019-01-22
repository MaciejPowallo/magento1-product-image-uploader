<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 20.01.19
 * Time: 22:59
 */
/**
 * Class Pugnet_Uploader_Block_Adminhtml_Images
 */
class Pugnet_Uploader_Block_Adminhtml_Images extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Pugnet_Uploader_Block_Adminhtml_Images constructor.
     */
    public function __construct()
    {
        $this->_controller      = 'adminhtml_images';
        $this->_blockGroup      = 'pugnet_uploader';
        $this->_headerText      = $this->__('Images Uploader');
        $this->_addButtonLabel  = $this->__('Add New Image');
        parent::__construct();
    }
}
