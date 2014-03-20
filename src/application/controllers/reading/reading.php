<?php
require_once dirname(__FILE__).'/../auth.php';

class Reading_Controller extends Auth_Controller {
    public function __construct() {
        parent::__construct();
    }
}