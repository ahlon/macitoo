<?php
require_once dirname(__FILE__).'/base_model.php';

class Project_records_model extends Base_model {
    public function __construct() {
        parent::__construct('project_records');
    }
    
    public function set_record() {
        $data = array('record'=>$this->input->post('record'));
        return $this->db->insert('project_records', $data);
    }
    
    public function list_records() {
        $this->db->order_by("created_time", "desc");
        $query = $this->db->get('project_records');
        $result = $query->result_array();
        return $result;
    }    
}
