<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 * Date: 20.01.19
 * Time: 16:22
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$uploaderTable = $installer->getTable('pugnet_uploader/images');

if (!$installer->tableExists($uploaderTable)) {
    $table = $installer->getConnection()
        ->newTable($uploaderTable)
        ->addColumn('image_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, [
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ], 'Image ID')
        ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, [
            'nullable'  => false,
        ], 'Image')
        ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, [
            'nullable'  => false,
        ], 'Product ID')
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [
            'nullable'  => false,
        ], 'Image visible name')
        ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, [
            'nullable'  => false,
            'default'   => 0,
        ], 'Display position')
        ->addColumn('accepted', Varien_Db_Ddl_Table::TYPE_TINYINT, 4, [
            'nullable' => false,
            'default'   => 0,
        ], 'Image Status');

    $installer->getConnection()->createTable($table);
}
$installer->endSetup();
