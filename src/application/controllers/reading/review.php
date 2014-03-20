<?php
require_once dirname(__FILE__).'/reading.php';

class Review extends Reading_Controller {
    public function __construct() {
        parent::__construct();
        // $this->load->model('rd_status_model');
        // $this->load->helper('utils');
    }

    function index() {
        $this->data['nav_idx'] = 'review';
        $this->widgets['content'][] = new Widget('reading/nav', $this->data);
        $this->render();
    }
}