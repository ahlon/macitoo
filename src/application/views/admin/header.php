<meta charset="utf-8">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include_once dirname(__FILE__).'/../default/include_static_res.php';

$module_name = isset($this->uri->segments[1]) ? $this->uri->segments[1] : '/';

$user_info = $this->data['mct_user'];
?>
<title>Macitoo: Invest in yourself</title>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="/">Macitoo</a> 
            <ul class="nav">
                <li><a href="/admin/users">用户</a></li>
                <li><a href="/admin/groups">群组</a></li>
                <li><a href="/admin/resources">资源</a></li>
                <li><a href="/admin/categories">分类</a></li>
                <li><a href="/admin/mottos">箴言</a></li>
            </ul>
            <ul class="nav pull-right">
                <?php 
                if (empty($user_info)) {
                ?>
                <li><a href="/login">登录</a></li>
                <li><a href="/signup">注册</a></li>                
                <?php
                } else {
                ?>
                <li><a href="/msgs">消息</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $user_info['avatar_url']?>"/> <?php echo @$user_info['display_name'];?><b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                        <li><a href="/settings"><i class="icon-cog"></i> 设置</a></li>
                        <li><a href="/logout"><i class="icon-off"></i> 退出</a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
                <li class="divider-vertical"></li>
            </ul>
        </div>
    </div>
</div>
<?php
if (!empty($sub_menus)) {
?>
<!--  
<div class="container navbar">
  <div class="navbar-inner">
    <ul class="nav">
    <?php
    foreach ($sub_menus as $menu) {
        echo '<li><a href="'.$menu['url'].'">'.$menu['title'].'</a></li>';
    }
    ?>
    </ul>
  </div>
</div>
-->
<div class="container">
    <ul class="nav nav-pills">
    <?php 
    foreach ($sub_menus as $menu) {
        echo '<li><a href="'.$menu['url'].'">'.$menu['title'].'</a></li>';
    }
    ?>
    </ul>
</div>
<?php 
}
?>