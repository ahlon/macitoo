<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
<link rel="stylesheet" href="/assets/countdown/css/styles.css" />
<link rel="stylesheet" href="/assets/countdown/countdown/jquery.countdown.css" />
<style>
<!--

.table th, .table td { 
     border-top: none; 
 }
-->
</style>
<div class="container">
    <table id="widgets_table" class="table " border="0" >

        <tbody>
        <tr>
        	<th colspan="2"><p id="task_name"><?php echo @$timer['name'];?></p><br></th>
        </tr>
        <?php 
        $conut = 1;
        foreach (@$tasks as $task) {
        ?>
        <tr>
            <td><?php echo $conut++;?> </td>
            <td><?php echo @$task['name'];?> </td>
            <td>
            <?php 
            	if(@$task['status'] != 'finished') {
                	echo '<input type="button" class="btn " value="完成" onclick="end_task('.@$task['id'].')"/>';
            	} else {
                	echo '<input type="button" class="btn " value="已完成" disabled />';
            	}
            ?>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    
    	
    <div class="row">
    	

    	<div id="countdown"></div>

		<p id="note"></p><br>
		
		
    </div>
    <div class="row">
    <div id="finish">
		<!--<a href="/timer/update/<?php echo @$timer['id']?>" class="btn">该任务完成</a>-->
		<a href="/timer/pause/<?php echo @$timer['id']?>" class="btn">打断</a>
		<!--  <a href="/timer/load_next/<?php echo @$timer['id']?>" class="btn">载入下一个最高优先级任务</a>-->
    </div>
    </div>
</div>

<script type="text/javascript" src="/assets/countdown/countdown/jquery.countdown.js"></script>
<script type="text/javascript" src="/assets/countdown/js/script.js"></script>
<script type="text/javascript">
<!--
function end_task(task_id) {
	var url = '/timer/finish_task/' + task_id;
	$.get(url, function(data) {
	    location.reload();
	    //location.href = 'timer/'+id
    });
}

//-->
</script>
