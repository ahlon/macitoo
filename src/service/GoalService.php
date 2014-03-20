<?php
require_once dirname(__FILE__).'/../dao/GoalDao.php';

class GoalService {
    private $dao;
    
    public function __construct() {
        $this->dao = new GoalDao();
    }
    
    function saveGoal($goalstr, $goaltype) {
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        $now = time();
        $end = strtotime("+21 days", $now);
        $goal = array(
            'name'=>$goalstr,
        	'goal_type_id'=>$goaltype,
            'user_id'=>$user['id'],
            'started_on'=>date('Y-m-d H:i:s', $now),
            'ended_on'=>date('Y-m-d H:i:s', $end),
            'status'=>'new'        
        );
        return $this->dao->insertGoal($goal);
    }
    
    function getUserGoals() {
    	$flag = FALSE;
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        $goals = $this->dao->getUserGoals($user['id']);
        return $goals;
    }
    
    function getUserActiveGoals() {
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        return $this->dao->getUserActiveGoals($user['id']);
    }
    
    function getUserSuccessGoals() {
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        return $this->dao->getUserGoalsByStatus($user['id'], 'success');
    }
    
    function getUserFailedGoals() {
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        return $this->dao->getUserGoalsByStatus($user['id'], 'fail');
    }
    
    function getGoalActivities($goal_id) {
        return $this->dao->getGoalActivities($goal_id);
    }
    
    function getGoal($id) {
        return $this->dao->getGoal($id);
    }
    
    function activateGoal($id) {
        return $this->dao->updateGoalStatus($id, 'active');
    }
    
    function deleteGoal($id) {
    	return $this->dao->deleteGoal($id);
    }
    
    function endGoal($id) {
        return $this->dao->updateGoalStatus($id, 'fail');
    }
}
