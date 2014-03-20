<?php 
require_once dirname ( __FILE__ )."/../config.php";
?>
<meta charset="utf-8">
<link rel="stylesheet" href="/<?php echo APP_CONTEXT;?>/assets/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/<?php echo APP_CONTEXT;?>/assets/bootstrap/css/bootstrap-responsive.min.css"/>

<script type="text/javascript" src="/<?php echo APP_CONTEXT;?>/assets/js/jquery-1.9.1.min.js" ></script>
<script type='text/javascript' src='/<?php echo APP_CONTEXT;?>/assets/js/jquery-ui/jquery-ui-1.8.18.custom.min.js'></script>
<script type="text/javascript" src="/<?php echo APP_CONTEXT;?>/assets/bootstrap/js/bootstrap.min.js"></script>

<div class="container">
    <h3>目标列表</h3>
    <div class="row">
    <?php
    include_once 'goal-list.html';
    ?>
    </div>
    
    <h3>今日执行</h3>
    <div class="row">
    <?php
    include_once 'goal-today.html';
    ?>
    </div>
    
    <h3>目标Widget</h3>
    <div class="row">
    <?php
    include_once 'goal-widget.html';
    ?>
    </div>
    
    <h3>目标详细页</h3>
    <div class="row">
    <?php
    include_once 'goal-page.html';
    ?>
    </div>
</div>
