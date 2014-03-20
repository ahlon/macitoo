<?php
$data = $pager;

$page = $data['page'];
$total_page = $data['total_page'];

if ($total_page <= 5) {
    $start_page = 1;
    $end_page = $total_page;
} else {
    if ($page < 3) {
        $start_page = 1;
        $end_page = 5;
    } elseif ($page > 3 && $page < $total_page - 2) {
        $start_page = $page - 2;
        $end_page = $page + 2;
    } else {
        $start_page = $total_page - 4;
        $end_page = $total_page;
    }
}
$base_uri = $this->uri->uri_string;
$params = $this->input->get();
$first_page_url = get_pager_url($base_uri, $params, 1);
$last_page_url = get_pager_url($base_uri, $params, $total_page);
?>
<div class="pagination">
    <ul>
        <li><a href="#">Previous</a></li>
        <li><a href="#">Next</a></li>
    </ul>
    <ul>
        <?php
        if ($page > 1) {
            echo '<li><a href="' . $first_page_url . '">&laquo;</a></li>';
        } else {
            echo '<li class="disabled"><span>&laquo;</span></li>';
        }
        for($idx = $start_page; $idx <= $end_page; $idx++) {
            if ($idx == $page) {
                echo '<li class="active"><span>' . $idx . '</span></li>';
            } else {
                $idx_page_url = get_pager_url($base_uri, $params, $idx);
                echo '<li><a href="' . $idx_page_url . '">' . $idx . '</a></li>';
            }
        }
        if ($page < $total_page) {
            echo '<li><a href="' . $last_page_url . '">&raquo;</a></li>';
        } else {
            echo '<li class="disabled"><span>&raquo;</span></li>';
        }
        ?>
    </ul>
    <ul>
        <li><a href="/<?php echo $obj_type;?>/new">New</a></li>
        <li><a href="/<?php echo $obj_type;?>/new">Edit</a></li>
        <li><a href="/<?php echo $obj_type;?>/new">Delete</a></li>
    </ul>
</div>