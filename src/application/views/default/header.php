<meta charset="utf-8">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include_once dirname(__FILE__).'/include_static_res.php';

$module_name = isset($this->uri->segments[1]) ? $this->uri->segments[1] : '/';

$dom = new DOMDocument();
$dom->load(dirname(__FILE__).'/../../models/nav_menu.xml');
$nav_menus = simplexml_import_dom($dom);

$user_info = @$this->data['mct_user'];

$sub_menus = array();
?>
<title>Macitoo: Invest in yourself</title>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="/">Macitoo</a> 
            <ul class="nav">
                <?php
                foreach ($nav_menus as $menu) {
                    $active = $module_name == $menu['name'];
                    if ($active) {
                        $sub_menus = $menu->children();
                    }
                    $active_li_class = $active ? 'class="active"' : '';
                    
                    echo '<li '.$active_li_class.'><a href="'.$menu['url'].'">';
                    if (!empty($menu['icon-class'])) {
                        $active_icon_class = $active ? 'icon-white' : '';
                        echo '<i class="'.$menu['icon-class'].' '.$active_icon_class.'"></i> ';
                    }
                    echo $menu['title'].'</a></li>';
                }
                
//                 foreach ($header_menus as $menu) {
//                     $active = $module_name == $menu['name'];
//                     if ($active) {
//                         $sub_menus = $menu->children();
//                     }
//                     $active_li_class = $active ? 'class="active"' : '';
                
//                     echo '<li '.$active_li_class.'><a href="'.@$menu['url'].'">';
//                     if (!empty($menu['icon-class'])) {
//                         $active_icon_class = $active ? 'icon-white' : '';
//                         echo '<i class="'.$menu['icon-class'].' '.$active_icon_class.'"></i> ';
//                     }
//                     echo $menu['name'].'</a></li>';
//                 }
                ?>
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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $user_info['avatar_url']?>"/> <?php echo @$user_info['display_name'];?><b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                        <li><a href="/settings"><i class="icon-cog"></i> 设置</a></li>
                        <li><a href="/logout"><i class="icon-off"></i> 退出</a></li>
                    </ul>
                </li>
                <li><a href="/msgs">消息</a></li>
                <li><a href="/admin">Admin</a></li>
                <li><a href="/settings">设置</a></li>
                <?php
                }
                ?>
                <li class="divider-vertical"></li>
            </ul>
        </div>
    </div>
</div>
<?php
$sub_menus = array();
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