<?php 
if (!empty($rd_statuses['do'])) {
?>
<div class="panel">
    <div class="title">在读</div>
    <div class="content">
        <?php 
        foreach ($rd_statuses['do'] as $st) {
        ?>
        <div class="media">
          <a class="pull-left" href="#">
              <img src="/image/<?php echo $st['user_settings']['avatar_img_id']?>" class="img-polaroid" width="48px;">
              <!--
              <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACGklEQVR4Xu2Yva8BQRTF7xY+g4rQiagIFUL8+wqh0GyxUaMTFYUE+96d5G7mzfNiJ8Mju2cbxu7cmXvmzP2t8Q6HQ0gpvjwIAAdgC6AGpLgGEoogKAAKgAKgACiQYgWAQWAQGAQGgcEUQwB/hoBBYBAYBAaBQWAwxQo8BYNBENBut4tk7PV61Gg0orbcz+fzNB6PKZPJPJT8FTHvDeosgDlRHkQX4HK50Gw2o+v1SnEFeEXMvxR3EkBPzlx1GXC1WtHxeCR+NpvNKgf4vk/f7x9ULpdVe7PZ0Hq9VgINh0Oaz+dKMJuYcVz1dAfIxGu1mkrIXGW532w2abvdKutzwp7nRa7odrsq+dvtRtPplPb7vWrbxnyLAGLVXC5H5/M5Erher1On01FJFotFGgwG6rsIwJ8ijnRqtVrUbrfJJebDwnLnAactIJPlhPv9fpQUW7tSqajCyDauVqu/BOAVXywWdDqdftQGl5j/LoCsormXS6UShWGokjMvtr9udbl/T0S9PsSJWSgUrDVwcoC+ivrIYmf5TYqlWQO4/2QyoeVyGdUA3k7iDJuYb6kBPEGdBNw2k9ef4UmORiNiMrA7ZNXN9wS9SMaJGffd4ukUsPbbB3Zw2gIfmI/1lCAAToRwIoQTIZwIWZfOBHUABUABUAAUAAUSVNStUwEFQAFQABQABaxLZ4I6gAKgACgACoACCSrq1qmAAmmnwBfW1lSfONUhrQAAAABJRU5ErkJggg==">
              -->
          </a>
          <div class="media-body">
              <div><?php echo $st['user']['display_name'];?></div>
              <div><?php echo $st['nice_time']?> 在读</div>
          </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php 
}
if (!empty($rd_statuses['collect'])) {
?>
<div class="panel">
    <div class="title">已读</div>
    <div class="content">
        <?php 
        foreach ($rd_statuses['collect'] as $st) {
        ?>
        <div class="media">
          <a class="pull-left" href="#">
              <img src="/image/<?php echo $st['user_settings']['avatar_img_id']?>" class="img-polaroid" width="48px;">
              <!--
              <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACGklEQVR4Xu2Yva8BQRTF7xY+g4rQiagIFUL8+wqh0GyxUaMTFYUE+96d5G7mzfNiJ8Mju2cbxu7cmXvmzP2t8Q6HQ0gpvjwIAAdgC6AGpLgGEoogKAAKgAKgACiQYgWAQWAQGAQGgcEUQwB/hoBBYBAYBAaBQWAwxQo8BYNBENBut4tk7PV61Gg0orbcz+fzNB6PKZPJPJT8FTHvDeosgDlRHkQX4HK50Gw2o+v1SnEFeEXMvxR3EkBPzlx1GXC1WtHxeCR+NpvNKgf4vk/f7x9ULpdVe7PZ0Hq9VgINh0Oaz+dKMJuYcVz1dAfIxGu1mkrIXGW532w2abvdKutzwp7nRa7odrsq+dvtRtPplPb7vWrbxnyLAGLVXC5H5/M5Erher1On01FJFotFGgwG6rsIwJ8ijnRqtVrUbrfJJebDwnLnAactIJPlhPv9fpQUW7tSqajCyDauVqu/BOAVXywWdDqdftQGl5j/LoCsormXS6UShWGokjMvtr9udbl/T0S9PsSJWSgUrDVwcoC+ivrIYmf5TYqlWQO4/2QyoeVyGdUA3k7iDJuYb6kBPEGdBNw2k9ef4UmORiNiMrA7ZNXN9wS9SMaJGffd4ukUsPbbB3Zw2gIfmI/1lCAAToRwIoQTIZwIWZfOBHUABUABUAAUAAUSVNStUwEFQAFQABQABaxLZ4I6gAKgACgACoACCSrq1qmAAmmnwBfW1lSfONUhrQAAAABJRU5ErkJggg==">
              -->
          </a>
          <div class="media-body">
              <div><?php echo $st['user']['display_name'];?></div>
              <div><?php echo $st['nice_time']?> 已读</div>
          </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php 
}
if (!empty($rd_statuses['wish'])) {
?>
<div class="panel">
    <div class="title">想读</div>
    <div class="content">
        <?php 
        foreach ($rd_statuses['wish'] as $st) {
        ?>
        <div class="media">
          <a class="pull-left" href="#">
              <img src="/image/<?php echo $st['user_settings']['avatar_img_id']?>" class="img-polaroid" width="48px;">
              <!--
              <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACGklEQVR4Xu2Yva8BQRTF7xY+g4rQiagIFUL8+wqh0GyxUaMTFYUE+96d5G7mzfNiJ8Mju2cbxu7cmXvmzP2t8Q6HQ0gpvjwIAAdgC6AGpLgGEoogKAAKgAKgACiQYgWAQWAQGAQGgcEUQwB/hoBBYBAYBAaBQWAwxQo8BYNBENBut4tk7PV61Gg0orbcz+fzNB6PKZPJPJT8FTHvDeosgDlRHkQX4HK50Gw2o+v1SnEFeEXMvxR3EkBPzlx1GXC1WtHxeCR+NpvNKgf4vk/f7x9ULpdVe7PZ0Hq9VgINh0Oaz+dKMJuYcVz1dAfIxGu1mkrIXGW532w2abvdKutzwp7nRa7odrsq+dvtRtPplPb7vWrbxnyLAGLVXC5H5/M5Erher1On01FJFotFGgwG6rsIwJ8ijnRqtVrUbrfJJebDwnLnAactIJPlhPv9fpQUW7tSqajCyDauVqu/BOAVXywWdDqdftQGl5j/LoCsormXS6UShWGokjMvtr9udbl/T0S9PsSJWSgUrDVwcoC+ivrIYmf5TYqlWQO4/2QyoeVyGdUA3k7iDJuYb6kBPEGdBNw2k9ef4UmORiNiMrA7ZNXN9wS9SMaJGffd4ukUsPbbB3Zw2gIfmI/1lCAAToRwIoQTIZwIWZfOBHUABUABUAAUAAUSVNStUwEFQAFQABQABaxLZ4I6gAKgACgACoACCSrq1qmAAmmnwBfW1lSfONUhrQAAAABJRU5ErkJggg==">
              -->
          </a>
          <div class="media-body">
              <div><?php echo $st['user']['display_name'];?></div>
              <div><?php echo $st['nice_time']?> 想读</div>
          </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php 
}
?>
