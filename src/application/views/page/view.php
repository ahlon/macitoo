<link rel="stylesheet" href="/assets/js/jRating/jRating.jquery.css"/>
<script src="/assets/js/book.js"></script>
<script src="/assets/js/jRating/jRating.jquery.js"></script>

<div class="container">
    <div class="row">
        <div class="span8">
            <nav>
                <ul class="breadcrumb">
                    <li class="active"><?php echo $item['title'];?></li>
                    
                    <li class="pull-right"><a class="btn" href="/pages">分享链接</a></li>
                </ul>
            </nav>
            <div>
                <img src="<?php echo $item['img_url'];?>"/>
            </div>
            <section>
                <p>
                <?php echo $item['content'];?>
                </p>
            </section>
            <section>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#comments">评论</a></li>
                </ul>
                <?php include_once dirname(__FILE__).'/../widgets/comments.php';?>
            </section>
        </div>
        
        <div class="span4">
            <div class="panel">
                <div class="title">收藏</div>
                <div class="content">
                    <div class="media">
                      <a class="pull-left" href="#">
                          <img src="<?php echo $mct_user['avatar_url']?>" class="img-polaroid" width="48px;"/>
                      </a>
                      <div class="media-body">
                          <div><?php echo $mct_user['display_name'];?></div>
                          <div><?php echo nice_time(strtotime($item['created_time']));?>收藏</div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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