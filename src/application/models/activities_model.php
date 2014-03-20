<?php
require_once dirname(__FILE__).'/base_model.php';

class Activities_model extends Base_model {
    public function __construct() {
        parent::__construct('activities');
    }
}
