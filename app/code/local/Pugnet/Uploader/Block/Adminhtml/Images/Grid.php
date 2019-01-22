<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/**
 * Class Pugnet_Uploader_Block_Adminhtml_Images_Grid
 */
class Pugnet_Uploader_Block_Adminhtml_Images_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Pugnet_Uploader_Block_Adminhtml_Images_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('imagesGrid');
        $this->setDefaultSort('image_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('pugnet_uploader/images')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('image_id', [
            'header'    => $this->__('Image ID'),
            'index'     => 'image_id',
            'type'      => 'number',
            'align'     => 'right',
            'width'     => '150px',
        ]);

        $this->addColumn('product_id', [
            'header'    => $this->__('Product ID'),
            'index'     => 'product_id',
            'type'      => 'number',
            'align'     => 'right',
            'width'     => '300px',
        ]);

        $this->addColumn('position', [
            'header'    => $this->__('Position'),
            'index'     => 'position',
            'type'      => 'number',
            'align'     => 'right',
            'width'     => '150px',
        ]);

        $this->addColumn('accepted', [
            'header'    => $this->__('Accepted'),
            'index'     => 'accepted',
            'type'      => 'options',
            'align'     => 'right',
            'width'     => '150px',
            'options'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
        ]);

        $this->addColumn('name', [
            'header'    => $this->__('Name'),
            'index'     => 'name',
        ]);

        return parent::_prepareColumns();
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

    /**
     * @return $this|Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('image_id');
        $this->getMassactionBlock()->setFormFieldName('image_ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('delete', [
            'label'     => $this->__('Delete Images'),
            'url'       => $this->getUrl('*/*/massDelete'),
            'confirm'   => $this->__('Are you sure?')
        ]);
        return $this;
    }
}
