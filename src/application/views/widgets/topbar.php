<div class="navbar navbar-inverse"> <!-- navbar-fixed-top -->
    <div class="navbar-inner">
        <div class="container">
            <!--
            <a class="brand">Macitoo</a>
            -->
            <ul class="nav">
                <li class="active"><a href="/"><i class="icon-home icon-white"></i> 首页</a></li>
                <li><a href="/goals">目标
                <?php 
                if (isset($goal_count) && $goal_count > 0) {
                    echo '<span class="badge badge-info">'.$goal_count.'</span>';
                }
                ?>
                </a></li>
                <!--
                <li><a href="/todo">执行</a></li>
                <li><a href="/calendar">日程</a></li>
                -->
                <li><a href="/segments">记录</a></li>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <?php echo $user_info['display_name'];?><b class="caret"></b></a>
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