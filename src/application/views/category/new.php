<?php
?>
<form id="group-form" class="form-horizontal" action="/admin/category/save" method="post">
    <div class="modal-header">
    	<h3>新建分类（Category）</h3>
    </div>
    <div class="modal-body">
            <div class="control-group">
                <label class="control-label">父节点</label>
                <div class="controls">
                    <input type="text" name="parent" placeholder="parent id">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">名称</label>
                <div class="controls">
                    <input type="text" name="name" placeholder="Name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">名称</label>
                <div class="controls">
                    <select name="taxonomy">
                      <option value="category">category</option>
                      <option value="menu">menu</option>
                      <option value="tag">tag</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">描述</label>
                <div class="controls">
                    <textarea name="description" placeholder="Description"></textarea>
                </div>
            </div>
    </div>
    <div class="well">
        <button type="submit" class="btn btn-primary">保存</button>
        <a type="button" data-dismiss="modal" class="btn" href="/admin/categories">取消</a>
    </div>
</form>