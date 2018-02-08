<?php

class MageProfis_CategoryCounter_Model_Counter {

    public function getResource($query) {
        $resource = Mage::getSingleton('core/resource');
        $writeConn = $resource->getConnection('core_write');
        return $writeConn->query($query);
    }

    public function viewCounter($observer) {

        $controller = $observer->getEvent()->getControllerAction();
        $request = $controller->getRequest();
        $category_id = (int) $request->getParam('id');

        if ($category_id) {
            return $this->getResource("INSERT INTO mp_categorycounter_views (category_id, views) VALUES (" . $category_id . ", 1) ON DUPLICATE KEY UPDATE views=views+1; ");
        }
    }

    public function setAttribute() {

        $coreResource = Mage::getSingleton('core/resource');
        $connection = $coreResource->getConnection('core_read');

        $select = $connection->select()
                ->from($coreResource->getTableName('mp_categorycounter_views'));

        $data = $connection->fetchAll($select);

        $resource = Mage::getResourceModel('catalog/category');

        foreach ($data as $info) {
            $_category_id = $info['category_id'];
            $_category_view = $info['views'];

            $_category = Mage::getModel('catalog/category')
                    ->load($_category_id);

            $_category->setData('category_position_custom', $_category_view);
            $resource->saveAttribute($_category, 'category_position_custom');
        }
        $this->clearCache();
    }

    public function cleanTable() {
        return $this->getResource("truncate table mp_categorycounter_views;");
    }

    public function clearCache() {
        $allTypes = Mage::app()->useCache();
        foreach ($allTypes as $type => $cache) {
            Mage::app()->getCacheInstance()->cleanType($type);
        }
    }

}
