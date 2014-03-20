<?php
require_once dirname(__FILE__).'/base.php';

class Snippet extends Base_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function show($name) {
        $this->load->view(str_replace('-', '/', $name));
    }
}