<?php
require_once dirname(__FILE__) . '/base.php';

class Sitemap extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    //default homepage
    public function index($page = 'welcome') {
        
    }
}