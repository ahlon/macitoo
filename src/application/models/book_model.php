<?php
require_once dirname(__FILE__).'/base_model.php';

class Book_model extends Base_model {
    public function __construct() {
        parent::__construct('cr_books');
    }
    
    function get_book($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get($this->table_name);
            return $query->result_array();
        }
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row_array();
    }
    
    function list_books($pagesize, $page) {
        return $this->find_all(array(), 'created desc', $pagesize, $page);
    }
    
    function set_book() {
        $this->load->helper('url');
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $data = array('title' => $this->input->post('title'), 'slug' => $slug, 'text' => $this->input->post('text'));
        return $this->db->insert('news', $data);
    }
}