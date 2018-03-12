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
                ), 'Views')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    'identity' => false,
    'unsigned' => true,
    'nullable' => false,
    'primary' => false,
        ), 'Created At');
$installer->getConnection()->createTable($table);

$installer->run("ALTER TABLE mp_categorycounter_views drop primary key, add primary key(category_id, created_at);");

$installer->endSetup();
