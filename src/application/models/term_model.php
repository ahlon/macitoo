<?php
require_once dirname(__FILE__).'/base_model.php';

class Term_model extends Base_model {
    protected $_name;
    
    public function __construct() {
        parent::__construct('cr_terms');
    }
}