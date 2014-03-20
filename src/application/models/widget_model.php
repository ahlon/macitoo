<?php
require_once dirname(__FILE__).'/base_model.php';

class Widget_model extends Base_Model {
    public function __construct() {
        parent::__construct('widgets');
    }
    
    function get($name) {
        if ($name == 'header') {
            return array('template'=>'default/header', 'data'=>null);
        } else if ($name == 'footer') {
            return array('template'=>'default/footer', 'data'=>null);
        } else {
            return false;
        }
    }
    
}