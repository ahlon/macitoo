<?php
require_once dirname(__FILE__).'/auth.php';

class Widget extends Auth_Controller {
    public function __construct() {
        parent::__construct();
    }
    
//     public function view($id) {
//         $this->load->view('templates/header', $data);
//         $this->load->view('news/index', $data);
//         $this->load->view('templates/footer');
//     }
    
    public function view($name) {
        $datasource = $this->input->get('datasource');
        $this->load->view('default/res');
        $this->load->view('widgets/'.$name);
    }
    
    public function index() {
        // $datasource = $this->input->get('datasource');
        $this->load->view('default/res');
        $this->load->view('widgets/index');
    }
}