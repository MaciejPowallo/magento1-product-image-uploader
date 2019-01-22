<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Adminhtml_ImagesController
 */
class Pugnet_Uploader_Adminhtml_ImagesController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('pugnet_uploader/images')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Images Uploader'),
                $this->__('Images Uploader'));

        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Images Product Uploader'));

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('pugnet_uploader/images'));
        $this->renderLayout();
    }

    /**
     * The method allows edit the image
     *
     * @throws Mage_Core_Exception
     */
    public function editAction()
    {
        $this->_title($this->__('Images Uploader'));
        $this->_title($this->__('Images'));
        $this->_title($this->__('Edit Image'));

        $id = $this->getRequest()->getParam('id');

        $model = Mage::getModel('pugnet_uploader/images')->load($id);
        if ($model->getId()) {
            Mage::register('images_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('pugnet_uploader/images');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Images Manager'),
                Mage::helper('adminhtml')->__('Images Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Image Name'),
                Mage::helper('adminhtml')->__('Image Name'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                ->createBlock('pugnet_uploader/adminhtml_images_edit'))
                ->_addLeft($this->getLayout()->createBlock('pugnet_uploader/adminhtml_images_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Image does not exist.'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * The method adds a new image
     *
     * @throws Mage_Core_Exception
     */
    public function newAction()
    {
        $this->_title($this->__('Images Uploader'));
        $this->_title($this->__('Images'));
        $this->_title($this->__('New Image'));

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('pugnet_uploader/images')->load($id);
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        empty($data) ? null : $model->setData($data);

        Mage::register('images_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('pugnet_uploader/images');
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Images Manager'),
            Mage::helper('adminhtml')->__('Images Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Image Name'),
            Mage::helper('adminhtml')->__('Image Name'));

        $this->_addContent($this->getLayout()->createBlock('pugnet_uploader/adminhtml_images_edit'))
            ->_addLeft($this->getLayout()->createBlock('pugnet_uploader/adminhtml_images_edit_tabs'));

        $this->renderLayout();
    }

    /**
     * The method allows save the image
     */
    public function saveAction()
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
                $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
            }

            try {
                $model = Mage::getModel('pugnet_uploader/images')
                    ->addData($data)
                    ->setId($this->getRequest()->getParam('id'))
                    ->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Image was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setItemsData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $model->getId()]);
                }
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setItemsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * The method allows delete the image
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('pugnet_uploader/images');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('pugnet_uploader')->__('Unable to find a image to delete.'));
                }
                $model->delete();
                $this->_getSession()->addSuccess(
                    Mage::helper('pugnet_uploader')->__('The image has been deleted.')
                );
                $this->_redirect('*/*/index');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('pugnet_uploader')->__('An error occurred while deleting image data. Please review log and try again.')
                );
                Mage::logException($e);
            }
            $this->_redirect('*/*/edit', ['id' => $id]);
        }

        $this->_getSession()->addError(
            Mage::helper('pugnet_uploader')->__('Unable to find a image to delete.')
        );
        $this->_redirect('*/*/index');
    }

    /**
     * The method allows delete many images
     */
    public function massDeleteAction()
    {
        try {
            $ids = $this->getRequest()->getPost('image_ids', []);
            foreach ($ids as $id) {
                $model = Mage::getModel('pugnet_uploader/images');
                $model->setId($id)->delete();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Image(s) was successfully deleted'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }
}
