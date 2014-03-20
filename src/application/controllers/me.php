<?php
require_once dirname(__FILE__).'/auth.php';

class Me extends Auth_Controller {
    function index() {
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
}