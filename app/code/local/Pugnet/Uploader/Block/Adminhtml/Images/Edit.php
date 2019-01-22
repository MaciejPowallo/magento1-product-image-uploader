<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Block_Adminhtml_Images_Edit
 */
class Pugnet_Uploader_Block_Adminhtml_Images_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Pugnet_Uploader_Block_Adminhtml_Images_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId        = 'image_id';
        $this->_blockGroup      = 'pugnet_uploader';
        $this->_controller      = 'adminhtml_images';
        $this->_updateButton('save', 'label', $this->__('Save Image'));
        $this->_updateButton("delete", "label", $this->__("Delete Slide"));
        $this->_addButton('saveandcontinue', array(
            'label'     => $this->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * @return mixed
     */
    protected function _getModel(){
        return Mage::registry('current_model');
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        $model = $this->_getModel();
        if ($model && $model->getId()) {
           return $this->__('Edit Image (ID: %s)', $model->getId());
        }
        else {
           return $this->__('New Image');
        }
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }
}
