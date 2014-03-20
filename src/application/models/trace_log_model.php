<?php
require_once dirname(__FILE__) . '/base_model.php';

class Trace_log_model extends Base_model {
    function __construct() {
        $this->db = $this->load->database('trace', true);
        $this->set_table_name();
    }
    
    function set_table_name($table_name = false) {
        if ($table_name) {
            $this->table_name = $table_name;
        } else {
            $this->table_name = 'trace_logs_'.date('Ymd', time());
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS `".$this->table_name."` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `ccid` varchar(50),
              `uid` int(11) DEFAULT NULL,
              `url` varchar(200) NOT NULL,
              `uri` varchar(100) NOT NULL,
              `controller` varchar(20) NOT NULL,
              `method` varchar(20) NOT NULL,
              `post_data` text,
              `referer` varchar(400) DEFAULT NULL,
              `session_id` varchar(100) NOT NULL,
              `time_cost` float NOT NULL,
              `created` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }
    
    function get_trace_data($conditions,$time,$page_size,$page){
        $time = str_replace('-', '', $time);
        $this->table_name = 'trace_logs_'.$time;
        $orderby = array('column'=>'id','sort'=>'desc');
        return $this->find_all($conditions,$orderby,$page_size,$page);
    }
    function get_trace_data_count($conditions,$time){
        $time = str_replace('-', '', $time);
        $this->table_name = 'trace_logs_'.$time;
        return $this->count($conditions);
    }
    function get_one_trace_data($conditions,$time){
        $time = str_replace('-', '', $time);
        $this->table_name = 'trace_logs_'.$time;
        return $this->find_one($conditions);
    }
}