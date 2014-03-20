<link rel="stylesheet" href="/assets/js/jRating/jRating.jquery.css"/>
<script src="/assets/js/jRating/jRating.jquery.js"></script>
<script src="/assets/js/book.js"></script>

<div class="container">
    <div class="row">
        <div class="span2">
            <!-- nav nav-tabs nav-stacked -->
            <ul class="nav nav-tabs nav-stacked box"> 
                <?php 
                $base_uri = $this->uri->uri_string;
                $params = $this->input->get();
                unset($params['p']);
                unset($params['tag']);
                $url = empty($params) ? '/'.$base_uri : '/'.$base_uri.'?'.http_build_query($params);
                $_tag = isset($_GET['tag']) ? $_GET['tag'] : '';
                if (empty($_tag)) {
                    echo '<li class="active"><a href="'.$url.'">全部分类</a></li>';
                } else {
                    echo '<li><a href="'.$url.'">全部分类</a></li>';
                }
                foreach ($tags as $tag) {
                    $_params = $params;
                    $_params['tag'] = $tag['name'];
                    $url = '/'.$base_uri.'?'.http_build_query($_params);
                    if ($_tag == $tag['name']) {
                        echo '<li class="active"><a href="'.$url.'">'.$tag['name'].'</a></li>';
                    } else {
                        echo '<li><a href="'.$url.'">'.$tag['name'].'</a></li>';
                    }
                }
                ?>
            </ul>
            <?php 
            if (isset($do_count)) {
            ?>
            <ul class="nav nav-tabs nav-stacked"> 
                <li><a href="/reading/status/in-progress">在读 (<?php echo $do_count;?>)</a></li>
                <li><a href="/reading/status/wish">想读 (<?php echo $wish_count;?>)</a></li>
                <li><a href="/reading/status/collect">已读 (<?php echo $collect_count;?>)</a></li>            
            </ul>
            <?php 
            }
            ?>
        </div>
        <div class="span7">
            <!--  
            <div class="well">
                <div class="input-append">
                    <input class="span5" id="appendedInputButtons" type="text">
                    <button class="btn" type="button">Search</button>
                </div>
            </div>
            -->
            <div class="box">
                <?php
                $pager = array('page'=>$page, 'total_page'=>$total_page);
                $this->load->view('widgets/pager', array('pager'=>$pager));
                ?>
                <?php
                foreach ($books as $item) {
                ?>
                <div class="row list-item">
                    <div class="span2">
                        <a href="/book/<?php echo $item['id'];?>" target="_blank"><img src="<?php echo $item['image'];?>" class="img-polaroid"/></a>
                    </div>
                    <div class="span4">
                        <div><a href="/book/<?php echo $item['id'];?>" target="_blank"><?php echo $item['title'];?></a></div>
                        <div><?php echo $item['author'];?></div>
                        <div><?php echo $item['press'].' / '.$item['pub_time'];?></div>
                        <!--  
                        <div class="rating" data-average="10" data-id="4"></div>
                        <div>
                            <code><?php echo $item['do_count']?> 在读</code>
                            <code><?php echo $item['wish_count']?> 想读</code>
                            <code><?php echo $item['collect_count']?> 已读</code>
                            <code><?php echo $item['comment_count']?> 评论</code>
                        </div>                        
                        <div><?php echo $item['updated'];?></div>
                        <div class="btn-group" data-toggle="buttons-radio">
                            <div class="btn-group">
                                <a class="btn <?php echo $item['rd_status'] == 'do' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'do');">(<?php echo $item['do_count'];?>)在读</a>
                                <a class="btn <?php echo $item['rd_status'] == 'wish' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'wish');">(<?php echo $item['wish_count'];?>)想读</a>
                                <a class="btn <?php echo $item['rd_status'] == 'collect' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'collect');">(<?php echo $item['collect_count'];?>)已读</a>
                            </div>
                            <div class="btn-toolbar">
                                <a class="btn" href="/reading/status/update?book_id=<?php $item['id']?>&status=do">评论</a>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
                <?php 
                }
                ?>
            </div>
            <?php
            $pager = array('page'=>$page, 'total_page'=>$total_page);
            $this->load->view('widgets/pager', array('pager'=>$pager));
            ?>
        </div>
    </div>
</div>

<!-- 
<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
-->

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>
