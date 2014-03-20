<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="/settings/basic">基本信息</a></li>
                <li><a href="/settings/password">修改密码</a></li>
                <li><a href="/settings/third-parties">第三方帐号</a></li>
                <li><a href="/settings/avatar">头像</a></li>
            </ul>
            <form id="basicinfo" class="form-horizontal" method="post" action="/settings/update_basic">
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
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">城市</label>
                        <div class="controls">
                            <input id="city" class="input-xlarge focused" name="city" type="text" value="<?php echo $user['city'];?>">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="reset" class="btn">取消</button>
                        <button type="button" class="btn" onclick="test();">Test</button>
                        <div class='notifications Center'></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/assets/js/settings.js"></script>
<script type="text/javascript">
function test() {
	$('.Center').notify({
	    message: { text: 'Aw yeah, It works!' }
	}).show(); 
}
</script>