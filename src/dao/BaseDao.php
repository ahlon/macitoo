<?php
require_once dirname(__FILE__).'/../config.php';

class BaseDao {
    protected $db;
    
    public function __construct() {
        if (!isset($GLOBALS['db'])) {
            $this->db = new PDO('mysql:host='.MYSQL_HOST. ';port='.MYSQL_PORT . ';dbname='.MYSQL_DB.';charset=UTF8',
                    MYSQL_USER, MYSQL_PASSWORD, array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true)); // Pdo-Mysql长连接
            $this->db->exec("SET NAMES 'utf8'");
            $GLOBALS['db'] = $this->db;
        } else {
            $this->db = $GLOBALS['db'];
        }
    }
    

}

