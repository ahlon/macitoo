<?php
require_once dirname(__FILE__).'/auth.php';

class Settings extends Auth_Controller {
    function __construct() {
        parent::__construct();
        // $this->load->model('segments_model', TRUE);
        $this->load->model('setting_model');
        $this->load->model('user_model');
        $this->load->model('image_model');
        $this->load->helper('url');
    }
    
    function index($page) {
        $user_id = $this->session->userdata('user_id');
        
        $user = $this->user_model->get_user($user_id);
        $data['user'] = $user;
        
        $settings = $this->setting_model->get_user_settings($user_id);
        $data['settings'] = $settings;

        $this->widgets['content'] = new Widget('settings/'.$page, $data);
        $this->render();
    }
    
    function update_basic() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $params = array('id'=>$user_id);
            $data = array('display_name'=>$_POST['display_name'], 'email'=>$_POST['email'], 'city'=>$_POST['city']);
            $this->user_model->update($params, $data);
        }
        redirect('/settings/basic');
    }
    
    function update_password() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $user = $this->user_model->get_user($user_id);
            if(isset($_POST['new_password'])) {
                if(md5($_POST['old_password']) != $user['password'] || strlen($_POST['new_password']) < 6
                        || $_POST['new_password'] != $_POST['re_new_password']) {
                    echo "Unable to change password !";
                } else {
                    $params = array('id'=>$user_id);
                    $data = array('password'=>$_POST['new_password']);
                    $this->user_model->update($params, $data);
                    redirect('/settings/password');
                }
            }
        }
    }
    
    function update_third_parties() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $params = array('user_id'=>$user_id);
            $data = array('calendar_url'=>$_POST['calendar_url'], 'douban_id'=>$_POST['douban_id']);
            $this->setting_model->update($params, $data);
            redirect('/settings/third-parties');
        }
    }
    
    function upload_avatar() {
        $user_id = $this->session->userdata('user_id');
        $this->load->helper('url');
        $config['upload_path'] = '/macitoo_data/tmp_upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = date('YmdHis', time()).'_'.sprintf('%02d', rand(0,99));
        $config['max_size'] = '500';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $upload_file = $this->upload->data();
            $data = array('content' => file_get_contents($upload_file['full_path']));
            $this->image_model->save($data);
            $params = array('user_id'=>$user_id);
            $settings_data = array('avatar_img_id'=>$data['id']);
            $this->setting_model->update($params, $settings_data);
        }
    }
}