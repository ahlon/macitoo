<?php
require_once dirname(__FILE__).'/../index.php';
require_once dirname(__FILE__).'/../application/models/user_model.php';

// require_once dirname(__FILE__).'/../system/core/CodeIgniter.php';
// require_once dirname(__FILE__).'/../application/models/user_model.php';

// $ci = & get_instance();
// $user_model = $ci->load->model('user_model');
// $user = $user_model->load(1);
// print_r($user);

require_once dirname(__FILE__).'/../ci_external.php';

$CI =& get_instance();

$CI->load->model('user_model');
$user = $CI->user_model->load(1);

print_r($user);