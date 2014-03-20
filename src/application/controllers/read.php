<?php
require_once dirname(__FILE__).'/auth.php';

class Read extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('rd_status_model');
        // $this->load->helper('utils');
    }
    
    function index() {
        $card_img = get_gravatar_url($this->mct_user['email'], 100);
        $this->data['card_img'] = $card_img;
        //$this->page_size = 5;
        $this->load->model('book_model');
        $books = $this->book_model->list_books($this->page_size, $this->page);
        $this->data['list'] = $books;
        $this->data['page'] = $this->page;
        $this->data['total_page'] = $this->book_model->count()/$this->page_size;
        //print_r($this->data);
        $layout = 'layout_2';
        $widgets = array(
            'header'=>array('template'=>'default/header'),
            'left_content'=>array('template'=>'user/user-card', 'data'=>$this->data),
            'right_content'=>array('template'=>'reading/status/list', 'data'=>$this->data),
            'footer'=>array('template'=>'default/footer')
        );
        $this->assembly->render($layout, $widgets);
    }
}