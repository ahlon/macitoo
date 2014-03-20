<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li><a href="/settings/basic">基本信息</a></li>
                <li><a href="/settings/password">修改密码</a></li>
                <li class="active"><a href="/settings/third-parties">第三方帐号</a></li>
                <li><a href="/settings/avatar">头像</a></li>
            </ul>
            <div class="tab-pane" id="settings">
                <form id="settings" class="form-horizontal" method="post" action="/settings/update_third_parties">
                    <fieldset>
                        <legend>帐户设置</legend>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Google Calendar Url</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="calendar_url" type="text" value="<?php echo $settings['calendar_url'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">豆瓣id</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="douban_id" type="text" value="<?php echo $settings['douban_id'];?>">
                                <?php 
                                if ($settings['douban_id']) {
                                ?>
                                <button class="btn" onclick="sync_douban_reading();return false;">同步</button>
                                <?php 
                                }
                                ?>
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
</div>
<script type="text/javascript" src="/assets/js/settings.js"></script>