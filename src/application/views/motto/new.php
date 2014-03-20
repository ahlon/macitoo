<?php
?>
<form id="group-form" class="form-horizontal" action="/admin/motto/save" method="post">
    <div class="modal-header">
    	<h3>新建箴言（Motto）</h3>
    </div>
    <div class="modal-body">
            <div class="control-group">
                <label class="control-label">内容</label>
                <div class="controls">
                    <textarea name="content" rows="5" class="input-block-level" placeholder="Description"></textarea>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn">取消</button>
        <button type="submit" class="btn btn-primary">保存</button>
    </div>
</form>