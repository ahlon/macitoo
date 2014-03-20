<!DOCTYPE HTML>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include_once dirname(__FILE__).'/include_static_res.php';
?>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<title>Macitoo: Invest in yourself</title>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <li class="active"><a href="/"><i class="icon-home icon-white"></i>首页</a></li>
                <li><a href="/books">书架</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">我读 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/reading/status/in-progress">在读</a></li>
                        <li><a href="/reading/status/wish">想读</a></li>
                        <li><a href="/reading/status/collect">已读</a></li>
                    </ul>
                </li>
                <li><a href="/reading/plans">计划</a></li>
                <!--  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">计划 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/reading/plans/in-progress">进行中</a></li>
                        <li><a href="/reading/plans/not-started">未开始</a></li>
                        <li><a href="/reading/plans/finished">已结束</a></li>
                    </ul>
                </li>
                -->
                <li><a href="/reading/tasks">任务</a></li>
                <li><a href="/timers">记录</a></li>
                <li><a href="/reading/history">回顾</a></li>
            </ul>
            <ul class="nav pull-right">
                <?php 
                //@session_start();
                if (!isset($user_info) || $user_info === FALSE ) {
                ?>
                <li><a href="/login">登录</a></li>
                <li><a href="/register">注册</a></li>
                <?php
                } else {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="icon-user icon-white"></i> <?php echo $user_info['display_name'];?><b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                        <li><a href="/settings/basic"><i class="icon-cog"></i> 设置</a></li>
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
