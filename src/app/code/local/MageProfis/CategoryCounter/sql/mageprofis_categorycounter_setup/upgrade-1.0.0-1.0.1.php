<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
        ->newTable($installer->getTable('mp_categorycounter_views'))
        ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => false,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
                ), 'Product Id')
        ->addColumn('views', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity' => false,
    'unsigned' => true,
    'nullable' => false,
    'primary' => false,
        ), 'Views');
$installer->getConnection()->createTable($table);

$installer->endSetup();
