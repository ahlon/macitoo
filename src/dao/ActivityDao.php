<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/BaseDao.php';

class ActivityDao extends BaseDao {
    function getActivityOfDay($user_id, $goal_id, $day) {
        $sql = "select * from activities where user_id=:user_id and goal_id=:goal_id and day=:day";
        $exe = $this->db->prepare($sql);
        $flag = $exe->execute(array('user_id'=>$user_id, 'goal_id'=>$goal_id, 'day'=>$day));
        if ($flag) {
            return $exe->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($exe->errorInfo());
            return false;
        }
    }
    
    function saveActivity($activity) {
        $sql = "insert into activities(user_id, goal_id, day, status) values(:user_id, :goal_id, :day, :status)";
        $exe = $this->db->prepare($sql);
        $flag = $exe->execute($activity);
        if ($flag) {
            $activity['id'] = $this->db->lastInsertId();
            return $activity;
        } else {
            print_r($exe->errorInfo());
            return false;
        }
    }
}
?>