<?php
require_once dirname(__FILE__).'/reading.php';

class Plan extends Reading_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('rd_plan_model');
        $this->load->model('rd_status_model');
        $this->load->model('rd_task_model');
        $this->load->model('book_model');
        $this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('comment_model');
        $this->load->helper('utils');
    }
    
    function index() {
        $this->data['list'] = $this->rd_plan_model->find_all();
        
        $this->data['nav_idx'] = 'plan';
        $this->widgets['content'][] = new Widget('reading/nav', $this->data);
        $this->widgets['content'][] = new Widget('reading/plan/list', $this->data);
        $this->render();
    }

    function in_progress() {
        $data['status'] = 'in-progress';
        $data['datalist'] = $this->rd_plan_model->get_user_reading_statuses(1, 'do');
        
        $this->widgets['content'][] = new Widget('reading/nav', $data);
        $this->widgets['content'][] = new Widget('reading/plan/list', $data);
        $this->render();
    }
    
    function not_started() {
        $data['status'] = 'not-started';
        $data['datalist'] = $this->rd_plan_model->get_user_reading_statuses(1, 'collect');
        
        $this->widgets['content'] = new Widget('reading/plan/list', $data);
        $this->render();
    }
    
    function finished() {
        $data['status'] = 'finished';
        $data['datalist'] = $this->rd_plan_model->get_user_reading_statuses(1, 'wish');
        
        $this->widgets['content'] = new Widget('reading/plan/list', $data);
        $this->render();
    }
    
    function make($obj_type, $obj_id) {
        $book_id = $obj_id;
        $book = $this->book_model->load($book_id);
        $statistic = $this->rd_status_model->get_book_rd_status_statistics($book['id']);
        $book += $statistic;
        
        $user_id = $this->user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $r = $this->rd_status_model->get_reading_status($user_id, $book['id']);
            if ($r) {
                $book['rd_status'] = $r['status'];
            } else {
                $book['rd_status'] = '';
            }
        } else {
            $book['rd_status'] = '';
        }
        $book['comment_count'] = 0;
        $data['item'] = $book;
        
        $comments = $this->comment_model->get_by_obj('book', $book_id, 10, 1);
        $data['comments'] = $comments;
        
        $statuses = $this->rd_status_model->get_book_reading_statuses($book_id);
        $rd_statuses = array();
        foreach ($statuses as $st) {
            $st['nice_time'] = nice_time(strtotime($st['created_time']));
            $st['user'] = $this->user_model->get_user($st['user_id']);
            $st['user_settings'] = $this->setting_model->get_user_settings($st['user_id']);
            $rd_statuses[$st['status']][] = $st;
        }
        
        $data['rd_statuses'] = $rd_statuses;
        
        $this->widgets['content'] = new Widget('reading/plan/new', $data);
        $this->render();
    }
    
    function save() {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        
        $post = $this->input->post();
        //print_r($post);
        $plan = array(
            'user_id'=>$user_id,
        	'title'=>$post['title'],
            'book_id'=>$post['book_id'],
            'start_time'=>$post['start_time'],  
            'end_time'=>$post['end_time'],
            'status'=>'not-started'
        );
        $this->rd_plan_model->save($plan);
        
        foreach ($post['tasks'] as $_task) {
            $task = array();
            $task['plan_id'] = $plan['id'];
            $task['book_id'] = $post['book_id'];
            $task['user_id'] = $user_id;
            $task['name'] = $_task['title'];
            $task['start_time'] = date('Y-m-d', $_task['start'] / 1000);
            $task['end_time'] = date('Y-m-d', $_task['end'] / 1000);
            $task['status'] = 'new';
            $this->rd_task_model->save($task);
        }
        
        //header('location:/reading/plans');
    }
    
    function break_down($plan_id) {
   		$user_id = $this->user_id = $this->session->userdata('user_id'); 	
   		$this->load->model('rd_plan_model');
   		$plan = $this->rd_plan_model->load($plan_id);
   		$tasks = $this->rd_task_model->find_all(array('plan_id'=>$plan_id));
   		$data['plan'] = $plan;
   		$data['tasks'] = $tasks;
   		
   		$this->widgets['content'] = new Widget('reading/task/new', $this->data);
   		$this->render();
    }
}
?>