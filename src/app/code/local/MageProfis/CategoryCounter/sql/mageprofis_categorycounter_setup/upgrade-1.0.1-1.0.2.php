<?php

$installer = $this;

$installer->startSetup();

$installer->addAttribute('catalog_category', 'category_position_custom', array(
    'input' => 'text',
    'type' => 'int',
    'group' => 'Category sorting',
    'label' => 'Category sort position',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'used_in_product_listing' => true,
    'user_defined' => false,
    'default' => null,
));

$installer->endSetup();
