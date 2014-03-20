<?php
/**
 * @author ahlon
 */
class Service_proxy {
    public $service;
    var $name;
    var $call_stacks;
    
    function __construct($service_name, $params = false) {
        // $service_name = $name.'_service';
        $this->name = $service_name;
        $this->call_stacks = array();
        
        if (is_file($service_file = APPPATH . '/services/' . $service_name . '.php')) {
            log_message('info', 'load service '.$service_name.', by lazy load');
            require_once ($service_file);
            if ($params) {
                $this->service = new $service_name($params);
            } else {
                $this->service = new $service_name();
            }
            return $this->service;
        } else {
            log_message('error', $service_name.' not loaded, pls have a check');
        }
    }
    
    function set_level($level) {
        $this->service->level = $level;
    }
    
    function __call($method, $args) {
        $msg = $this->service->level.':'.$this->name.'->'.$method.json_encode($args);
        log_message('debug', $msg);
        $this->call_stacks[] = $msg;
//         echo str_repeat('&nbsp;', $this->service->level * 4).$msg.'<br/>';
        
        $this->_before_service();
        if ($this->is_cache_configed($this->name, $method)) {
            $key = 'service:'.$this->name.':'.$method.':'.json_encode($args);
            // echo $key;
            $CI = &get_instance();
            $CI->load->driver('cache', array('adapter' => 'redis'));
            $r = $CI->cache->get($key);
            if (empty($r)) {
                // echo $key.'save to cache';
                $return = call_user_func_array(array($this->service, $method), $args);
                $CI->cache->save($key, json_encode($return), 300);
            } else {
                // echo $key.'load from cache';
                $return = json_decode($r, true);
            }
        } else {
            $return = call_user_func_array(array($this->service, $method), $args);
        }
        $this->_after_service();
        return $return;
    }
    
    private function is_cache_configed($service, $method) {
        $CI = &get_instance();
        $CI->config->load('cache', TRUE);
        $services = $CI->config->item('service', 'cache');
        if (!empty($services[$service])) {
            return in_array($method, $services[$service]);
        } else {
            return false;
        }
    }
    
    function _before_service() {
        // do something
    }
    
    function _after_service() {
        // do something
    }
    
}