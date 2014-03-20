<?php
require_once dirname(__FILE__).'/base_model.php';

class Account_model extends Base_model {
    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }
    
    public function auth($user_name, $password) {
        $query = $this->db->get_where('cr_users', array('email' => $user_name, 'password' => $password));
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            $this->session->set_userdata($user);
            return true;
        }
        return false;
    }
}