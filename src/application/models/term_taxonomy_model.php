<?php
require_once ('application/models/base_model.php');

class Term_taxonomy_model extends Base_model {
    protected $_term_id;
    protected $_taxonomy;
    protected $_description;
    protected $_parent;
    protected $_treepath;
    protected $_count;
    protected $_total_count;
    
    public function __construct() {
        parent::__construct('cr_term_taxonomy');
    }
    
    function get_tags($params = array()) {
        $this->db->select('tt.*, tm.name');
        $this->db->from('cr_term_taxonomy tt');
        $this->db->join('cr_terms tm', 'tm.id = tt.term_id');
        $query = $this->db->where($params);
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>