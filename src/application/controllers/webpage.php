<?php
require_once dirname(__FILE__).'/auth.php';

class Webpage extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('page_model');
    }
    
    function index() {
        $list = $this->page_model->find_all(array(), null, $this->page_size, $this->page);
        $this->data['list'] = $list;
        
        $this->widgets['content'] = new Widget('page/index', $this->data);
        $this->render();
    }
    
    public function view($id) {
        $page = $this->page_model->load($id);
        // $page['img_url'] = 'http://ikimage.b0.upaiyun.com/img/10/67/86/635006853746191496.jpg_500';
        $page['img_url'] = '/data/img/'.$page['snapshot_img_id'].'.png';
        $this->data['item'] = $page;

        $this->load->model('comment_model');
        $params = array('obj_type'=>$this->data['_obj_type'], 'obj_id'=>$this->data['_obj_id']);
        $comments = $this->comment_model->find_all($params);
        $this->data['comments'] = $comments;

        $this->widgets['content'] = new Widget('page/view', $this->data);
        $this->render();
    }
    
    function save() {
        $time = time();
        $url = $this->input->post('url');
        $module = SRCPATH.'nodejs/screenshot.js';
        $img_path = DATAPATH.'img/'.$time.'.png';
        $exec = PHANTOMJS_EXE.' '.$module.' '.$url.' '.$img_path;
        system($exec, $output);
        
        $this->load->helper('utils');
        $r = get_url_page_content('http://lixiaolai.com/fly-mode-vs-bee-mode');
        
        $user_id = $this->mct_user['id'];
        $page = array(
            'url'=>$url,
            'title'=>$url,
            'snapshot_img_id'=>$time,
            'summary'=>'',
            'content'=>$r['content'],
            'creator_id'=>$user_id
        );
        $this->page_model->save($page);
        
        header('location:/page/'.$page['id']);
    }
}