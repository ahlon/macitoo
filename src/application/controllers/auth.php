<?php
require_once dirname(__FILE__).'/base.php';

abstract class Auth_Controller extends Base_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->is_user_logined()) {
            header("location:/login?redirect_url=/".$this->uri->uri_string());
        }
    }
}

?>