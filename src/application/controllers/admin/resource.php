<?php
require_once dirname(__FILE__).'/admin.php';

class Resource extends Admin_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->load->model('resource_model');
        $users = $this->resource_model->find_all();
        $this->data['list'] = $users;
    
        $this->widgets['content'] = new Widget('resource/list', $this->data);
        $this->render();
    }

}