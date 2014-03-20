<?php
require_once dirname(__FILE__).'/base_model.php';

class Rd_status_model extends Base_Model {
    function __construct() {
        $this->table_name = 'rd_status';
        $this->load->database();
    }
    
    function get_reading_statuses($params, $orderby, $page_size, $page) {
        $this->db->select('rs.*, bk.*');
        $this->db->from($this->table_name.' rs');
        $this->db->join('cr_books bk', 'bk.id = rs.book_id');
        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }
        if (!empty($page_size) && !empty($page)) {
            $start = $page_size * ($page - 1);
            $this->db->limit($page_size, $start);
        }
        $this->db->where($params);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_reading_status($user_id, $book_id) {
        $params = array('user_id'=>$user_id, 'book_id'=>$book_id);
        return $this->find_one($params);
    }

    function get_user_reading_status($user_id, $stauts) {
        $this->db->select('rs.*, bk.*');
        $this->db->from($this->table_name.' rs');
        $this->db->join('cr_books bk', 'bk.id = rs.book_id');
        $query = $this->db->where(array('rs.user_id' => $user_id, 'rs.status' => $stauts));
        $query = $this->db->get();
        return $query->result_array();
    }
    
//     function get_book_rd_status_count($book_id, $rd_status) {
//         $this->db->select('count(1)');
//         $this->db->from($this->table_name);
//         $query = $this->db->where(array('book_id' => $book_id, 'status' => $rd_status));
//         $query = $this->db->get();

//         return $query->row_array();
//     }

    function get_book_rd_status_statistics($book_id) {
        $this->db->select('book_id, sum(case status when "do" then 1 else 0 end) do_count, 
                sum(case status when "wish" then 1 else 0 end) wish_count,
	            sum(case status when "collect" then 1 else 0 end) collect_count');
        $this->db->from($this->table_name);
        $this->db->where(array('book_id' => $book_id));
        $this->db->group_by("book_id");
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_book_reading_statuses($book_id, $status = '') {
        $this->db->from($this->table_name);
        $where = array('book_id' => $book_id);
        if (!empty($status)) {
            $where['status'] = $status;
        }
        $this->db->where($where);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    function save_or_update_user_reading_status($user_id, $book_id, $status) {
        print_r(func_get_args());
        // $user_id = $this->input->get('user_id');
        if (!$user_id || !$book_id) {
            return false;
        }
        $key = array('user_id'=>$user_id, 'book_id'=>$book_id);
        $rd_status = $this->find_one($key);
        if (empty($rd_status)) {
            // create
            $data = array('user_id'=>$user_id, 'book_id'=>$book_id, 'status'=>$status);
            return $this->save($data);
        } else {
            // update
            $data = array('status'=>$status);
            return $this->update($key, $data);
        }
    }
}