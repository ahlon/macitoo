<?php
require_once dirname(__FILE__).'/auth.php';

class Todo extends Auth_Controller {
    public function index($page = 'index') {
        if ( ! file_exists('application/views/todo/'.$page.'.php')) {
            show_404();
        }
        
		// $this->check_login_status();

        
        $data['title'] = ucfirst($page); // Capitalize the first letter
        //$this->load->library('layout');
        $this->layout->setSlot('header', $data);
        $this->layout->setSlot('content', $data, 'index.php');
        $this->layout->setSlot('footer');
        $this->layout->view($data);
    }
}
?>