<div class="subnav">
  <ul class="nav nav-pills">
    <li <?php if (@$active_idx == 0) {echo 'class="active"';}?>> <a href="<?php echo APP_CONTEXT;?>goals/all">所有目标<span class="badge"><?php echo isset($goal_statistics['all']) ? $goal_statistics['all'] : 0;?></span></a></li>
    <li <?php if (@$active_idx == 1) {echo 'class="active"';}?>> <a href="<?php echo APP_CONTEXT;?>goals/in_progress">进行中的目标<span class="badge badge-info"><?php echo isset($goal_statistics['active']) ? $goal_statistics['active'] : 0;?></span></a></li>
    <li <?php if (@$active_idx == 2) {echo 'class="active"';}?>><a href="<?php echo APP_CONTEXT;?>goals/succeeded">成功的目标<span class="badge badge-success"><?php echo isset($goal_statistics['success']) ? $goal_statistics['success']: 0;?></span></a></li>
    <li <?php if (@$active_idx == 3) {echo 'class="active"';}?>><a href="<?php echo APP_CONTEXT;?>goals/failed">失败的目标<span class="badge badge-important"><?php echo isset($goal_statistics['fail']) ? $goal_statistics['fail'] : 0;?></span></a></li>
    <li <?php if (@$active_idx == 4) {echo 'class="active"';}?>><a href="<?php echo APP_CONTEXT;?>goals/add">开始制定新目标</a></li>
  </ul>
</div>