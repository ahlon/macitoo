$(function(){
	var url = location.pathname + '.data';
	$.getJSON(url, function(data) {
		var start_timer = new Date(data.start_timestamp);
			id = data.id;
		show_timer(start_timer, id);
	});
});

function show_timer(start_time, id) {
	var note = $('#note'),
	
	ts = start_time.getTime() + 25*60*1000;
	//ts = start_time.getTime() + 10*1000;
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			var message = "";
	
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			note.html(message);
		},
		timeup    : function() {
			var url = '/timer/update/' + id;
			$.get(url, function(data) {
				location.href='/timers/'
			})
		}
	});
}