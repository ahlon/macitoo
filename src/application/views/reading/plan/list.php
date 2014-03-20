<?php
// require_once dirname(__FILE__).'/../../../core/common.php';
?>

<div>
	<p class="lead text-center">我的计划</p>
</div>

<div class="container">
    <?php 
    if (isset($status)) {
    ?>
    <ul class="nav nav-tabs">
        <li <?php echo $status == 'in-progress' ? 'class="active"' : ''?>><a href="/reading/plans/in-progress">执行中</a></li>
        <li <?php echo $status == 'not-started' ? 'class="active"' : ''?>><a href="/reading/plans/not-started">未开始</a></li>
        <li <?php echo $status == 'finished' ? 'class="active"' : ''?>><a href="/reading/plans/finished">已结束</a></li>
    </ul>
    <?php 
    }
    ?>
    <!--  
    <div class="btn-toolbar">
        <div class="btn-group">
            <a class="btn" href="#">喜欢</a>
            <a class="btn" href="#">想要</a>
            <a class="btn" href="#">收藏</a>
            <a class="btn" href="#">分享</a>
        </div>
    </div>
    -->
    <table id="widgets_table" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>名称</th>
                <th>开始时间</th>
                <th>创建时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list as $item) {
            $item_url = '/plan/'.$item['id'];
        ?>
        <tr>
            <td><a href="<?php echo $item_url;?>"><?php echo @$item['title'];?></a></td>
            <td><?php echo @$item['start_time'];?></td>
            <td><?php echo $item['created_time'];?></td>
            <td><?php echo @$item['status'];?></td>
            <td>
            <?php 
            if ($item['status'] != 'finished') {
            	echo '<a class="btn btn-success" href="/reading/plan/break_down/'.$item['id'].'"> 分解成任务</a>';
            }
            ?>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>