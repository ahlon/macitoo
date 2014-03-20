<?php
require_once dirname(__FILE__).'/base_model.php';

class Group_model extends Base_model {
    public function __construct() {
        parent::__construct('cr_groups');
    }
}