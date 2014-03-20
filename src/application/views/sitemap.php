<?php 
foreach ($list as $k=>$array) {
?>
<h3><?php echo $k;?></h3>
<?php 
    echo '<p>';
    echo '<pre class="prettyprint linenums">';
    foreach ($array as $item) {
        echo '<span class="label label-success">'.$item.'</span>&nbsp;';
    }
    echo '</p>';
    echo '</pre>';
}
?>