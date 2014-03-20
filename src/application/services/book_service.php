<?php
class Book_service extends Base_service {
    
    function __construct() {
        parent::__construct($this->book_model);
    }
    
    function search($params, $order_by, $page_size, $page) {
        return $this->book_model->find_all($params, $order_by, $page_size, $page);
    }
    
    function count($params) {
        return $this->book_model->count($params);
    }

}