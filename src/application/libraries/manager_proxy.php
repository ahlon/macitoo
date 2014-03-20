<?php
/**
 * @author ahlon
 */
class Manager_proxy {
    var $manager;
    var $name;
    var $call_stacks;
    
    function __construct($manager_name) {
        $this->name = $manager_name;
        if (is_file($model_file = APPPATH . 'managers/' . $manager_name . '.php')) {
            log_message('info', 'load model '.$manager_name.', by lazy load');
            require_once ($model_file);
            return $this->manager = new $manager_name();
        }
        $this->call_stacks = array();
    }
    
    function __call($method, $args) {
        $msg = $this->manager->level.':'.$this->name.'->'.$method.json_encode($args);
        log_message('debug', $msg);
        $this->call_stacks[] = $msg;
        // echo str_repeat('&nbsp;', $this->model->level * 8).$msg.'<br/>';

        $return = call_user_func_array(array($this->manager, $method), $args);
        
        return $return;
    }
    
    function set_level($level) {
        $this->manager->level = $level;
    }
    
}