<?php
require_once dirname(__FILE__).'/base_model.php';

class Goal_model extends Base_model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_user_goal_count($user_id) {
    	if(!isset($user_id) OR $user_id == FALSE) {
    		return FALSE;
    	}
    	$query = $this->db->from('gl_goals')
    			 ->where('user_id', $user_id)
    			 ->where('status', 'active')
    			 ->count_all_results();
    	return $query;
    }
    
    public function get_user_goal_statistics($user_id) {
    	/*$sql = "select status, count(*) count from goals where user_id=? group by status;";
    	$query = $this->db->query($sql, array($this->user_id));		 
    	foreach ($query->result() as $row) {
    		$goal_statistics[$row->status] = $row->count;
    	}

    	return $goal_statistics;*/
    	
    	$this->db->select('status, count(*) count')->from('gl_goals')
    			 ->where('user_id', $user_id)
    			 ->group_by('status');
    	$query = $this->db->get();		 
		$ret = $query->result();
    	$num_of_all_goals = 0;
    	
        foreach ($ret as $row) {
        	//echo "status ".$row->status;
    		$goal_statistics[$row->status] = (int)$row->count;
    		$num_of_all_goals += (int)$row->count;
    	}
    	$goal_statistics['all'] = $num_of_all_goals;
    	
    	return $goal_statistics;
    }
    
    public function get_goal_by_userid($user_id) {
		$query = $this->db->get_where('gl_goals', array('user_id'=>$user_id));
    	return $query->result_array();
    }
    
    public function get_active_goal_by_userid($user_id) {
    	$query = $this->db->get_where('gl_goals', array('user_id'=>$user_id,
    												 'status'=>'active'));
    	if($query->num_rows() > 0) {
    		return $query->result_array();
    	}	
    	return false;
    }
    
    public function get_goal_by_status($user_id, $status) {
    	$query = $this->db->get_where('gl_goals', array('user_id'=>$user_id,
    												 'status'=>$status));
    	if($query->num_rows() > 0) {
    		return $query->result_array();
    	}	
    	return false;    	
    }
    
    public function get_goal_by_goal_id($goal_id) {
    	$query = $this->db->get_where('gl_goals', array('id'=>$goal_id));
        if($query->num_rows() > 0) {
    		return $query->result_array();
    	}	
    	return false;	
    }
    
    public function add_goal($user_id, $goal, $goal_type) {
    	$now = time();
        $end = strtotime("+21 days", $now);
        
    	$data = array(
               'user_id' => $user_id,
               'name' => $goal,
               'goal_type_id' => $goal_type,
    	       'started_on'=>date('Y-m-d H:i:s', $now),
               'ended_on'=>date('Y-m-d H:i:s', $end),
               'status'=>'new'  
            );

		$ret = $this->db->insert('gl_goals', $data);
		return $ret; 
    }
    
    public function activate_goal($user_id, $goal_id) {
    	$now = time();
    	$end = strtotime("+21 days", $now);
    	$data = array(
    			'started_on'=>date('Y-m-d H:i:s', $now),
    			'ended_on'=>date('Y-m-d H:i:s', $end), 
    	        'status'=>'active'
    			);
    	$this->db->where('id', $goal_id )
    			 ->where('user_id', $user_id)
    			 ->where('status !=', 'active');
    	$query = $this->db->update('gl_goals', $data);
    	return $query;
    }
    
    public function end_goal($user_id, $goal_id) {
    	$now = time();
    	$data = array(
    			'ended_on'=>date('Y-m-d H:i:s', $now), 
    	        'status'=>'fail'
    			);
    	$this->db->where('id', $goal_id )
    			 ->where('user_id', $user_id)
    			 ->where('status !=', 'fail');
    	$query = $this->db->update('gl_goals', $data);
    	//var_dump($query);
    	
    	return $query;
    }    
}