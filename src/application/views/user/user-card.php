<div class="first vcard" itemtype="http://schema.org/Person">
    <div class="avatared">
        <span class="tooltipped downwards" original-title="Change your avatar at gravatar.com"><a href="http://gravatar.com/emails/">
            <img src="<?php echo $card_img;?>" class="img-polaroid"></a></span>
        <h3>
            <span itemprop="additionalName" class="name-only"><?php echo $mct_user['display_name'];?></span>
        </h3>
    </div>
    <ul class="stats">
      <li>
        <a href="/ahlon/followers">
          <strong><?php echo $do_count;?></strong>
          <span>在读</span>
        </a>
      </li>
      <li>
          <a href="/stars">
            <strong><?php echo $wish_count;?></strong>
            <span>想读</span>
          </a>
      </li>
      <li>
        <a href="/ahlon/following">
          <strong><?php echo $collect_count;?></strong>
          <span>已读</span>
        </a>
      </li>
    </ul>
</div>