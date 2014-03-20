<?php
require_once dirname(__FILE__).'/base_model.php';

class Rd_task_model extends Base_Model {
    public function __construct() {
        $this->table_name = 'rd_tasks';
        $this->load->database();
    }
}