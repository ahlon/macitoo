<?php
require_once dirname(__FILE__) . '/base_model.php';

class Zone_model extends Base_model {
    function __construct() {
        parent::__construct('zone');
    }
    
    function save($zone) {
        if (!empty($zone['parent_id'])) {
            $parent = $this->load($zone['parent_id']);
            $zone['path'] = $parent['path'].$parent['id'].'>';
        }
        $zone = parent::save($zone);
        return $zone;
    }
}