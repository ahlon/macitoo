<?php
/**
 * @author ahlon
 */
class Model_proxy {
    var $model;
    var $name;
    var $call_stacks;
    
    function __construct($model_name, $table = false) {
        $this->name = $model_name;
        if (is_file($model_file = APPPATH . 'models/' . $model_name . '.php')) {
            log_message('info', 'load model '.$model_name.', by lazy load');
            require_once ($model_file);
            if ($table) {
                return $this->model = new $model_name($table);
            } else {
                return $this->model = new $model_name();
            }
        }
        $this->call_stacks = array();
    }
    
    function __call($method, $args) {
        $msg = $this->model->level.':'.$this->name.'->'.$method.json_encode($args);
        log_message('debug', $msg);
        $this->call_stacks[] = $msg;
        // echo str_repeat('&nbsp;', $this->model->level * 8).$msg.'<br/>';
        $this->_before_model();
        $return = call_user_func_array(array($this->model, $method), $args);
        $this->_after_model();
        return $return;
    }
    
    function set_level($level) {
        $this->model->level = $level;
    }
    
    function _before_model() {
        // do something
    }
    
    function _after_model() {
        // do something
    }
}