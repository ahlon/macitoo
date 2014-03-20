<?php
require_once APPPATH. 'libraries/mute.php';
/**
 * @author ahlon
 */
class Trace_service extends Base_service {
    // 日志记录是否采取异步的方式, 值为true是采取异步的方式，否则同步的方式
    private $async = false;
    
    function __construct() {
        parent::__construct();
        $this->ci->load->library('user_agent');
        $this->ci->load->helper('user_helper');
    }
    
    /**
     * hook调用的入口
     */
    function log() {
        $this->ci->load->library('user_agent');
    
        // 爬虫访问不记录
        if ($this->ci->agent->is_robot || is_robot()) {
            return false;
        }
        
        // 服务器之间api调用不记录
        if (empty($this->ci->agent->agent)) {
            return false;
        }
        
        // 命令行的访问请求不记录日志
        if ($this->ci->input->is_cli_request()) {
            return false;
        }
        
        // ip 黑名单
        $this->ci->load->library('session');
        $user_ip = $this->ci->session->userdata('ip_address');
        if (in_array($user_ip, array('182.118.48.177'))) {
            return false;
        }
        
        if ($this->ci instanceof Mute) {
            $uri = $this->ci->uri->uri_string;
            log_message('debug', $uri.' not tracked');
            return;
        }
        
        // 没有继承Base_controller的不记录日志
//         if (!$this->ci instanceof Base_Controller) {
//             $uri = $this->ci->uri->uri_string;
//             log_message('debug', $uri.' not in the trace' );
//             return;
//         }
        
        $trace = $this->get_trace();
        
        if ($this->async) {
            // 异步写日志
            // $this->ci->load->service('queue_service');
            $id = $this->queue_service->add('trace_service', $trace, 'trace');
        } else {
            // 同步写日志
            $this->save($trace);
        }
        // print_r($this->ci->load->services);
    }
    
    /**
     * 后台JOB处理的入口
     * @link Queue_service
     */
    function perform() {
        // 异步处理
        $trace = $this->args;
        // 后台的Job会记录打印的输出信息
        print_r($trace);
        $this->save($trace);
    }
    
    /**
     * 返回用户的访问请求中产生的日志信息
     * @return multitype:unknown string NULL number
     */
    private function get_trace() {
        $this->ci->load->library('session');
        
        $trace = array();
        $trace['ccid'] = get_user_ccid();
        $trace['uid'] = get_user_id();
        $trace['url'] = $_SERVER['REQUEST_URI'];
        $trace['uri'] = $this->ci->uri->uri_string;
    
        $post = $this->ci->input->post();
        if (!empty($post)) {
            $trace['post_data'] = json_encode($post);
        }
    
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $trace['referer'] = $_SERVER['HTTP_REFERER'];
        }
    
        $trace['controller'] = $this->ci->router->class;
        $trace['method'] = $this->ci->router->method;
        $trace['time_cost'] = $this->get_elapsed_time();
    
        $trace['session_id'] = $this->ci->session->userdata('session_id');
        $trace['user_agent'] = $this->ci->agent->agent;
        $trace['platform'] = $this->ci->agent->platform;
        $trace['browser'] = $this->ci->agent->browser;
        $trace['version'] = $this->ci->agent->version;
        $trace['mobile'] = $this->ci->agent->mobile;
        $trace['client_ip'] = $this->ci->session->userdata('ip_address');
        $trace['server_ip'] = $_SERVER['SERVER_ADDR'];
        $trace['time'] = $time = date('Y-m-d H:i:s');
        return $trace;
    }
    
    private function get_elapsed_time() {
        $class = $this->ci->router->fetch_class();
        $method = $this->ci->router->fetch_method();
        $start_marker = 'controller_execution_time_( '.$class.' / '.$method.' )_start';
        $end_marker = 'controller_execution_time_( '.$class.' / '.$method.' )_end';
        return $this->ci->benchmark->elapsed_time($start_marker, $end_marker);
    }
    
    public function save($trace) {
        $exist = $this->trace_session_model->exist(array('id'=>$trace['session_id']));
        if (!$exist) {
            $trace_session = array(
                'id'=>$trace['session_id'],
                'user_agent'=>$trace['user_agent'],
                'platform'=>$trace['platform'],
                'browser'=>$trace['browser'],
                'version'=>$trace['version'],
                'mobile'=>$trace['mobile'],
                'client_ip'=>$trace['client_ip'],
                'server_ip'=>$trace['server_ip']
            );
            $this->trace_session_model->save($trace_session);
        }
        
        $trace_log = array(
            'ccid'=>$trace['ccid'],
            'uid'=>$trace['uid'],
            'url'=>$trace['url'],
            'uri'=>$trace['uri'],
            'controller'=>$trace['controller'],
            'method'=>$trace['method'],
            'session_id'=>$trace['session_id'],
            'time_cost'=>$trace['time_cost']
        );
        if (!empty($trace['post_data'])) {
            $trace_log['post_data'] = $trace['post_data'];
        }
        if (!empty($trace['referer'])) {
            $trace_log['referer'] = $trace['referer'];
        }
        $table_name = 'trace_logs_'.date('Ymd', strtotime($trace['time']));
        $this->trace_log_model->set_table_name($table_name);
        $this->trace_log_model->save($trace_log);
    }
    /**
     * 获取trace数据
     * @param unknown_type $conditions
     * @param unknown_type $time
     * @param unknown_type $page_size
     * @param unknown_type $page
     */
    function get_trace_data($conditions, $time, $page_size, $page){
        $reuslt = $this->trace_log_model->get_trace_data($conditions, $time, $page_size, $page);
        foreach ($reuslt as &$row) {
            if (!empty($row['uid'])) {
                $row['user'] = $this->user_model->load($row['uid']);
            }
        }
        return $reuslt;
    }
    /**
     * 获取数据记录条数
     * @param unknown_type $conditions
     * @param unknown_type $time
     * @param unknown_type $page_size
     * @param unknown_type $page
     */
    function get_trace_data_count($conditions,$time){
        return $this->trace_log_model->get_trace_data_count($conditions,$time);
    }
    /**
     * 获取ONE数据记录条数
     * @param unknown_type $conditions
     * @param unknown_type $time
     */
    function get_one_trace_data($conditions,$time){
        return $this->trace_log_model->get_one_trace_data($conditions,$time);
    }
    
    function get_latest_view_products($user_id, $count = 10) {
        $params = array('uid'=>$user_id, 'controller'=>'product3', 'method'=>'view');
        return $this->trace_log_model->find_all($params, 'id desc', $count, 1);
    }
}