<div class="container">
	<div>
		<p class="lead text-center">我的任务 </p>
	</div>
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
            $item_url = '/task/'.$item['id'];
        ?>
        <tr>
            <td><a href="<?php echo $item_url;?>"><?php echo $item['name'];?></a></td>
            <td><?php echo @$item['start_time'];?></td>
            <td><?php echo $item['created_time'];?></td>
            <td><?php echo @$item['status'];?></td>
            <td>
            <?php 
            if ($item['status'] == 'new') {
                echo '<a type="button" class="btn btn-danger" href="/reading/task/delete/'.$item['id'].'">删除 </a>';
            } else if ($item['status'] == 'finished') {
                echo '<a type="button" class="btn btn-danger" href="/reading/task/restart/'.$item['id'].'">重新开始 </a>';
                //echo '<input type="button" class="btn btn-success" value="重新开始" onclick="start('.$item['id'].')"/>';
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
