<?php
class Zone_service extends Base_service {

    function __construct() {
        parent::__construct($this->zone_model);
    }
    
    function save($zone) {
        return $this->zone_model->save($zone);
    }

}