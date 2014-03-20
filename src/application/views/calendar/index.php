<link rel="stylesheet" href='/assets/fullcalendar/fullcalendar.css'  />
<link rel="stylesheet" media="print" href="/assets/fullcalendar/fullcalendar.print.css"/>

<script src="/assets/fullcalendar/fullcalendar.min.js"></script>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Macitoo Calendar</a></li>
        <li><a href="#tab2" data-toggle="tab">Google Calendar</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <div id="mct_calendar"></div>
        </div>
        <div class="tab-pane" id="tab2">
            <iframe src="<?php echo $user_settings['calendar_url']?>" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
</div>
<script>
$(function() {
	var calendar = $('#mct_calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		}
	});
})
</script>