

    
    <section>
    <div class="row">
    <?php 

    $goal_type_desc = array(1=>"TODO", 2=>"习惯养成", 3=>"系统项目", 4=>"购物列表");
    ?>
		<div class="span12">
		    <table class="table table-striped table-bordered table-condensed">
		        <tr>
		            <th>目标</th>
		            <th>类型</th>
		            <th>状态</th>
		            <th>开始日期</th>
		            <th>结束日期</th>
		            <th>进度</th>
		            <th>操作</th>
		        </tr>
		        <?php
		        if (isset($goals_all) && (! empty($goals_all)) ) {
		        	foreach ($goals_all as $goal) {
		        ?>
		        <tr>
		            <td><a href="<?php echo APP_CONTEXT;?>goal/<?php echo $goal['id'];?>"><?php echo $goal['name']?></a></td>
		            <td><?php if($goal['goal_type_id']) {
		            			echo $goal_type_desc[$goal['goal_type_id']]; 
		            		  } else {
		            		  	echo "未知类型";
		            		  }
		            			
		            			?></td>
		            <td><?php echo $goal['status'];?></td>
		            <td><?php echo $goal['started_on'];?></td>
		            <td><?php echo $goal['ended_on'];?></td>
		            <td></td>
		            <td>
		            <?php
		            echo ' <a class="btn btn-primary" href="'.APP_CONTEXT.'goals/edit/'.$goal['id'].'">编辑</a>';
		            if ($goal['status'] == 'new') {
		                echo ' <a class="btn btn-success" href="'.APP_CONTEXT.'goals/activate/'.$goal['id'].'">开始</a>';
		                //echo ' <a class="btn btn-danger" data-toggle="modal"  href=#'.$goal['id'].'>删除</a>';
		            }
		            if ($goal['status'] == 'active') {
		                echo ' <a class="btn btn-danger" href="'.APP_CONTEXT.'goals/end/'.$goal['id'].'">终止</a>';
		            }
		            ?>
		            </td>
		        </tr>
		        <?php
		        	}
		        }
		        ?>
		    </table>
		</div>    
    </div>
    </section>
</div>
 
