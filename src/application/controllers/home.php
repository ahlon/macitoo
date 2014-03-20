<?php
require_once dirname(__FILE__).'/base.php';

class Home extends Base_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    //default homepage
    function index($page = 'welcome') {
        $this->load->model('motto_model');
        $latest_motto = $this->motto_model->get_last();
        
        $this->data['motto'] = $latest_motto;
        
        $this->widgets['content'] = new Widget('home/welcome', $this->data);
        $this->render();
    }
    
    function admin() {
        $this->widgets['content'] = new Widget('admin/index', $this->data);
        $this->render();
    }
    
    public function login($from = '') {
        $this->load->helper('form');
        $this->load->library('form_validation');
    
        $data['from'] = $from;
    
        $this->widgets['content'] = new Widget('home/login', $this->data);
        $this->render();
    }
    
    //login authentication
    public function login_auth() {
        $this->load->helper('form');
        $this->load->library('form_validation');
    
        //input validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[6]|max_length[31]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $data['validation_error'] = true;
            // $this->assembly->render_by_default(array('template'=>'home/login', 'data'=>$data));
            return;
        }
        $from_url = $this->input->post('from');
        $from_url = !empty($from_url) ? $from_url : '/';
    
        $email = $this->input->post('email');
        $pwd = md5($this->input->post('password'));
        $redirect_url = $this->input->post('redirect_url');
        $from_url = $this->input->post('from_url');
    
        $this->load->model('user_model');
        $params = array('email'=>$email, 'password'=>$pwd);
        print_r($params);
        $user = $this->user_model->find_one($params);
        
        if($user) {
            $user['avatar_url'] = get_gravatar_url($user['email']);
            $this->session->set_userdata('mct_user', $user);
            if (!empty($redirect_url)) {
                redirect($redirect_url);
            } else if (!empty($from_url)) {
                redirect($from_url);
            } else {
                redirect('/');
            }
        } else {
            $data['auth_error'] = true;
            
            $this->widgets['content'] = new Widget('home/login', $this->data);
            $this->render();
        }
    }
    
    function feedback() {
        $this->widgets['content'] = new Widget('common/feedback', $this->data);
        $this->render();
    }
    
    function submit_feedback() {
        $post = $this->input->post();
                
        $this->render();
    }
    
    public function logout() {
		$this->session->unset_userdata('mct_user');
		$this->data['mct_user'] = null;
		unset($this->data);
		redirect('/');
    }
    
    // @todo to be renamed as signup
    public function signup($page = 'register') {
        $this->widgets['content'] = new Widget('home/register', $this->data);
        $this->render();
    }
}