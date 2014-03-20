<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/BaseDao.php';

class SegmentDao extends BaseDao {
    function getAll() {
        $sql = "select * from segments order by created_time desc";
        $exe = $this->db->prepare($sql);
        $exe->execute();
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>