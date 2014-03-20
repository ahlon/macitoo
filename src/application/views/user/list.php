<div class="container">
    <form class="well form-search">
        <input type="text" name="display_name" value="" class="input-middle" placeholder="昵称">
        <input type="text" name="email" value="" class="input-middle" placeholder="邮箱">
        <button type="submit" class="btn">Search</button>
    </form>
    
    <table id="widgets_table" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>昵称</th>
                <th>邮箱</th>
                <th>性别</th>
                <th>组</th>
                <th>状态</th>
                <th>注册时间</th>
                <th>最近更新时间</th>
                <th>最近登录时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list as $item) {
            echo '<tr>';
            echo '<td>'.$item['display_name'].'</td>';
            echo '<td>'.$item['email'].'</td>';
            echo '<td>'.$item['gender'].'</td>';
            echo '<td>'.@$item['groups'].'</td>';
            echo '<td>'.$item['status'].'</td>';
            echo '<td>'.$item['created_time'].'</td>';
            echo '<td>'.$item['last_updated_time'].'</td>';
            echo '<td>'.$item['last_login_time'].'</td>';
            echo '<td></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>