<?php
define ("USE_SINAAPP", "No");

if(USE_SINAAPP == "Yes")
{
	define("APP_CONTEXT", "/");
	define("URL_ROOT", "/");
	define("MYSQL_HOST", SAE_MYSQL_HOST_M);
	define("MYSQL_PORT", SAE_MYSQL_PORT);
	define("MYSQL_DB", SAE_MYSQL_DB);
	define("MYSQL_USER", SAE_MYSQL_USER);
	define("MYSQL_PASSWORD", SAE_MYSQL_PASS);
}
else
{
	define("APP_CONTEXT", "/");
	define("URL_ROOT", "/macitoo/2/");
	define("MYSQL_HOST", "127.0.0.1");
	define("MYSQL_PORT", 3306);
	define("MYSQL_DB", "macitoo");
	define("MYSQL_USER", "root");
	define("MYSQL_PASSWORD", 'root');
}
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');    
}

define('SRCPATH', dirname(__FILE__).'/');
// Path to the data folder, added by ahlon
define('DATAPATH', dirname(__FILE__).'/data/');

// phantomjs exe file location
define('PHANTOMJS_EXE', 'D:\phantomjs-1.8.2\phantomjs.exe');

ob_start();
?>