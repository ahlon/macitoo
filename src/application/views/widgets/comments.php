<div>
<?php
// $this->load->model('comment_model');
// $params = array('cm.obj_type'=>$_obj_type, 'cm.obj_id'=>$_obj_id);
// $comments = $this->comment_model->find_all($params);
if (!empty($comments)) {
    foreach ($comments as $cm) {
    ?>
    <div class="segment">
        <div class="text"><?php echo $cm['content'];?></div>
        <div class="signiture"><span class="user"><?php echo $cm['display_name'];?></span>
        <span class="time" style="margin-left:20px;"><?php echo $cm['created_time'];?></span></div>
    </div>
    <?php
    }
}
?>
</div>
<div>
    <form id="post-form" class="form-horizontal" action="/comment/save" method="post">
        <input type="hidden" name="obj_type" value="<?php echo $_obj_type;?>"/>
        <input type="hidden" name="obj_id" value="<?php echo $item['id'];?>"/>
        <fieldset>
            <div class="control-group">
                <textarea id="post-input" class="input-xlarge" name="content" rows="4" style="width:98%;"></textarea>
            </div>
            <input type="submit" class="btn" value="发布"/>
        </fieldset>
    </form>
</div>