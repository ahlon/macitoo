<link rel="stylesheet" href="/assets/bootstrap-datepicker1/css/datepicker.css"/>

<link rel="stylesheet" href='/assets/fullcalendar/fullcalendar.css'  />
<link rel="stylesheet" media="print" href="/assets/fullcalendar/fullcalendar.print.css"/>

<script src="/assets/js/jquery.serialize-object.js"></script>
<script src="/assets/fullcalendar/fullcalendar.min.js"></script>
<script src="/assets/bootstrap-datepicker1/js/bootstrap-datepicker.js"></script>
<style>
.form-horizontal .control-label {
    width: 60px;
}
.form-horizontal .controls {
    margin-left: 80px;
}
</style>
<div class="container">
    <div class="row">
        <nav class="span12">
            <ul class="breadcrumb">
                <li><a href="/">首页</a> <span class="divider">/</span></li>
                <li><a href="/reading/plans">读书计划</a> <span class="divider">/</span></li>
                <li class="active"><?php echo $item['title'];?></li>
            </ul>
        </nav>
    </div>
    <div class="row">
                <div class="span4">
                    <form id="plan-form" class="form-horizontal" method="post" action="/plan/save">
                        <input type="hidden" name="book_id" value="<?php echo $item['id'];?>"/>
                        <div class="control-group">
                            <label class="control-label" for="target">目标</label>
                            <div class="controls">
                                <input type="text" id="target" name="title" value="阅读《<?php echo $item['title'];?>》" readonly/>
                                <div class="cover">
                                    <a href="/book/<?php echo $item['id'];?>" target="_blank"><img src="<?php echo $item['image'];?>" class="img-polaroid"/></a>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">范围</label>
                            <div class="controls">
                                <label class="checkbox external-event">
                                    <input type="checkbox" name="read_book">所有章节的阅读
                                </label>
                                <label class="checkbox external-event">
                                    <input type="checkbox" name="take_notes">完成读书笔记
                                </label>
                                <label class="checkbox external-event">
                                    <input type="checkbox" name="write_review">完成一篇书评
                                </label>
                                <!--  
                                <label class="checkbox external-event">
                                    <input type="checkbox" value="">完成一篇书评
                                </label>
                                <label class="checkbox external-event">
                                    <input type="checkbox" value="">为他人制作5道以上题目
                                </label>
                                -->
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">时间</label>
                            <div class="controls">
                                <div id="start-date" class="input-append date datepicker" data-date="2012-03-26" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="input-small" name="start_time" value="2012-03-26"><span class="add-on"><i class="icon-th"></i></span>
                                </div>
                                 ~
                                <div id="end-date" class="input-append date datepicker" data-date="2012-04-08" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="input-small" name="end_time" value="2012-04-08"><span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">确认计划</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="span8">
                    <div id="calendar"></div>
                </div>
            </div>
</div>
<script>
var calendar;
$(function() {
	// $('.datepicker').datepicker();
	var startDate = new Date(2012,1,20);
	var endDate = new Date(2012,1,25);
	$('#start-date').datepicker()
	    .on('changeDate', function(ev){
	        if (ev.date.valueOf() > endDate.valueOf()){
	            $('#alert').show().find('strong').text('The start date must be before the end date.');
	        } else {
	            $('#alert').hide();
	            startDate = new Date(ev.date);
	            $('#date-start-display').text($('#date-start').data('date'));
	        }
	        $('#start-date').datepicker('hide');
	    });
	$('#end-date').datepicker()
	    .on('changeDate', function(ev){
	        if (ev.date.valueOf() < startDate.valueOf()){
	            $('#alert').show().find('strong').text('The end date must be after the start date.');
	        } else {
	            $('#alert').hide();
	            endDate = new Date(ev.date);
	            $('#date-end-display').text($('#date-end').data('date'));
	        }
	        $('#end-date').datepicker('hide');
	    });
    
    calendar = $('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, allDay) { // this function is called when something is dropped
		
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		}
    });

    $('.external-event').each(function() {
		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};
		
		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);
		
		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});

    $('#plan-form').submit(submitPlan);
    
});

function submitPlan() {
	var params = $(this).serializeObject();
	var _tasks = calendar.fullCalendar('clientEvents');
	var tasks = new Array();
	for (var i = 0; i < _tasks.length; i++) {
	    var _t = _tasks[i];
	    var t = {
	    	title:_t.title,
	    	start:_t.start.getTime(),
	    	end:_t.end.getTime()
	    };
	    tasks.push(t);
    }
	params.tasks = tasks;
	$.post($(this).attr('action'), params, function() {
	    location.href = '/reading/plans';
    });
	return false;
}
</script>
