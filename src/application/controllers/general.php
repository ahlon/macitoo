<?php
require_once dirname(__FILE__).'/base.php';

class General extends Base_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    function index($obj_type) {
        $this->load_model($obj_type);
        $list = $this->model->find_all();
        $this->data['list'] = $list;
        
        $this->widgets['content'] = new Widget('default/list', $this->data);
        $this->render();
    }
    
    function view($obj_type, $obj_id) {
        $this->load_model($obj_type);
        $obj = $this->model->load($obj_id);
        $this->data['item'] = $obj;
        
        $this->widgets['content'] = new Widget('default/view', $this->data);
        $this->render();
    }
    
    function add($obj_type) {
    }
    
    function save($obj_type) {
    }
    
    function edit($obj_type, $obj_id) {
    }
    
    function update($obj_type, $obj_id) {
    }
    
    function delete($obj_type, $obj_id) {
    }
    
    function load_model($model) {
        if (!file_exists(APPPATH.'models/'.$model.'.php')) {
            $this->load->model('base_model', 'model');
            $this->model->table_name = $model;
        } else {
            $this->load->model($model, 'model');
        }
    }
}
