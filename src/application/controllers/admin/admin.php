<?php
require_once dirname(__FILE__).'/../auth.php';

class Admin_Controller extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->widgets = array(
            'header'=>new Widget('admin/header', $this->data),
            'footer'=>new Widget('default/footer', $this->data)
        );
    }
}