<?php
include "../libs/smarty/Smarty.class.php";
define ( '__SITE_ROOT', 'd:/appserv/web/demo' ); // 最后没有斜线
$tpl = new Smarty ();
$tpl->template_dir = __SITE_ROOT . "/templates/";
$tpl->compile_dir = __SITE_ROOT . "/templates_c/";
$tpl->config_dir = __SITE_ROOT . "/configs/";
$tpl->cache_dir = __SITE_ROOT . "/cache/";
$tpl->left_delimiter = '<{';
$tpl->right_delimiter = '}>';
?>