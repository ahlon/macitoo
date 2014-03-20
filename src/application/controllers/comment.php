<?php
require_once dirname(__FILE__).'/auth.php';

class Comment extends Auth_Controller {
    
    function __construct() {
        parent::__construct();
        // $this->load->model('segments_model', TRUE);
        $this->load->model('comment_model');
    }
    
    function save() {
        $post = $this->input->post();
        $user_id = $this->mct_user['id'];
        if ($user_id) {
            $obj_type = $post['obj_type'];
            $obj_id = $post['obj_id'];
            $content = $post['content'];
            $data = array(
                'obj_type'=>$obj_type,
                'obj_id'=>$obj_id,
                'creator_id'=>$user_id,
                'content'=>$content,
                'status'=>'new'
            );
            $this->comment_model->save($data);
        }
        if (empty($_SERVER['HTTP_REFERER'])) {
            header('location:/');
        } else {
            // header('location:'.$_SERVER["REQUEST_URI"]);
            header('location:'.$_SERVER["HTTP_REFERER"]);
        }
    }
    
    function demo() {
        $this->load->view('demo');
    }
    
}