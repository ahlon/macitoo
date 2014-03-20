<?php 
require_once dirname ( __FILE__ ).'/../config.php';
require_once dirname ( __FILE__ ).'/../service/StaticsService.php';
$staticsService = new StaticsService();
$statics = $staticsService->getUserStatics();
?>

<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <!--  
            <a class="brand">Macitoo</a>
            -->
            <ul class="nav ">
                <li class="active"><a href="<?php echo APP_CONTEXT;?>"><i class="icon-home icon-white"></i> 首页</a></li>
                <li><a href="<?php echo APP_CONTEXT;?>goals.php">目标</a></li>
                <li><a href="<?php echo APP_CONTEXT;?>todo.php">执行
                <?php 
                if ($statics['goal'] > 0) {
                    echo '<span class="badge badge-important">'.$statics['goal'].'</span>';
                }
                ?>
                </a></li>
                <li><a href="<?php echo APP_CONTEXT;?>calendar.php">日程</a></li>
                <!--  
                <li><a href="<?php echo APP_CONTEXT;?>plans.php">计划</a></li>
                <li><a href="<?php echo APP_CONTEXT;?>notifications.php">通知</a></li>
                -->
            </ul>
            <ul class="nav pull-right">
                <?php 
                @session_start();
                if (isset($_SESSION['user'])) {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <?php echo $_SESSION['user']['display_name'];?><b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                        <li><a href="<?php echo APP_CONTEXT;?>modules/users/settings.php"><i class="icon-cog"></i> 设置</a></li>
                        <li><a href="<?php echo APP_CONTEXT;?>modules/users/logout.php"><i class="icon-off"></i> 退出</a></li>
                    </ul>
                </li>
                <?php
                } else {
                ?>
                <li><a href="<?php echo APP_CONTEXT?>modules/users/login.php">登录</a></li>
                <li><a href="<?php echo APP_CONTEXT?>modules/users/register.php">注册</a></li>
                <?php
                }
                ?>
                <li class="divider-vertical"></li>
            </ul>
        </div>
    </div>
</div>