<div class="container">
    <div class="row">
    <div class="span9">
        <?php 
        // $attributes = array('class' => 'well form-inline', 'id' => 'login_form');
	    ?>
	    <form  method="post" action="/login_auth">
            <input type="hidden" name="redirect_url" value='<?php echo @$_GET['redirect_url'];?>'>
            <input type="hidden" name="from_url" value='<?php echo @$_GET['from_url']; ?>'>
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <label class="checkbox">
              <input type="checkbox">Remember me
            </label>
            <button type="submit" class="btn btn-primary">登录</button>
	    </form>
        <?php 
        if (isset($validation_error) && $validation_error == true ) {
    		echo '<div class="alert alert-error">
  					<strong>用户名或密码错误不能为空!</strong>
				</div>';
        } else if ( isset($auth_error) && $auth_error == true) {
         	
    		echo '<div class="alert alert-error">
  					<strong>用户名或密码错误!</strong>
				</div>';
        }
        ?>
    </div>
  </div>
</div>
