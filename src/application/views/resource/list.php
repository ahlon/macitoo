<div class="container">
    <form class="well form-search">
        <input type="text" name="name" value="" class="input-middle" placeholder="名称">
        <button type="submit" class="btn">Search</button>
    </form>
    
    <table id="widgets_table" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Uri</th>
                <th>创建时间</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list as $item) {
            echo '<tr>';
            echo '<td>'.$item['id'].'</td>';
            echo '<td>'.$item['uri'].'</td>';
            echo '<td>'.$item['created_time'].'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
