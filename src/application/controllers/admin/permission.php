<?php
require_once dirname(__FILE__).'/admin.php';

class Permission extends Admin_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('permission_model');
        $permissions = $this->permission_model->find_all();
        $this->data['list'] = $permissions;
    
        $this->widgets['content'] = new Widget('permission/list', $this->data);
        $this->render();
    }
}