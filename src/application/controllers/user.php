<?php
require_once dirname(__FILE__).'/auth.php';

class User extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');

        $this->load->library('widget');
        
        $this->layout = 'layouts/layout_1';
        // $header_widget = new Widget('default/header', $this->data);
        // $footer_widget = new Widget('default/footer', $this->data);
        $this->widgets = array(
            'header'=>new Widget('default/header', $this->data),
            'footer'=>new Widget('default/footer', $this->data)
        );
    }
    
    function view($id) {
        // prepare page data
        $user = $this->user_model->load($id);
        $this->data['user'] = $user;
        $this->data['card_img'] = '/image/1';
        // pick a layout
        // use controller default
        // $this->layout = 'layouts/layout_1';

        // collect widgets to be shown
        // $this->widgets['content'][] = new Widget('user/view', $this->data);
        // $this->widgets['content'][] = new Widget('user/user-card', $this->data);
        $this->layout = 'layouts/layout_2';
        
        $this->widgets['left_content'][] = new Widget('user/view', $this->data);
        $this->widgets['right_content'][] = new Widget('user/user-card', $this->data);
        
        // render page
        $this->render();
    }
}