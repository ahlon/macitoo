<?php
require_once dirname(__FILE__).'/admin.php';

class Index extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index() {
        $this->render();
    }
}