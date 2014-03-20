<?php
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('D:\works\monolog.log', Logger::WARNING));

// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');