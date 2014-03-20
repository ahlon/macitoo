<?php
header("Content-Type: text/html;charset=utf-8");
include_once './includes/auth.php';
?>
<div class="container">
    <?php
    require_once 'widgets/w_goal.php';
    render_goal_menu(0);
    ?>
    <section>
    <div class="row">
    <?php 
    require_once './service/GoalService.php';
    $goalService = new GoalService();
    $goals = $goalService->getUserActiveGoals();
    if ($goals) {
        require_once './widgets/w_goal.php';
        foreach ($goals as $goal) {
            render_goals_today($goal);
        }
    } else {
        echo '<div class="span12">';
        echo '还没有目标吗，<a class="btn btn-primary" href="/macitoo/goal-new.php">点此</a>开始制定目标';
        echo '</div>';
    }
    ?>
    </div>
    </section>
</div>
<script type="text/javascript">
$(function() {
	// todo
});

function doSuccess(goal_id) {
	var url = '/macitoo/modules/goal/do-success.php';
	var params = {'id':goal_id};
	$.get(url, params, function(data) {
	    if (data != 'fail') {
	        location.reload();
		}
	});
}

function doFail(goal_id) {
	var url = '/macitoo/modules/goal/do-fail.php';
	var params = {'id':goal_id};
	$.get(url, params, function(data) {
	    if (data != 'fail') {
	        location.reload();
		}
	});
}
</script>
