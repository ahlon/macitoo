<?php
header("Content-Type: text/html;charset=utf-8");
?>
<link rel='stylesheet' type='text/css' href="/assets/fullcalendar/fullcalendar.css"/>
<link rel='stylesheet' type='text/css' href='/assets/fullcalendar/fullcalendar.print.css' media='print' /> 
<script type='text/javascript' src='/assets/fullcalendar/fullcalendar.min.js'></script>


<div class="container-fluid">
    <section>
        <div><h2 class="strong" style="text-align:center"><?php echo $goal['name'];?></h2></div>
        <div class="row-fluid">
            <div class="span4">
                <div class="well">
                    <div>
                        <table class="table table-striped">
                            <tr><th>类型</th><td>习惯养成</td></tr>
                            <tr><th>状态</th><td><?php echo $goal['status'];?></td></tr>
                            <tr><th>开始时间</th><td><?php echo substr($goal['started_on'], 0, 10);?></td></tr>
                            <tr><th>结束时间</th><td><?php echo substr($goal['ended_on'], 0, 10);?></td></tr>
                            <tr>
                                <th>进度</th> 
                                <td>
                                    <?php
                                    $day = date('Y-m-d');
                                    $started_on = strtotime(substr($goal['started_on'], 0, 10));
                                    $today = strtotime($day);
                                    $daycount = round(($today - $started_on) / 3600 / 24);
                                    $percent = $daycount * 100 / 21;
                                    ?>
                                    <div class="progress progress-success">
                                        <div class="bar" style="width: <?php echo $percent.'%';?>;" title="<?php echo $percent.'%';?>"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            
	        	<div id='calendar'></div>
            </div>
            
            <div class="span8">
                <div class="well">
                	<div><p>今日执行情况</p></div>
    				<button class="btn btn-success" type="button"  onclick="add_activity(<?php echo $goal['id']?>)" >完成</button>
    				<button class="btn btn-danger" type="button">未完成</button>
                </div>
                
                <div class="well">
    				<input id="record" class="input-block-level" type="text" placeholder="写下我的进展和想法">
    				<button class="btn btn-primary" type="button" onclick="add_record()">发布</button>
    				<button class="btn btn-primary" type="button">取消</button>
                </div>
            
            	<div class="well">
            		<div><p class="strong" style="text-align:center">我的梦想记录</p></div>
            		<?php foreach ($project_records as $record ) {
            			echo '<p>'.$record['record'].'</p>';
            		}
            		
            		?>
            	</div>
            
            
            </div>
        </div>

    </section>
</div>
<script type="text/javascript">
var events = new Array();
$(function() {
	var url = "/goals/get_goal_activities/<?php echo $goal['id']?>";
	
	
	$.getJSON(url, function(data) {
		//var events = new Array();
		for (var i = 0; i < data.length; i++) {
		    var event = {
		    	id: data[i].id,
		    	title: data[i].status,
		    	start: data[i].day,
		    	allDay:true,
	            color: "#0074cc",
	            //backgroundColor:'red'
		    };
		    if(data[i].status =='ok')
		    {
			   // event.backgroundColor = 'red';
		    }
		    events.push(event);
		}
		$('#calendar').fullCalendar({
	        monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	        dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
	        today: ["今天"],
	        buttonText: {
	        	today: "今天",
	        	prev: "上一月",
	        	next: "下一月",
	        	month: "月",
	        	agendaWeek: "周",
	        	agendaDay: "天"
	        },
	        /*dayClick: function() {
	            alert('a day has been clicked!');
	        },*/
	        events: events
	
	    });
		$('#calendar').fullCalendar("select", new Date("<?php echo $goal['started_on'];?>"), new Date("<?php echo $goal['ended_on'];?>"), false);
	});

});

function add_activity(goal_id) {
	var url = '/goals/add_activitiy/' + goal_id;
	$.get(url, function(data) {
	    location.reload();
    });
}

function add_record() {
	var data = {};
	data.record = $("#record").val();
	var url='/goals/add_record/';
	$.post(url, data, function() {
		location.reload();
	});
}
</script>
