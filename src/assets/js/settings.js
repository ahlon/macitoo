$(function() {
	$('.help-inline').each(function(){
		$(this).prev().addClass('error').parent().parent().addClass('error');
	});
	
	var error = function(el, msg){
		el.addClass('error');
		if (!el.next().is('.help-inline'))
			$('<span class="help-inline" />').text(msg).insertAfter(el);
		else
			el.next().text(msg);
		el.parent().parent().addClass('error');
		return false;
	}
	
	$("#pwdform").submit(function() {
		$('#pwdform .error').removeClass('error');
		$('#pwdform .help-inline').remove();
		var old_pwd = $('#old_password').val();
		var new_pwd = $('#new_password').val();
		var re_new_pwd = $('#re_new_password').val();
		
		if (!old_pwd) {
			return error($('#old_password'), '请输入原密码');
		}
		if (new_pwd && new_pwd.length < 6) {
			return error($('#new_password'), '密码长度必须大于6位');
		}
		/*if (!/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/.test(b))
			return error($('#email'), 'Email 格式错误');*/
		if (new_pwd && new_pwd != re_new_pwd) {
			return error($('#re_new_password'), '两次密码输入不一致');
		}
		return (old_pwd && new_pwd && re_new_pwd) ? true : false;
		
		return false;
	});
});

function sync_douban_reading() {
	var url = '/cmd/douban/sync_do';
	$.get(url, function(data) {
		console.log(data);
	});
}