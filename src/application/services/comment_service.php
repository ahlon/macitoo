<?php
class Comment_service extends Base_service {

    function __construct() {
        parent::__construct($this->comment_model);
    }
    
    function get_by_obj($obj_type, $obj_id, $page_size, $page) {
        return $this->comment_model->get_by_obj($obj_type, $obj_id, $page_size, $page);
    }

}