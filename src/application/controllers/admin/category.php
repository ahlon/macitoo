<?php
require_once dirname(__FILE__).'/admin.php';

class Category extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->taxonomy = 'category';
        
        $this->data['taxonomy'] = $this->taxonomy;
    }
    
    function index() {
        $categories = $this->category_model->get_root_categories($this->taxonomy);
        $this->data['list'] = $categories;
        
        $this->widgets['content'] = new Widget('category/list', $this->data);
        $this->render();
    }

    function add() {
    	$this->widgets['content'] = new Widget($this->taxonomy.'/new', $this->data);
    	$this->render();
    }
    
    function save() {
        $post = $this->input->post();
        $category = array(
            'name'=>$post['name'],
            'taxonomy'=>$post['taxonomy'],
            'description'=>$post['description']
        );
        if (!empty($post['parent'])) {
            $category['parent'] = $post['parent'];
        }
        $this->category_model->save($category);
        header('location:/admin/categories');
    }
    
    function view($id) {
        $categories = $this->category_model->get_children($id);
        $this->data['list'] = $categories;

        $category = $this->category_model->load($id);
        $this->data['category'] = $category;
        
        $parents = array();
        
        if ($category['treepath']) {
            $parent_ids = explode('>', $category['treepath']);
            foreach ($parent_ids as $p_id) {
                if ($p_id) {
                    $parents[] = $this->category_model->load($p_id);
                }
            }
        }
        $this->data['parents'] = $parents;
        
        $this->widgets['content'] = new Widget('category/list', $this->data);
        $this->render();
    }
}