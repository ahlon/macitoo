<?php
require_once dirname(__FILE__).'/admin.php';

class Motto extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('motto_model');
    }
    
    function index() {
        $groups = $this->motto_model->find_all();
        $this->data['list'] = $groups;
        
        $this->widgets['content'] = new Widget('motto/list', $this->data);
        $this->render();
    }
    
    function save() {
        $content = $this->input->post('content');
        $motto = array('content'=>$content);
        $this->motto_model->save($motto);
        header('location:/admin/mottos');
    }
}