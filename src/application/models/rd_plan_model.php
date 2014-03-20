<?php
class Rd_plan_model extends Base_Model {
    public function __construct() {
        $this->table_name = 'rd_plans';
        $this->load->database();
    }

    public function get_user_reading_statuses($user_id, $stauts) {
        $this->db->select('rs.*, bk.*');
        $this->db->from($this->table_name.' rs');
        $this->db->join('cr_books bk', 'bk.id = rs.book_id');
        $query = $this->db->where(array('rs.user_id' => $user_id, 'rs.status' => $stauts));
        $query = $this->db->get();
        return $query->result_array();
    }
}

