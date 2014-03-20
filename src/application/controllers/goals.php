<?php
//require_once dirname(__FILE__).'/../../service/GoalService.php';
require_once dirname(__FILE__).'/auth.php';

class Goals extends Auth_Controller {
	var $goal_status_array  = array('all', 'active', 'success', 'fail', 'new');
	
    public function __construct() {
        parent::__construct();
        $this->load->model('goal_model');
    }

    public function index($goal_status_idx = 0) {
        $goals_all = array();
        
        //get all goals
        if($goal_status_idx == 0) {
        	$goals_all = $this->goal_model->get_goal_by_userid($this->mct_user['id']);
        } else {
        	$goals_all =  $this->goal_model->get_goal_by_status($this->mct_user['id'], $this->goal_status_array[$goal_status_idx]);
        }
        
        $data['goals_all'] = $goals_all;
        
        $goal_statistics = $this->goal_model->get_user_goal_statistics($this->mct_user['id']);
        $data['active_idx'] = $goal_status_idx;
        $data['goal_statistics'] = $goal_statistics;
        
        $this->widgets['content'][] = new Widget('goals/goal_menu', $data);
        $this->widgets['content'][] = new Widget('goals/all-goals', $data);
        $this->render();
        
    }
    
    public function view($id) {
    	$ret = $this->goal_model->get_goal_by_goal_id($id);
    	if($ret === FALSE OR empty($ret[0])) {
    		show_404();
    		return;
    	}
    	$data['goal'] = $ret[0];
    	$this->load->model('project_records_model');
    	$data['project_records'] = $this->project_records_model->list_records();
    	
    	$this->widgets['content'][] = new Widget('goals/view', $data);
    	$this->render();
    }
    
    //display goals by status
    public function all() {
    	$this->index(0);
    }
    
    public function in_progress() {
    	$this->index(1);
    }
    
    public function succeeded() {
  		$this->index(2);
    }
    
    public function failed() {
  		$this->index(3);
    }

    private function goal_menu_view($menu_idx = 0) {
        $goal_statistics = $this->goal_model->get_user_goal_statistics($this->mct_user['id']);
        $data['active_idx'] = $menu_idx;
        $data['goal_statistics'] = $goal_statistics;
        
        $this->widgets['content'][] = new Widget('goals/view', $data);
        $this->render();
        
        $this->assembly->render_by_default(array('template'=>'goals/goal_menu', 'data'=>$data));
    }
    
    //display the add goal page
    public function add($info = NULL) {
        //$goal_statistics = $this->goal_model->get_user_goal_statistics($this->user_id);
        //$info['goal_statistics'] = $goal_statistics;
        $goal_status_idx = 4;
    	$data['active_idx'] = $goal_status_idx;
    	
    	$goal_statistics = $this->goal_model->get_user_goal_statistics($this->mct_user['id']);
    	$data['goal_statistics'] = $goal_statistics;
    	
    	$this->widgets['content'][] = new Widget('goals/goal_menu', $data);
    	$this->widgets['content'][] = new Widget('goals/add_goal', $data);
    	$this->render();
    }
    
    //process the add goal form
    public function add_goal() {
        $this->load->helper('form');
  		$this->load->library('form_validation');
  		
  		$this->form_validation->set_rules('goalType', 'goalType', 'required');
        $this->form_validation->set_rules('goal', 'goal', 'required');
        
      	if ($this->form_validation->run() === FALSE) {
  			$data['validation_error'] = TRUE;
			$this->add($data);
			return;
  		}
  		
  		$ret = $this->goal_model->add_goal($this->mct_user['id'],
  										   $this->input->post('goal'), 
  										   $this->input->post('goalType'));
  		if(! $ret) {
  			$data['add_goal_error'] = TRUE;
			$this->add($data);
			return;
  		} else {
  			$data['add_goal_success'] = TRUE;
			$this->add($data);
			return;
  		}
    }
    
    public function activate($goal_id) {
    	$ret = $this->goal_model->activate_goal($this->mct_user['id'], $goal_id);
    	if($ret) {
    		$this->in_progress();
    	} else {
    		$this->all();
    	}
    }
    
    public function end($goal_id) {
    	$ret = $this->goal_model->end_goal($this->user_id, $goal_id);
    	if($ret) {
    		$this->failed();
    	} else {
    		$this->all();
    	}
    }
    
    public function edit($goal_id) {
    	
    }
    
    public function get_goal_activities($goal_id) {
    	$this->load->model('activities_model');
    	$activities = $this->activities_model->find_all(array('user_id'=>$this->mct_user['id'], 'goal_id'=>$goal_id));
    	
    	echo json_encode($activities);
    }
    
    public function add_activitiy($goal_id) {
    	$this->load->model('activities_model');
    	$activity = array('goal_id'=>$goal_id, 
    					  'user_id'=>$this->mct_user['id'], 
    					  //'status'=>'ok',
    					  'day'=>date('Y-m-d'));
    	if($this->activities_model->find_all($activity)) {
			$this->activities_model->update($activity, array('status'=>'ok'));
    	} else {
			$activity['status'] = 'ok';
	    	$this->activities_model->save($activity);
    	}
    	
    }
    
    public function add_record() {
    	$content = $_POST['record'];
        $this->load->model('project_records_model');
    	$this->project_records_model->set_record();	
    	
    }
}