<div class="container">
    <div class="row">
        <div class="span12">
            <form id="break_down_plan" class="form-horizontal" method="post" action="/reading/task/new">
                <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
                <fieldset>
                <div>
                <p class="lead text-center">分解计划：<?php echo $plan['title']?> </p>
                </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">添加任务</label>
                         <div class="controls">
                            <input id="name" class="input-xlarge" name="name" type="text" value="" >
                        </div> 
                        
                    </div>
                </fieldset>
			    <div class="form-actions">
                    <button  class="btn btn-primary">保存</button>
                    <a class="btn " href="/reading/plans">取消</a>
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
			        foreach ($tasks as $task) {
			            $task_url = '/task/'.$task['id']; 
			        ?>
			        <tr>
			        	<?php if($task['status'] != 'finished') {?>
			            <td><a href="<?php echo $task_url;?>"><?php echo $task['name'];?></a></td>
			            <?php }else { ?>
			            <td><?php echo $task['name'];}?> </td>
			            <td><?php echo $task['start_time'];?></td>
			            <td><?php echo $task['created_time'];?></td>
			            <td><?php echo $task['status'];?></td>
			            <td>操作</td>
			        </tr>
			        <?php
			        }
			        ?>
			        </tbody>
			    </table>      
			    
            </form>
        </div>
    </div>
</div>

