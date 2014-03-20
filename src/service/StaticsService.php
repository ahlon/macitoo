<?php
require_once dirname(__FILE__).'/../dao/GoalDao.php';
require_once dirname(__FILE__).'/UserService.php';

class StaticsService {
    function getUserStatics() {
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        $goalDao = new GoalDao();
        $goal_count = $goalDao->getUserActiveGoalsCount($user['id']);
        return array('goal'=>$goal_count);
    }
    
    function getUserGoalStatics() {
        $userService = new UserService();
        $user = $userService->getCurrentUser();
        $goalDao = new GoalDao();
        return $goalDao->getUserGoalStatics($user['id']);
    }
}
