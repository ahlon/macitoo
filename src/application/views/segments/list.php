<?php
// require_once dirname(__FILE__).'/../../../core/common.php';
?>
<div class="container">
<?php 
include 'post-form.php';
?>
<div class="row">
    <div class="span12">
    <?php
    foreach ($datalist as $item) {
    ?>
    <div class="segment">
        <div class="text"><?php echo $item['text'];?></div>
        <div class="time"><?php echo $item['created_time'];?></div>
    </div>
    <?php 
    }
    ?>
    </div>
</div>
</div>