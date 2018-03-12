<?php

class MageProfis_CategoryCounter_Model_Counter {

    public function getResource($query) {
        $resource = Mage::getSingleton('core/resource');
        $writeConn = $resource->getConnection('core_write');
        return $writeConn->query($query);
    }

    public function viewCounter($observer) {
        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")) {
            return false;
        }
        $controller = $observer->getEvent()->getControllerAction();
        $request = $controller->getRequest();
        $category_id = (int) $request->getParam('id');
        $datetime = new DateTime();
        $datetime->setTime(0, 0);
        $date = $datetime->format('Y-m-d');
        if ($category_id) {

            return $this->getResource("INSERT INTO mp_categorycounter_views (category_id, views, created_at) VALUES (" . $category_id . ", 1, \"" . $date . "\") ON DUPLICATE KEY UPDATE views=views+1; ");
        }
    }

    public function setAttribute() {
        $coreResource = Mage::getSingleton('core/resource');
        $connection = $coreResource->getConnection('core_read');
        $resource = Mage::getResourceModel('catalog/category');
        $select = $connection->select()
                ->from($coreResource->getTableName('mp_categorycounter_views'));
        $data = $connection->fetchAll($select);
        $tmp = array();
        foreach ($data as $info) {
            $_category_id = (int) $info['category_id'];
            $_category_view = (int) $info['views'];
            $_date = $info['created_at'];
            if (array_key_exists($_category_id, $tmp)) {
                $tmp[$_category_id] = $tmp[$_category_id] + $_category_view;
            } else {
                $tmp[$_category_id] = $_category_view;
            }
            $_category = Mage::getModel('catalog/category')
                    ->load($_category_id);
            if ($_category && $_category->getId()) {
                $_category->setData('category_position_custom', $tmp[$_category_id]);
                $resource->saveAttribute($_category, 'category_position_custom');
            }
        }
        $this->clearCache();
    }

    public function cleanTable() {
        return $this->getResource("DELETE FROM mp_categorycounter_views WHERE created_at < DATE_SUB(NOW() , INTERVAL 1 WEEK)");
    }

    public function clearCache() {
        $allTypes = Mage::app()->useCache();
        foreach ($allTypes as $type => $cache) {
            Mage::app()->getCacheInstance()->cleanType($type);
        }
    }

}
