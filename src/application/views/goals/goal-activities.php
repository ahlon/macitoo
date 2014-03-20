<?php
$id = $_GET['id'];

require_once '../../service/GoalService.php';
$goalService = new GoalService();
$activities = $goalService->getGoalActivities($id);
echo json_encode($activities);
return;
?>