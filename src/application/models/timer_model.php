<?php
require_once dirname(__FILE__).'/base_model.php';

class Timer_model extends Base_model {
    public function __construct() {
        parent::__construct('cr_timers');
    }
    
    function get_all($user_id, $page_size, $page) {
        $params = array('creator_id'=>$user_id);
        return $this->find_all($params, 'created_time desc', $page_size, $page);
    }
    
    function save(&$timer) {
    	if(!isset($timer['status'])) {
        	$timer['status'] = 'new';
    	}
        return parent::save($timer);
    }

    function get_ongoing_timer($user_id, $task_id) {
        $this->db->select('rt.*, ttr.*');
        $this->db->from($this->table_name.' rt');
        $this->db->join('rd_task_timer_rels ttr', 'rt.id = ttr.timer_id');
        $query = $this->db->where(array('rt.creator_id' => $user_id, 'ttr.task_id'=>$task_id , 'rt.status' => 'started'));
        $this->db->order_by('rt.start_time desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}