<?php
require_once dirname(__FILE__).'/base_model.php';

class Rd_task_timer_model extends Base_model {
    public function __construct() {
        parent::__construct('rd_task_timer_rels');
    }

    function get_tasks_by_timer_id($timer_id) {
    	
    	$this->db->select('rt.*');
        $this->db->from($this->table_name.' ttr');
        $this->db->join('rd_tasks rt', 'rt.id = ttr.task_id');
        $query = $this->db->where(array('ttr.timer_id'=>$timer_id));
        $query = $this->db->get();
        return $query->result_array();
    }
}