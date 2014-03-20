<?php
require_once dirname(__FILE__).'/reading.php';

class Status extends Reading_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('rd_status_model');
        $this->load->helper('utils');
    }
    
    function update() {
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            $book_id = $this->input->get('book_id');
            $status = $this->input->get('status');
            $this->rd_status_model->save_or_update_user_reading_status($user_id, $book_id, $status);
            // print_r($this->input->get);
        }
    }

    public function in_progress() {
        $this->data['nav_idx'] = 'do';
        $this->list_by_status('do', $this->page_size, $this->p);
    }

    public function collect() {
        $this->data['nav_idx'] = 'collect';
        $this->list_by_status('collect', $this->page_size, $this->p);
    }

    public function wish() {
        $this->data['nav_idx'] = 'wish';
        $this->list_by_status('wish', $this->page_size, $this->p);
    }
    
    private function list_by_status($status, $page_size, $page) {
        $this->data['status'] = $status;
        $this->data['page'] = $this->page;
        
        $params = array('user_id'=>$this->mct_user['id'], 'status'=>$status);
        $this->data['list'] = $this->rd_status_model->get_reading_statuses($params, null, $this->page_size, $this->p);
        $this->data['count'] = $this->rd_status_model->count($params);
        
        $this->data['page'] = $this->page;
        $this->data['total_page'] = ceil($this->data['count'] / $this->page_size);
        
        $card_img = get_gravatar_url($this->mct_user['email'], 100);
        $this->data['card_img'] = $card_img;
        
        $params = array('user_id'=>$this->mct_user['id'], 'status'=>'do');
        $this->data['do_count'] = $this->rd_status_model->count($params);

        $params = array('user_id'=>$this->mct_user['id'], 'status'=>'wish');
        $this->data['wish_count'] = $this->rd_status_model->count($params);
        
        $params = array('user_id'=>$this->mct_user['id'], 'status'=>'collect');
        $this->data['collect_count'] = $this->rd_status_model->count($params);
        
        $this->layout = 'layouts/layout_4';
        $this->widgets['nav'] = new Widget('reading/nav', $this->data);
        $this->widgets['left_content'] = new Widget('user/user-card', $this->data);
        $this->widgets['right_content'] = new Widget('reading/status/list', $this->data);
        
//         $this->widgets['content'][] = new Widget('reading/nav', $this->data);
//         $this->widgets['content'][] = new Widget('reading/status/list', $this->data);
        $this->render();
    }

    public function plans() {
        $data['status'] = 'do';
        $data['datalist'] = $this->rd_status_model->get_user_reading_statuses(1, 'do');
        
        $this->widgets['content'] = new Widget('reading/plan/list', $data);
        $this->render();
    }
}
?>