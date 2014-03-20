<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/service_proxy.php';
/**
 * Loader Class
 * Loads views and files
 * @author ahlon
 */
class MC_Loader extends CI_Loader {
    public function __construct() {
        parent::__construct();
        log_message('debug', "FM_Loader Class Initialized");
    }
    
    public function service($service = '', $params = NULL, $object_name = NULL) {
//         $prefix = 'services/';
//         parent::library($prefix.$service);
        $service_proxy = new Service_proxy($service, $params);
        if (!$service_proxy->service) {
            $service_proxy = new Service_proxy('common_service', $params);
        }
        $service_proxy->set_level(1);
        $CI =& get_instance();
        if (!empty($object_name)) {
            $CI->$object_name = $service_proxy;
        } else {
            $CI->$service = $service_proxy;
        }
        $this->services[] = $service_proxy;
    }
    
    public function manager($manager = '', $params = NULL, $object_name = NULL) {
        $prefix = 'managers/';
        parent::library($prefix.$manager);
    }
    
}