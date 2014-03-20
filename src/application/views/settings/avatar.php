<div class="container">
    <div class="row">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li><a href="/settings/basic">基本信息</a></li>
                <li><a href="/settings/password">修改密码</a></li>
                <li><a href="/settings/third-parties">第三方帐号</a></li>
                <li class="active"><a href="/settings/avatar">头像</a></li>
            </ul>
        </div>
            <div class="span3">
                <img src="/image/<?php echo $settings['avatar_img_id']?>"/>
            </div>
            <div class="span9">
                <form class="form-horizontal" method="post" action="/settings/upload_avatar" enctype="multipart/form-data">
                    <fieldset>
                        <legend>上传头像</legend>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">选择头像文件</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="userfile" type="file" value="<?php echo $settings['calendar_url'];?>">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">上传</button>
                            <button type="reset" class="btn">取消</button>
                        </div>
                    </fieldset>
                </form>
            </div>
    </div>
</div>
<script type="text/javascript" src="/assets/js/settings.js"></script>