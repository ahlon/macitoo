<?php
header("Content-Type: text/html;charset=utf-8");
// include_once dirname(__FILE__).'/../../../includes/auth.php';

require_once dirname(__FILE__).'/../../../service/UserService.php';
$userService = new UserService();
/*if (isset($_POST['calendar_url'])) {
    $profile = array('calendar_url'=>$_POST['calendar_url']);
    $flag = $userService->updateSettings($profile);
    echo "Success";
} else {
    $settings = $userService->getSettings();
}*/
@session_start();
$user = $_SESSION['user'];


if (isset($_POST['action'])){
	switch ($_POST['action']) {
		case 'basic':
			//echo "change username";
			if(isset($_POST['display_name']) && isset($_POST['email'])){
				//echo "change display_name";
				$accntInfo = array('display_name'=>$_POST['display_name'], 'email'=>$_POST['email']);
				$flag = $userService->updateAccntInfo($accntInfo);
				$user = $_SESSION['user'];
			}
			header("location:settings.php");
			break;
		case 'settings':
			if(isset($_POST['calendar_url'])){
				$profile = array('calendar_url'=>$_POST['calendar_url']);
	    		$flag = $userService->updateSettings($profile);
				$settings['calendar_url'] = $_POST['calendar_url'];
			}
			break;
		case 'change_pwd':
			if(isset($_POST['new_password'])) {
				if(md5($_POST['old_password']) != $user['password'] 
					|| strlen($_POST['new_password']) < 6 
					|| $_POST['new_password'] != $_POST['re_new_password']
				) {
					echo "Unable to change password !";
				} else {
				$accntInfo = array('password'=>$_POST['new_password']);
				$flag = $userService->updateAccntInfo($accntInfo);
				}
			}
			break;
		default:
			break;
	}
	
} else {
	$settings = $userService->getSettings();
}

?>

<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#basic" data-toggle="tab">基本信息</a></li>
                <li><a href="#settings" data-toggle="tab">帐户设置</a></li>
                <li><a href="#password" data-toggle="tab">修改密码</a></li>
            </ul>
          
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="basic">
                     <form id="basicinfo" class="form-horizontal" method="post">
                     <input type="hidden" name="action" value="basic"/>
                          <fieldset>
                              <div class="control-group">
                                <label class="control-label" for="focusedInput">邮箱</label>
                                <div class="controls">
                                  <input id="email" class="input-xlarge focused" name="email" type="text" value="<?php echo $user['email'];?>">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label" for="focusedInput">昵称</label>
                                <div class="controls">
                                  <input id="nickname" class="input-xlarge focused" name="display_name" type="text" value="<?php echo $user['display_name'];?>">
                                </div>
                              </div>
                              <div class="form-actions">
                                <button type="submit" class="btn btn-primary">保存</button>
                                <button type="reset" class="btn">取消</button>
                              </div>
                        </fieldset>
                    </form>
                </div>
                <div class="tab-pane fade" id="settings">
                  <form id="settings" class="form-horizontal" method="post">
                  <input type="hidden" name="action" value="settings"/>
                      <fieldset>
                          <legend>帐户设置</legend>
                          <div class="control-group">
                              <label class="control-label" for="focusedInput">Google Calendar Url</label>
                              <div class="controls">
                                  <input class="input-xlarge focused" name="calendar_url" type="text" value="<?php echo $settings['calendar_url'];?>">
                              </div>
                          </div>
                          <div class="form-actions">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn">取消</button>
                          </div>
                    </fieldset>
                  </form>
                </div>
                <div class="tab-pane fade" id="password">
                  <form id="pwdform" class="form-horizontal"   method="post">
                  <input type="hidden" name="action" value="change_pwd"/>
                      <fieldset>
                      	 <legend>修改密码</legend>
	                     <div class="control-group">
                              <label class="control-label" for="focusedInput">当前密码</label>
                              <div class="controls">
                                  <input id="old_password" class="input-xlarge focused" name="old_password" type="password">
                              </div>
	                       </div>
                          
                          <div class="control-group">
                              <label class="control-label" for="focusedInput">新密码</label>
                              <div class="controls">
                                  <input id="new_password" class="input-xlarge focused" name="new_password" type="password">
                              </div>
                          </div>
                          
                          <div class="control-group">    
                              <label class="control-label" for="focusedInput">确认密码</label>
                              <div class="controls">
                                  <input id="re_new_password" class="input-xlarge focused" name="re_new_password" type="password">
                              </div>
                          </div>

	                          <div class="form-actions">
	                            <button id="bchangepwd" type="submit" class="btn btn-primary"  >保存</button>
	                            <button type="reset" class="btn">取消</button>
	                          </div>
                    </fieldset>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
</script>
