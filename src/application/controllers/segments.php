<?php
require_once dirname(__FILE__).'/auth.php';

class Segments extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        // $this->load->model('segments_model', TRUE);
        $this->load->model('segments_model');
    }

    public function index($page = 'list') {
        // ci_cache is disabled by sae, use Memcached or KVDB instead
        // $this->output->cache(1);
        $data['datalist'] = $this->segments_model->list_segments();
        $data['title'] = ucfirst($page); 
        
        $this->widgets['content'] = new Widget('me/index', $this->data);
        $this->render();
    }
    
    public function save() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Create a news item';
        $this->form_validation->set_rules('text', 'Text', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('segments/list');
            $this->load->view('templates/footer');
        } else {
            $this->segments_model->set_segment();
            header('location:/segments');
        }
    }
    
    public function view_json($id) {
        $result = $this->segments_model->get_segment($id);
        echo json_encode($result);
    }
}