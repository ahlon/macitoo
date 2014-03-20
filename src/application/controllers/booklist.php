<?php
require_once dirname(__FILE__) . '/base.php';

class Booklist extends Base_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->service('book_service');
        $this->load->service('tag_service');
    }
    
    function index() {
        
    }
    
    function view() {
        
    }
}