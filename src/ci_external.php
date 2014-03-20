<?php
// Remove the query string
$_SERVER['QUERY_STRING'] = '';
// Include the codeigniter framework
ob_start();
include dirname(__FILE__).'/ci_index.php';
ob_end_clean();
?>