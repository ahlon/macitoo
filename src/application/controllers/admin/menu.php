<?php
require_once dirname(__FILE__).'/category.php';

class Menu extends Category {
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->taxonomy = 'menu';
        
        $this->data['taxonomy'] = $this->taxonomy;
    }
}