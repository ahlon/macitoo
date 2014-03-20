<?php
class Setting_model extends Base_Model {
    public function __construct() {
         parent::__construct('cr_user_settings');
    }

    public function get_user_settings($user_id) {
        $query = $this->db->get_where('cr_user_settings', array('user_id' => $user_id));
        $result = $query->result_array();
        return count($result) > 0 ? $result[0] : false;
    }
}