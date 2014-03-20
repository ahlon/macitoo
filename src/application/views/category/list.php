<?php
$tabs = array(
    array('taxonomy'=>'category', 'name'=>'分类', 'url'=>'/admin/categories'),
    array('taxonomy'=>'menu', 'name'=>'菜单', 'url'=>'/admin/menus')
);
?>
<ul class="nav nav-tabs">
    <?php 
    foreach ($tabs as $tab) {
        echo '<li';
        if ($tab['taxonomy'] == $taxonomy) {
            echo ' class="active"';
        }
        echo '><a href="'.$tab['url'].'">'.$tab['name'].'</a></li>';
    }
    ?>
</ul>

<div class="nav pull-right">
    <div class="btn-group">
        <a class="btn" href="/admin/category/new">新建</a>
    </div>
</div>

<ul class="breadcrumb">
  <li><a href="/admin/categories">首页</a> <span class="divider">/</span></li>
  <?php 
  if (isset($parents)) {
      foreach ($parents as $parent) {
          $parent_url = '/admin/category/'.$parent['id'];
          echo '<li><a href="'.$parent_url.'">'.$parent['name'].'</a> <span class="divider">/</span></li>';
      }
  }
  ?>
  <?php 
  if (isset($category)) {
  ?>
  <li class="active"><?php echo $category['name']?></li>
  <?php 
  }
  ?>
</ul>

<table class="table table-striped table-bordered table-condensed" style="table-layout: fixed;">
    <thead>
        <tr>
             <th width="60">编号</th>
             <th>名称</th>
             <th>父节点</th>
             <th>Treepath</th>
             <th width="60">状态</th>
             <th width="100">创建人</th>
             <th width="90">创建时间</th>
             <th width="90">最近更新</th>
             <th width="65" nowrap>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($list as $item) {
            $url = '/admin/category/'.$item['id'];
        ?>
        <tr>
            <td><?php echo $item['id'];?></td>
            <td><a href="<?php echo $url;?>"><?php echo $item['name'];?></a></td>
            <td><?php echo $item['parent'];?></td>
            <td><?php echo $item['treepath'];?></td>
            <td><?php echo $item['status'];?></td>
            <td><?php echo $item['creator_id'];?></td>
            <td><?php echo $item['created_time'];?></td>
            <td><?php echo $item['last_updated_time'];?></td>
            <td></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
