<?php
/**
 * Shall I write something here 
 */
abstract class Base_Controller extends CI_Controller {
    var $url_suffix;
    
	var $layout;
	var $widgets;
	var $data;
	
	var $page_size = 10;
	var $page;
	var $orderby;
	
	var $mct_user;
	
    public function __construct() {
        parent::__construct();
        // $this->load->library('page', null, 'assembly');
        $this->load->library('session');
        $this->load->library('widget');
        $this->load->model('category_model');
        $this->load->helper('utils_helper');
        
        $mct_user = $this->session->userdata('mct_user');
        if ($mct_user) {
            $this->mct_user = $mct_user;
            $this->data['mct_user'] = $mct_user;
        }
        
        $this->p = $this->input->get('p') ? $this->input->get('p') : 1;
        $this->order_by = $this->input->get('o') ? $this->input->get('o') : null;
        
        if ($this->input->get('mode') == 'debug') {
            $this->output->enable_profiler(TRUE);
        }
        
        $dotpos = strpos($this->uri->uri_string, '.');
        $this->url_suffix = $dotpos > 0 ? substr($this->uri->uri_string, $dotpos + 1) : '';
        
        $header_menus = $this->category_model->get_children(6);
        $this->data['header_menus'] = $header_menus;
        
        $this->layout = 'layouts/layout_1';
        $this->widgets = array(
            'header'=>new Widget('default/header', $this->data),
            'footer'=>new Widget('default/footer', $this->data)
        );
        
        if (!empty($this->uri->segments[1])) {
            $this->data['_obj_type'] = $this->uri->segments[1];
        }
        if (!empty($this->uri->segments[2]) && is_int(intval($this->uri->segments[2]))) {
            $this->data['_obj_id'] = $this->uri->segments[2];
        }
    }
    
    function is_user_logined() {
    	$user = $this->session->userdata('mct_user');
    	return !empty($user);
    }
    
    function __check_login_status() {
    	if (!$this->is_user_logined()) {
    		header("location:/login?redirect=".$this->uri->uri_string());
    		return FALSE;
    	}
    	return TRUE;
    }
    
    function render($_config = null) {
        if ($_config) {
            $config = $_config;
        } else {
            $config = array('content_type'=>$this->url_suffix, 'layout'=>$this->layout,
                    'widgets'=>$this->widgets, 'data'=>$this->data);
        }
        $this->load->library('page', $config);
        $this->page->render();
    }
}