<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__).'/Renderable.php';

class Widget implements Renderable {
    private $module;
    private $name;
    private $type; // header, footer
    
    private $template;
    private $data;
    
    private $ci;
    
    /**
     * create a new widget to be shown
     * @param unknown_type $_template
     * @param unknown_type $_data
     */
    function __construct($_template = null, $_data = null) {
        $this->template = $_template; 
        $this->data = $_data; 
        
        $this->ci = &get_instance();
    }
    
    /**
     * get widget configs from db
     * @param unknown_type $name
     * @param unknown_type $data
     * @return Widget
     */
    static function get_instance($id, $_data = null) {
        $ci = &get_instance();
        $ci->load->model('widget_model');
        $m = $ci->widget_model->load($id);
        
        if (!empty($_data)) {
            $data = array_merge($_data, json_decode($m['data'], true));
        } else {
            $data = json_decode($m['data'], true);
        }
        
        // @TODO config parmas
        
        return new Widget($m['template'], $data);
    }
    
    function get_config_data() {
        // implemented in sub class
        return false;
    }
    
    /**
     * render widget content
     * @see Renderable::render()
     */
    function render($return = FALSE) {
        $html = $this->ci->load->view($this->template, $this->data, $return);
        if ($return) {
            return $html;
        }
    }
}