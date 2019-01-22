<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 20.01.19
 * Time: 17:09
 */

/**
 * Class Pugnet_Uploader_IndexController
 */
class Pugnet_Uploader_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * The method allows save the image
     */
    public function  saveAction()
    {
        $data = $this->getRequest()->getPost();
        if ($data) {
            try {
                if (isset($data['image']['delete'])) {
                    $data['image'] = '';
                } else {
                    unset($data['image']);

                    if (isset($_FILES)) {
                        if ($_FILES['image']['name']) {
                            if ($this->getRequest()->getParam('id')) {
                                $model = Mage::getModel('pugnet_uploader/images')->load($this->getRequest()->getParam('id'));
                                if ($model->getData('image')) {
                                    $io = new Varien_Io_File();
                                    $io->rm(Mage::getBaseDir('media') . DS . implode(DS, explode('/', $model->getData('image'))));
                                }
                            }
                            $path = Mage::getBaseDir('media') . DS . 'uploader' . DS . 'images' . DS;
                            $uploader = new Varien_File_Uploader('image');
                            $uploader->setAllowedExtensions(['jpg', 'png', 'gif']);
                            $uploader->setAllowRenameFiles(false);
                            $uploader->setFilesDispersion(false);
                            $destFile = $path . $_FILES['image']['name'];
                            $filename = $uploader->getNewFileName($destFile);
                            $uploader->save($path, $filename);

                            $data['image'] = 'uploader/images/' . $filename;
                        }
                    }
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirectReferer();
                return;
            }

            try {
                $model = Mage::getModel('pugnet_uploader/images')
                    ->addData($data)
                    ->setId($this->getRequest()->getParam('id'))
                    ->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Image was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setItemsData(false);
                $this->_redirectReferer();
                return;

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setItemsData($this->getRequest()->getPost());
                $this->_redirectReferer();
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Image has not been saved'));
        $this->_redirectReferer();
    }
}
