<?php
require_once dirname(__FILE__).'/reading.php';

class Index extends Reading_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('rd_status_model');
        // $this->load->helper('utils');
    }

    function index() {
        header('location:/books');
        return;
        $card_img = get_gravatar_url($this->mct_user['email'], 100);
        $this->data['card_img'] = $card_img;
        //$this->page_size = 5;
        $this->load->model('book_model');
        $books = $this->book_model->list_books($this->page_size, $this->page);
        $this->data['list'] = $books;
        $this->data['page'] = $this->page;
        $this->data['total_page'] = $this->book_model->count()/$this->page_size;

        $this->layout = 'layouts/layout_4';

        $this->widgets['header'] = new Widget('default/header', $this->data);
        $this->widgets['nav'] = new Widget('reading/nav', $this->data);
        $this->widgets['left_content'] = new Widget('user/user-card', $this->data);
        $this->widgets['right_content'] = new Widget('reading/status/list', $this->data);
        $this->widgets['footer'] = new Widget('default/footer', $this->data);
        $this->render();
    }
}