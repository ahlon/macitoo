<?php
class Image extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('image_model');
    }
    
    function view($id) {
        $image = $this->image_model->load($id);
        $this->output->set_content_type('image/png')->set_output($image['content']);
    }
    
    function index() {
        $books = $this->image_model->list_books($this->page_size, $this->page);
    }
}