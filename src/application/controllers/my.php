<?php
require_once dirname(__FILE__).'/auth.php';

class My extends Auth_Controller {
    function index() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function family() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function healthy() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function work() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function studies() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function contacts() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function finance() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function soul() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    function lifestyle() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
}
?>