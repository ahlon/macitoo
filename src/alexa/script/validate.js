$(function () {
	$('#start').submit(function () {
		var formData = $('#start').serialize();
		var action = $('#start').attr('action');
		var returnData = function (data) {
			var encoded = data.split("#");
			var sig = encoded[0];
			var msg = encoded[1];
			if(sig == 200) {
				$('#loader').fadeOut('fast');
				$('#success').fadeIn('slow', function() {
					$('#success').html(msg);
				});
			} else if(sig == 404) {
				$('#loader').fadeOut('fast');
				$('#error').fadeIn('slow', function() {
					$('#error').html(msg);
				});
			}
		};
		$('#loader').show();
		$('#error').html('');
		$('#error').hide();
		$('#success').html('');
		$('#success').hide();
		$.ajax({
			type : 'POST',
			url : action,
			data : formData,
			success : returnData
		});
		
		return false;
	});
});