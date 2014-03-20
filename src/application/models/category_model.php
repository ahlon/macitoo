<?php
require_once dirname(__FILE__).'/base_model.php';

class Category_model extends Base_model {
    public function __construct() {
        parent::__construct('cr_term_taxonomy');
    }
    
    function load($id) {
        $view_name = 'v_categories';
        return $this->db->from($view_name)->where(array('id'=>$id))->get()->row_array();
    }

    function save($category) {
        $term = $this->get_term_by_name($category['name']);
        $params = array('term_id'=>$term['id']);
        $cat = $this->find_one($params);
        if ($cat) {
            return false;
        } else {
            $cat = array(
                'term_id'=>$term['id'],       
                'parent'=>$category['parent'],
                'taxonomy'=>$category['taxonomy'],
                'description'=>$category['description'],
                'creator_id'=>1,
                'created_time'=>date('Y-m-d H:i:s')
            );
            if ($category['parent']) {
                $parent = $this->load($category['parent']);
                $treepath = $parent['treepath'].$parent['id'].'>';
                $cat['treepath'] = $treepath;
            }
            $flag = parent::save($cat);
            return $cat;
        }
    }
    
    function get_root_categories($taxonomy = 'category') {
        $view_name = 'v_categories';
        $this->db->from($view_name);
        $this->db->where(array('taxonomy'=>$taxonomy));
        $this->db->where('parent is null', null);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_children($id) {
        $params = array('parent'=>$id);
        return $this->find_all($params);
    }
    
    /* (non-PHPdoc)
     * @see Base_model::find_all()
     */
    public function find_all($params = array(), $orderby = null, $page_size = 0, $page = 1) {
//         $this->db->select('tt.*, tm.name');
//         $this->db->from($this->table_name.' tt');
//         $this->db->join('cr_terms tm', 'tm.id = tt.term_id');
        $view_name = 'v_categories';
        $this->db->from($view_name);
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

	function get_term_by_name($name) {
        // ge term by name, if does not exits, then create one
        $params = array('name'=>$name);
        $term = $this->db->from('cr_terms')->where($params)->get()->row_array();
        if (!$term) {
            $term = array(
                'name'=>$name
            );
            $term['created_time'] = date('Y-m-d H:i:s');
            $flag = $this->db->insert('cr_terms', $term);
            $term['id'] = $this->db->insert_id();
        }
        return $term;
    }

}