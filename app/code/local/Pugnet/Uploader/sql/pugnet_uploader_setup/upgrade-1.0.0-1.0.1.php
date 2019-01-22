<?php
/**
 * Created by PhpStorm.
 * User: Pugnet Maciej Powallo
 */

/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$tableName = $installer->getTable('catalog/product');
$attributeExists = (bool)$installer->getAttributeId(Mage_Catalog_Model_Product::ENTITY, 'upload_images');

if (!$attributeExists) {
    $installer->addAttribute(
        Mage_Catalog_Model_Product::ENTITY,
        'upload_images',
        [
            'group'            => 'General',
            'type'             => 'varchar',
            'backend'          => 'eav/entity_attribute_backend_array',
            'label'            => 'Enable images for this product',
            'input'            => 'multiselect',
            'visible'          => true,
            'required'         => false,
            'visible_on_front' => true,
            'global'           => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
            'position'         => 50,
            'source'           => 'pugnet_uploader/product_attribute_source_images',
            'apply_to'         => implode(
                ',',
                [
                    Mage_Catalog_Model_Product_Type::TYPE_SIMPLE,
                    Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE,
                ]
            ),
        ]
    );
}

$installer->endSetup();
