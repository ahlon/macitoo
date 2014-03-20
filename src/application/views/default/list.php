<?php 
$keys = array_keys($list[0]);
?>
<div class="container">
    <table id="widgets_table" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead>
            <tr>
            <?php 
            foreach ($keys as $key) {
                echo '<th>'.$key.'</th>';
            }
            ?>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list as $item) {
            echo '<tr>';
            foreach ($keys as $key) {
                echo '<td>'.$item[$key].'</td>';
            }
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>