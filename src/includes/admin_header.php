<?php 
require_once dirname ( __FILE__ )."/../config.php";
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <!--  
            <a class="brand">Reading Planner</a>
            -->
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="<?php echo APP_CONTEXT;?>"><i class="icon-home icon-white"></i> 首页</a></li>
                    <li><a href="<?php echo APP_CONTEXT;?>goals.php">目标</a></li>
                    <!--  
                    <li class="dropdown">
                        <a href="/goals.php" class="dropdown-toggle" data-toggle="dropdown">目标<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/book-new.php">新建一个目标</a></li>
                        </ul>
                    </li>
                    -->
                    <li><a href="<?php echo APP_CONTEXT;?>trace.php">签到</a></li>
                </ul>
                <ul class="nav pull-right">
                    <?php 
                    session_start();
                    if (isset($_SESSION['user'])) {
                        echo '<li><a href="#">'.$_SESSION['user']['display_name'].'</a></li>';
                    } else {
                        echo '<li><a href="'.APP_CONTEXT.'login.php">登录</a></li>';
                        echo '<li><a href="'.APP_CONTEXT.'register.php">注册</a></li>';
                    }
                    ?>
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> 帐户<b class="caret"></b></a>
                        <ul class="dropdown-menu"> 
                            <li><a href="<?php echo APP_CONTEXT;?>settings.php"><i class="icon-cog"></i> 设置</a></li>
                            <li><a href="<?php echo APP_CONTEXT;?>logout.php"><i class="icon-off"></i> 退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>