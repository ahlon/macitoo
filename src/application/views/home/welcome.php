<style>
.hero-unit {
    background: #f5f5f5 url('<?php echo APP_CONTEXT;?>assets/img/poster1.jpg') no-repeat right;
}
        
.macitoo-info {
    color:rgb(213, 139, 98);
}
</style>

<div class="container">
    <?php 
    if (!empty($motto)) {
    ?>
    <div class="row">
        <div class="span12">
            <div class="alert alert-success"><?php echo $motto['content'];?></div>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="row">
        <div class="span12">
            <div class="hero-unit">
                <div class="container-fluid">
                    <div class="row-fluid macitoo-info">
                        <div class="span9"></div>
                        <div class="span3">
                         <h1>Macitoo</h1>
                            <p>Macitoo是一套根据最新的心理学原理实现的工具集，致力于帮助自己达到马斯洛提出的人的需求的最高层次——自我实现。</p>
                            <p>
                                <a class="btn btn-primary btn-large" href="/help/howitworks.php">了解更多 &raquo</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span4">
            <h2>习惯养成</h2>
            <p>Macitoo根据最新的心理学的研究来帮助我们养成自己想要培养的好习惯，打破坏习惯。</p>
            <p>
                <a class="btn" href="/help/howitworks.php">查看详情 &raquo;</a>
            </p>
        </div>
        <div class="span4">
            <h2>每日计划</h2>
            <p>Macitoo根据GTD的理论帮助我们做好每天的ToDo-list， 运用番茄工作法帮助我们提高工作效率。</p>
            <p>
                <a class="btn" href="/help/howitworks.php">查看详情 &raquo;</a>
            </p>
        </div>
        <div class="span4">
            <h2>目标跟踪</h2>
            <p>Macitoo能够跟踪我们的中长期目标，让我们了解自己对目标的执行情况，以便更好的做计划，同时也让我们更关注自己的人生梦想。</p>
            <p>
                <a class="btn" href="/help/howitworks.php">查看详情 &raquo;</a>
            </p>
        </div>
    </div>
</div>