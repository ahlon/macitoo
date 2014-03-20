<?php
require_once dirname(__FILE__).'/base_model.php';

class Comment_model extends Base_model {
    
    public function __construct() {
        parent::__construct('cr_comments');
    }
    
//     public function save($comment) {
//         $comment['created_time'] = date('Y-m-d H:i:s');
//         return $this->db->insert($this->table_name, $comment);
//     }

    function find_all($params = array(), $orderby = null, $page_size = 0, $page = 1) {
        $this->db->select('cm.*, ur.display_name');
        $this->db->from($this->table_name.' cm');
        $this->db->join('cr_users ur', 'ur.id = cm.creator_id');
        $this->db->where($params);
        $this->db->order_by('created_time', 'desc');
        
//         if (!empty($orderby)) {
//             $this->db->order_by($orderby);
//         }
        if (!empty($page_size) && !empty($page)) {
            $start = $page_size * ($page - 1);
            $this->db->limit($page_size, $start);
        }
        return $this->db->get()->result_array();
    }
    
    function get_by_obj($obj_type, $obj_id, $pagesize, $page) {
        $this->db->select('cm.*, ur.display_name');
        $this->db->from($this->table_name.' cm');
        $this->db->join('cr_users ur', 'ur.id = cm.creator_id');
        $this->db->where(array('cm.obj_type' => $obj_type, 'cm.obj_id'=>$obj_id));
        $this->db->order_by('created_time', 'desc');
        if ($pagesize && $page) {
            $start = $pagesize * ($page - 1);
            $this->db->limit($pagesize, $start);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}