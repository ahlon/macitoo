<form class="form-horizontal" action="/<?php echo $obj_type;?>/save" method="post">
    <fieldset>
        <legend>New <?php echo $obj_type;?></legend>
        <?php
        foreach ($columns as $col) {
            if ($col->Field == 'id') {
                continue;
            }
            ?>
        <div class="control-group">
            <label class="control-label"><?php echo $col->Field?></label>
            <div class="controls">
                <?php
            if (start_with($col->Type, 'int')) {
                echo '<input name="obj[' . $col->Field . ']" type="text" value="' . $object[$col->Field] . '"/>';
            } else if (start_with($col->Type, 'varchar')) {
                echo '<input name="obj[' . $col->Field . ']" type="text" value="' . $object[$col->Field] . '"/>';
            } else if (start_with($col->Type, 'datetime')) {
                echo '<div id="start-date" class="input-append date datepicker" data-date-format="yyyy-mm-dd">';
                echo '<input type="text" class="input-small" name="obj[' . $col->Field . ']" value="' . $object[$col->Field] . '"><span class="add-on"><i class="icon-th"></i></span>';
                echo '</div>';
            } else {
                echo '<input name="obj[' . $col->Field . ']" type="text"/>';
            }
            ?>
            </div>
        </div>
        <?php
        }
        ?>
    </fieldset>
    <div class="form-actions">
        <a type="submit" class="btn btn-primary">Save</a>
        <a type="button" class="btn" href="/<?php echo $obj_type;?>">Cancel</a>
    </div>
</form>
<link rel="stylesheet" href="/assets/bootstrap-datepicker1/css/datepicker.css" />
<script src="/assets/bootstrap-datepicker1/js/bootstrap-datepicker.js"></script>
<script>
$(function() {
    $('.datepicker').datepicker();
});
</script>
