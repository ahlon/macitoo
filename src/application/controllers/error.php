<?php
require_once dirname(__FILE__) . '/base.php';

class Error extends Base_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        echo 'a';
        return ;
    }
    
    function test() {
        echo 'v';
    }
    
    function zzzzz() {
        echo 'sss';
    }
    
    function show403() {
        echo 'b';
        return ;
    }
}