<link rel="stylesheet" href="/assets/bootstrap-modal/css/bootstrap-modal.css"/>

<div class="container">
    <form class="well form-search">
        <input type="text" name="name" value="" class="input-middle" placeholder="名称">
        <button type="submit" class="btn">Search</button>
        <button id="new-group" type="button" class="btn pull-right"><i class="icon-plus"></i> New</button>
    </form>
    
    <table id="widgets_table" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>组名</th>
                <th>描述</th>
                <th>父级</th>
                <th>创建时间</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list as $item) {
            echo '<tr>';
            echo '<td>'.$item['id'].'</td>';
            echo '<td>'.$item['name'].'</td>';
            echo '<td>'.$item['description'].'</td>';
            echo '<td>'.@$item['parent']['name'].'</td>';
            echo '<td>'.$item['created_time'].'</td>';
            echo '<td></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<div id="ajax-modal" class="modal hide fade" tabindex="-1"></div>

<script src="/assets/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="/assets/bootstrap-modal/js/bootstrap-modal.js"></script>
<script>
var modal = $('#ajax-modal');

$('#new-group').on('click', function() {
    $('body').modalmanager('loading');
    setTimeout(function() {
        modal.load('/snippet/group-new', '', function() {
            modal.modal();
        });
    }, 200);
});
</script>