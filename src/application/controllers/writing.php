<?php
require_once dirname(__FILE__).'/auth.php';

/**
 * @author ahlon
 */
class Writing extends Auth_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index($page = 'index') {
        $this->widgets['content'] = new Widget('writing/index', $this->data);
        $this->render();
    }
}