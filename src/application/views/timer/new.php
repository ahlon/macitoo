<div class="container">
    <div class="row">
        <div class="span12">
            <!-- <form id="basicinfo" class="form-horizontal" method="post" action="/timer/add_timer"> -->
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">番茄钟名称</label>
                        <div class="controls">
                            <input id="name" class="input-xlarge focused" name="name" type="text" value="<?php echo @$item['name'];?>">
                        </div>
                    </div>
                </fieldset>

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
			        	<?php if($item['status'] != 'finished') {?>
			            <td><a href="<?php echo $item_url;?>"><?php echo $item['name'];?></a></td>
			            <?php }else { ?>
			            <td><?php echo $item['name'];}?> </td>
			            <td><?php echo @$item['start_time'];?></td>
			            <td><?php echo $item['created_time'];?></td>
			            <td><?php echo @$item['status'];?></td>
			            <td>
			            <?php 
			            if ($item['status'] != TASK_ST_DONE) {
			                echo '<button type="button" class="btn  " data-toggle="button"  onclick="task_toggle('.$item['id'].')"> 加入到该番茄钟 </button>';
			            } else {
			                echo '<button type="button" class="btn  " data-toggle="button"  onclick="restart_task('.$item['id'].')"> 重新开始 </button>';
			            }
			            ?>
			            </td>
			        </tr>
			        <?php
			        }
			        ?>
			        </tbody>
			    </table>      
			    
			    <div class="form-actions">
                	<?php if ($add_timer) {?>
                    <button  class="btn btn-primary" onclick="add_timer()">保存</button>
                    <?php } else {?>
                    <p> 你有番茄钟正在进行中</p>
                    <?php }?>
                    <button type="reset" class="btn">取消</button>
                </div> 
            <!-- </form>  -->
        </div>
    </div>
</div>

<script type="text/javascript">
var toggle = {};
<?php 
 foreach ($list as $item) {
	if($item['status'] != 'finished') {
		echo 'toggle["'.$item['id'].'"] = 0 ;';
	}
 }
?>

function task_toggle(id) {
	toggle[id] = (toggle[id] + 1) % 2;
	//alert(toggle[id]);
}

function add_timer() {
	var url = '/timer/add_timer/';
	var data = {};
	data.timer_name = $('#name').val();
	data.tasks = toggle;
	$.post(url, data, function() {
		location.href = '/timers';
	});
}

function restart_task(task_id) {
	var url = '/reading/task/restart/' + task_id;
	$.get(url, function(data) {
	    location.reload();
    });
	
}
</script>