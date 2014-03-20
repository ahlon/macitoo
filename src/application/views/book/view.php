<link rel="stylesheet" href="/assets/js/jRating/jRating.jquery.css"/>
<script src="/assets/js/book.js"></script>
<script src="/assets/js/jRating/jRating.jquery.js"></script>

<nav>
    <ul class="breadcrumb">
        <!--  
        <li><a href="/">首页</a> <span class="divider">/</span></li>
        <li><a href="/books">图书</a> <span class="divider">/</span></li>
        -->
        <li class="active"><?php echo $item['title'];?></li>
    </ul>
</nav>

<div class="row">
    <div class="span2">
        <section>
        <div class="cover">
            <a href="<?php echo $item['douban_url'];?>" target="_blank"><img src="<?php echo $item['image'];?>" class="img-polaroid"/></a>
        </div>
        
        <div>
            <dl class="dl-horizontal">
                <dt>作者</dt>
                <dd><?php echo $item['author'];?></dd>
                <dt>页数</dt>
                <dd><?php echo $item['pages'];?></dd>
                <dt>ISBN</dt>
                <dd><?php echo $item['isbn13'];?></dd>
            </dl>
        </div>
        </section>
    </div>
    
    <div class="span7">
    <section>
        <div><a href="/book/<?php echo $item['id'];?>" target="_blank"><?php echo $item['title'];?></a></div>
        <!--  
        <div>
            <code><?php echo $item['do_count'];?> 在读</code>
            <code><?php echo $item['wish_count'];?> 想读</code>
            <code><?php echo $item['collect_count'];?> 已读</code>
        </div>
        -->
        
        <div class="rating" data-average="10" data-id="<?php echo $item['rating'];?>"></div>
        
        <div class="btn-group" data-toggle="buttons-radio">
            <div class="btn-group">
                <a class="btn <?php echo @$item['rd_status'] == 'do' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'do');">(<?php echo @$item['do_count'];?>)在读</a>
                <a class="btn <?php echo @$item['rd_status'] == 'wish' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'wish');">(<?php echo @$item['wish_count'];?>)想读</a>
                <a class="btn <?php echo @$item['rd_status'] == 'collect' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'collect');">(<?php echo @$item['collect_count'];?>)已读</a>
                <a href="/plan/make/book/<?php echo $item['id']?>" class="btn">制定阅读计划</a>
                <input type="button" class="btn " value="开始一个番茄钟的阅读" onclick="start(<?php echo $item['id'];?>)"/>
            </div>
        </div>
        
        <p><?php echo $item['summary']?></p>
        
        <!--  
        <div id="content-tab" class="navbar">
            <div class="navbar-inner">
                <ul class="nav" style="">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Downloads</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        -->
    </section>
    </div>
</div>      

<ul class="nav nav-tabs">
            <li class="active"><a href="#comments">书评</a></li>
            <li><a href="#notes">笔记</a></li>
        </ul>
        <?php include_once dirname(__FILE__).'/../widgets/comments.php';?>  

<script type="text/javascript">
function start(id) {
	var url = '/book/start_reading/' + id;
	//alert(url);
	$.get(url, function(data) {
		//alert(data);
	    //location.reload();
	    //location.href = url;
	    location.href = '/timer/'+data
    });
}
</script>