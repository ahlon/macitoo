<?php
require_once dirname(__FILE__).'/reading.php';

class Task extends Reading_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('rd_task_model');
    }
    
    function index() {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        $params = array('user_id'=>$user_id);
        $tasks = $this->rd_task_model->find_all($params, null, $this->page_size, $this->page);
        
        $this->data = array('list'=>$tasks);
        
        $this->data['nav_idx'] = 'task';
        $this->widgets['content'][] = new Widget('reading/nav', $this->data);
        $this->widgets['content'][] = new Widget('reading/task/list', $this->data);
        $this->render();
    }
    
    function show($id) {
        
    }
    
    function save() {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        
        $post = $this->input->post(); 
        //print_r($post);
        $task = array('user_id'=>$user_id, 'plan_id'=>$post['plan_id'], 'name'=>$post['name'], 'status'=>'new');
        $this->rd_task_model->save($task);
        
        header('location:/reading/tasks');
    }
    
    function delete($task_id) {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        
        $task['user_id'] = $user_id;
        $task['id'] = $task_id;
    	
        $this->rd_task_model->delete($task);
        
        header('location:/reading/tasks');
    }
    
    function restart($task_id) {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        
        $task['user_id'] = $user_id;
        $task['id'] = $task_id;
        //$task['status'] = 'restarted';
    	
        $this->rd_task_model->update($task, array('status'=>'restarted'));
        
        header('location:/reading/tasks');
    }
}