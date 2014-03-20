<?php
require_once dirname(__FILE__).'/auth.php';

class Timer extends Auth_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('timer_model');
    }
    
    function get_ongoing_timer($user_id) {
    	$timer_cond = array('creator_id' => $user_id, 'status'=>'started');
    	$timers = $this->timer_model->find_all($timer_cond, 'start_time desc');
    	if($timers) {
    	    $start_time = strtotime($timers[0]['start_time']);
        	$now = strtotime(date('Y-m-d H:i:s'));
        	if(($start_time + 25*60) > $now ) {
        		return $timers[0];
        	}
    	}

    	return NULL;
    }
    
    function index() {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        $timers = $this->timer_model->get_all($user_id, $this->page_size, $this->page);
        
        $this->data['list'] = $timers;
        
        $this->data['nav_idx'] = 'timer';
        $this->widgets['content'][] = new Widget('reading/nav', $this->data);
        $this->widgets['content'][] = new Widget('timer/index', $this->data);
        $this->render();
    }
    
    function view($id) {
        $timer = $this->timer_model->load($id);
        if ($this->url_suffix == 'data') {
        	$timer['start_timestamp'] = strtotime($timer['start_time'])*1000;
            echo json_encode($timer);
        } else if ($this->url_suffix == 'widgets') {
        
        } else if  ($this->url_suffix == 'layout') {
        
        } else {
        	$this->load->model('rd_task_timer_model');
    		$tasks = $this->rd_task_timer_model->get_tasks_by_timer_id($id);
    		$data['tasks'] = $tasks;
    		$data['timer'] = $timer;
    		
    		$this->widgets['content'] = new Widget('timer/view', $data);
    		$this->render();
        }
    }
    
    function add() {
    	
    	$can_add_timer = true;
    	
    	//first check if there's ongoing timer
    	$user_id = $this->user_id = $this->session->userdata('user_id');
    	$timer = $this->get_ongoing_timer($user_id);
    	if($timer) {
    		$can_add_timer = false;
    	}
    	
    	$data['add_timer'] = $can_add_timer;
    	
    	$this->load->model('rd_task_model');
    	$tasks = $this->rd_task_model->find_all(array('user_id'=>$user_id/*, 'status !='=>'finished'*/), 'created_time desc');
    	$data['list'] = $tasks;
    	
    	$this->widgets['content'] = new Widget('timer/new', $data);
    	$this->render();
    }
    
    function add_timer() {
    	//print_r($_POST);

    	$user_id = $this->user_id = $this->session->userdata('user_id');
    	$timer_name = $_POST['timer_name'];
    	$timer = array('name'=>$timer_name, 'creator_id'=>$user_id);
    	$this->timer_model->save($timer);
    	
    	$tasks_info = $_POST['tasks'];
    	foreach ($tasks_info as $task_id=>$selected) {
    		if($selected) {
    			echo "selected ";
	    		$task_timer_rel = array('task_id' => $task_id, 'timer_id' => $timer['id']);
	    		$this->load->model('rd_task_timer_model');
    			$task_timer_rel_existed = $this->rd_task_timer_model->find_all($task_timer_rel);
    			if(!$task_timer_rel_existed) {
    				echo "don't existed ";
			        $this->rd_task_timer_model->save($task_timer_rel);
    			} else {
    				echo "existed ";
    			}
    		}
    			echo "don't selected ";
    	}
    	
        header('location:/timers');
    }
    
    function save() {
        $user_id = $this->user_id = $this->session->userdata('user_id');
        $name = $this->input->post('name');
        $timer = array('name'=>$name, 'creator_id'=>$user_id);
        $this->timer_model->save($timer);
        
        header('location:/timers');
    }
    
    function start($id) {
    	/*$user_id = $this->user_id = $this->session->userdata('user_id');
    	if($this->get_ongoing_timer($user_id)) {
    		
    	}*/
        $data = array('status'=>'started', 'start_time'=>date('Y-m-d H:i:s'));
        $this->timer_model->update(intval($id), $data);
        header('location:/timer/view/'+$id);
    }
    
    function update($id, $status='finished') {
    	$data = array('last_updated_time' => date('Y-m-d H:i:s'), 'status'=>$status);
    	$this->timer_model->update(intval($id), $data);
        header('location:/timers');
    }
    
    
    function finish_task($task_id) {
    	//$task['id'] = $task_id;
    	//$task['status'] = 'finished';
    	
    	$this->load->model('rd_task_model');
    	$this->rd_task_model->update(intval($task_id), array('status'=>'finished'));
    }
    
    function pause($id) {
    	$this->update($id, 'paused');
    	
        //header('location:/timers');
    }
    
    function load_next($id) {
    	$this->update($id);
    	
    	//TODO: load next task;
    }
    
    function stop() {
        
    }
    
    function delete() {
        
    }
    
}
