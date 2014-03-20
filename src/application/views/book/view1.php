<div class="container">
    <div class="row">
        <div class="span9">
            <section>
                <div class="row">
                    <div class="span2"><a href="<?php echo $item['douban_url'];?>" target="_blank"><img src="<?php echo $item['image'];?>"/></a></div>
                    <div class="span6">
                        <div><a href="/book/<?php echo $item['id'];?>" target="_blank"><?php echo $item['title'];?></a></div>
                        <div><?php echo $item['author'];?></div>
                        <div><?php echo $item['pages'];?></div>
                        <div><?php echo $item['isbn13'];?></div>
                        <div class="btn-group" data-toggle="buttons-radio">
                            <div class="btn-group">
                                <a class="btn <?php echo @$item['rd_status'] == 'do' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'do');">(<?php echo @$item['do_count'];?>)在读</a>
                                <a class="btn <?php echo @$item['rd_status'] == 'wish' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'wish');">(<?php echo @$item['wish_count'];?>)想读</a>
                                <a class="btn <?php echo @$item['rd_status'] == 'collect' ? 'active' : '';?>" href="javascript:;" onclick="updateReadingStatus(<?php echo $item['id']?>, 'collect');">(<?php echo @$item['collect_count'];?>)已读</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="span8">
                        <form id="post-form" class="form-horizontal" action="/comment/save" method="post">
                            <input type="hidden" name="obj_type" value="book"/>
                            <input type="hidden" name="obj_id" value="<?php echo $item['id'];?>"/>
                            <fieldset>
                                <div class="control-group">
                                    <textarea id="post-input" class="input-xlarge" name="content" rows="5" style="width:600px;"></textarea>
                                </div>
                                <input type="submit" class="btn" value="发布"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </section>
            
            <div class="row">
                <div class="span8">
                <?php
                foreach ($comments as $item) {
                ?>
                <div class="segment">
                    <div class="text"><?php echo $item['content'];?></div>
                    <div class="signiture"><span class="user"><?php echo $item['display_name'];?></span><span class="time" style="margin-left:20px;"><?php echo $item['created_time'];?></span></div>
                </div>
                <?php 
                }
                ?>
                </div>
            </div>
        </div>
        
        <div class="span3">
        </div>
    </div>
</div>