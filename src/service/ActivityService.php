<?php
require_once dirname(__FILE__).'/../dao/ActivityDao.php';

class ActivityService {
    private $dao;

    public function __construct() {
        $this->dao = new ActivityDao();
    }

    function getActivityOfDay($user_id, $goal_id, $day) {
        return $this->dao->getActivityOfDay($user_id, $goal_id, $day);
    }
    
    function saveActivity($activity) {
        return $this->dao->saveActivity($activity);
    }
}
