<?php
require_once dirname(__FILE__).'/admin.php';

class Group extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('group_model');
    }
    
    function index() {
        $groups = $this->group_model->find_all();
        $this->data['list'] = $groups;
        
        $this->widgets['content'] = new Widget('group/list', $this->data);
        $this->render();
    }
    
    function save() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $group = array('name'=>$name, 'description'=>$description);
        echo $this->group_model->save($group);
    }
}