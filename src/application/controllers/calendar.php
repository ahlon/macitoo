<?php
require_once dirname(__FILE__).'/auth.php';

class Calendar extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
    }

    public function index($page = 'index') {
        $user_id = $this->session->userdata('user_id');
        $settings = $this->setting_model->get_user_settings($user_id);
        $data['user_settings'] = $settings;
        
        $this->widgets['content'] = new Widget('calendar/index', $this->data);
        $this->render();
//         $this->header_view();
//         $this->load->view('calendar/index', $data);
//         $this->footer_view();
    }
}
?>