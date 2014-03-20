<?php
require_once dirname(__FILE__) . '/base_model.php';

class Trace_session_model extends Base_model {
    function __construct() {
        parent::__construct('trace_sessions');
        $this->db = $this->load->database('trace', true);
    }
}