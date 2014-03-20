<?php 
require_once 'service/UserService.php';

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'register') {
    $email = $_REQUEST['email'];
    $display_name = $_REQUEST['display_name'];
    $password = $_REQUEST['password'];
    $userService = new UserService();
    $flag = $userService->register($email, $display_name, $password);
    // header("location:register-success.php");
}
?>
<div class="container">
    <div class="row">
        <div class="span8">
          <form class="form-horizontal" method="post">
            <input type="hidden" name="action" value="register"/>
            <fieldset>
              <legend>用户注册</legend>
              <div class="control-group">
                <label class="control-label" for="focusedInput">邮箱</label>
                <div class="controls">
                  <input class="input-xlarge focused" name="email" type="text" value="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="focusedInput">昵称</label>
                <div class="controls">
                  <input class="input-xlarge focused" name="display_name" type="text" value="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="focusedInput">密码</label>
                <div class="controls">
                  <input class="input-xlarge focused" name="password" type="text" value="">
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">保存</button>
                <button type="reset" class="btn">取消</button>
              </div>
            </fieldset>
          </form>
        </div>
    </div>
</div>
