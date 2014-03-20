<?php
class Segments_model extends CI_Model {
    public function __construct() {
       $this->load->database();
    }
    
    public function set_segment() {
        $data = array('text'=>$this->input->post('text'));
        return $this->db->insert('segments', $data);
    }
    
    public function list_segments() {
        $this->db->order_by("created_time", "desc");
        $query = $this->db->get('segments');
        $result = $query->result_array();
        return $result;
    }
    
    public function get_segment($id) {
        $query = $this->db->get_where('segments', array('id' => $id));
        $result = $query->result_array();
        return count($result) > 0 ? $result[0] : false;
    }
}