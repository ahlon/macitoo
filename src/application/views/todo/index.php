<?php
// header("Content-Type: text/html;charset=utf-8");
//include_once './includes/auth.php';
// include_once './includes/res.php';
// include_once './includes/header.php';
?>
<div class="container">

    <section>
    <div class="row">

    </div>
    </section>
</div>
<script type="text/javascript">
$(function() {
	
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
