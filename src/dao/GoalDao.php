<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/BaseDao.php';
/**
 * Goal的状态定义
 * @author Ahlon
 */
class GoalDao extends BaseDao {
    
//     public function __construct() {
        
//     }
    function insertGoal($goal) {
        $sql = "insert into goals(name, goal_type_id, user_id, started_on, ended_on, status) 
            values(:name, :goal_type_id, :user_id, :started_on, :ended_on, :status)";
        $exe = $this->db->prepare($sql);
        $flag = $exe->execute($goal);
        if ($flag) {
            $goal['id'] = $this->db->lastInsertId();
            return $goal;
        } else {
            print_r($exe->errorInfo());
            return false;
        }
    }
    
    function getUserGoals($user_id) {
    	//name, started_on, ended_on,  status, created_time, last_updated_time, type_str from goals left join goal_types on goals.goal_type = goal_types.type_id;
        $sql = "select goals.id, name, started_on, ended_on,  status, created_time, last_updated_time, goals.goal_type_id
         from goals where user_id=:user_id order by created_time desc";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('user_id'=>$user_id));
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getGoalType($goal_type) {
    	$sql = "select type_str from goal_types where type_id=:type_id";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('type_id'=>$goal_type));
        $result = $exe->fetchAll(PDO::FETCH_ASSOC);
        echo "result is ".$result;
        return $result['type_str'];
    }
    
    function getUserGoalsByStatus($user_id, $status) {
        $sql = "select * from goals where user_id=:user_id and status=:status order by created_time desc";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('user_id'=>$user_id, 'status'=>$status));
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserActiveGoals($user_id) {
        $sql = "select * from goals where user_id=:user_id and status='active' order by created_time desc";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('user_id'=>$user_id));
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getGoal($id) {
        $sql = "select * from goals where id=:id";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('id'=>$id));
        return $exe->fetch(PDO::FETCH_ASSOC);
    }
    
    function getUserActiveGoalsCount($user_id) {
        $sql = "select count(*) num from goals where user_id=:user_id and status='active'";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('user_id'=>$user_id));
        $result = $exe->fetch(PDO::FETCH_ASSOC);
        return $result['num'];
    }

    function getUserGoalStatics($user_id) {
        $sql = "select status, count(*) count from goals where user_id=:user_id group by status;";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('user_id'=>$user_id));
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function updateGoalStatus($id, $status) {
        $sql = "update goals set status=:status where id=:id";
        $exe = $this->db->prepare($sql);
        $flag = $exe->execute(array('id'=>$id, 'status'=>$status));
        if (!$flag) {
            print_r($exe->errorInfo());
        }
        return $flag;
    }
    
    function deleteGoal($id)  {
    	$sql = "delete from goals where id=:id";
    	$exe = $this->db->prepare($sql);
        $flag = $exe->execute(array('id'=>$id));
        if (!$flag) {
            print_r($exe->errorInfo());
        }
        return $flag;
    }
    
    function getGoalActivities($goal_id) {
        $sql = "select * from activities where goal_id=:goal_id";
        $exe = $this->db->prepare($sql);
        $flag = $exe->execute(array('goal_id'=>$goal_id));
        if ($flag) {
        	return $exe->fetchAll(PDO::FETCH_ASSOC);
        } else {
        	print_r($exe->errorInfo());
        	return array();
        }
    }
}
?>