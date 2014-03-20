<?php
require_once dirname(__FILE__).'/base_model.php';

class User_model extends Base_model {
    public function __construct() {
        parent::__construct('cr_users');
    }

    public function get_user($user_id) {
        $query = $this->db->get_where('cr_users', array('id' => $user_id));
        $result = $query->result_array();
        return count($result) > 0 ? $result[0] : false;
    }
}