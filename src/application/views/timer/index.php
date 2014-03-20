<div class="container">
    <!--  
    <form class="well form-search">
        <input type="text" name="email" value="" class="input-middle" placeholder="邮箱">
        <input type="text" name="display_name" value="" class="input-middle" placeholder="昵称">
        <button type="submit" class="btn">Search</button>
    </form>
    -->
    <div class="btn-toolbar">
        <div class="btn-group">
            <a class="btn" href="/timer/add">添加一个番茄钟</a>
        </div>
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
            $item_url = '/timer/'.$item['id'];
        ?>
        <tr>
        	<?php if($item['status'] == 'started') {?>
            <td><a href="<?php echo $item_url;?>"><?php echo $item['name'];?></a></td>
            <?php }else { ?>
            <td><?php echo $item['name'];}?> </td>
            <td><?php echo @$item['start_time'];?></td>
            <td><?php echo $item['created_time'];?></td>
            <td><?php echo @$item['status'];?></td>
            <td>
            <?php 
            if ($item['status'] == 'new') {
                echo '<input type="button" class="btn btn-success" value="Start" onclick="start('.$item['id'].')"/>';
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
<script type="text/javascript">
function start(id) {
	var url = '/timer/start/' + id;
	$.get(url, function(data) {
	    //location.reload();
	    location.href = 'timer/'+id
    });
}
</script>