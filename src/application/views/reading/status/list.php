<div class="container">
    <ul class="nav nav-tabs">
        <li <?php echo @$status == 'do' ? 'class="active"' : ''?>><a href="/reading/status/in-progress">在读</a></li>
        <li <?php echo @$status == 'wish' ? 'class="active"' : ''?>><a href="/reading/status/wish">想读</a></li>
        <li <?php echo @$status == 'collect' ? 'class="active"' : ''?>><a href="/reading/status/collect">已读</a></li>
    </ul>
    <?php
    foreach ($list as $item) {
    ?>
    <div class="row list-item">
        <div class="span2">
            <a href="<?php echo $item['douban_url'];?>" target="_blank"><img src="<?php echo $item['image'];?>"/></a>
        </div>
        <div class="span9">
            <div><a href="/book/<?php echo $item['id'];?>" target="_blank"><?php echo $item['title'];?></a></div>
            <div><?php echo $item['author'];?></div>
            <div><?php echo $item['pages'];?></div>
            <div><?php echo $item['isbn13'];?></div>
        </div>
    </div>
    <?php 
    }
    ?>
    <?php
    $pager = array('page'=>$page, 'total_page'=>$total_page);
    $this->load->view('widgets/pager', array('pager'=>$pager));
    ?>
</div>