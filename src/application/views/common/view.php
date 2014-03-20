<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>属性</th>
            <th>值</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($object as $key=>$val) {
        ?>
        <tr>
            <td><?php echo $key;?></td>
            <td><?php echo $val;?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<a  href="/<?php echo $obj_type;?>" class="btn">返回</a>