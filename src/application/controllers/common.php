<?php
require_once dirname(__FILE__) . '/base.php';
/**
 * @author ahlon
 */
class Common extends Base_Controller {
    
    protected $obj_type;
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        
        $this->obj_type = $this->uri->segments[1];
        $this->data['obj_type'] = $this->obj_type;
    }
    
    // {common}/list
    function index() {
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->data['list'] = $this->service->search(array(), 'id', $this->p, 10);
        $this->data['pager'] = array('page'=>$this->p, 'total_page'=>10);
     
        $this->widgets['content'][] = new Widget('common/pager', $this->data);
        $this->widgets['content'][] = new Widget('common/list', $this->data);
        $this->render();
    }
        
    // {common}/view
    function view($id) {
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->data['object'] = $this->service->get($id);
        $view = $this->obj_type.'/view';
        if (file_exists(APPPATH.'views/'.$view.'.php')) {
            $this->widgets['content'][] = new Widget($view, $this->data);
        } else {
            $this->widgets['content'][] = new Widget('common/view', $this->data);
        }
        $this->render();
    }
    
    // {common}/new
    function add() {
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->data['columns'] = object2array($this->service->columns());
        $this->widgets['content'][] = new Widget('common/new', $this->data);
        $this->render();
    }
    
    // {common}/save
    function save() {
        // post $object
        $object = $this->input->post('obj');
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->service->save($object);
        
        $this->load->helper('url');
        redirect('/' . $this->obj_type . '/list');
    }
    
    // {common}/{id}/edit
    function edit($id) {
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->data['object'] = $this->service->get($id);
        $this->data['columns'] = object2array($this->service->columns());
        $this->widgets['content'][] = new Widget('common/edit', $this->data);
        $this->render();
    }
    
    // {common}/{id}/update
    function update($id) {
        // post $object
        $object = $this->post['obj'];
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->service->update($id, $object);
    }
    
    // {common}/{id}/delete
    function delete($id) {
        $this->load->service($this->obj_type . '_service', $this->obj_type, 'service');
        $this->service->remove($id);
        redirect($this->obj_type);
    }
    

}