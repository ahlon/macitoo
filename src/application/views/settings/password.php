<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li><a href="/settings/basic">基本信息</a></li>
                <li class="active"><a href="/settings/password">修改密码</a></li>
                <li><a href="/settings/third-parties">第三方帐号</a></li>
                <li><a href="/settings/avatar">头像</a></li>
            </ul>
            <form id="pwdform" class="form-horizontal" method="post" action="/settings/update_password">
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
                        <button id="bchangepwd" type="submit" class="btn btn-primary">保存</button>
                        <button type="reset" class="btn">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/js/settings.js"></script>