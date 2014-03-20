<?php
require_once dirname(__FILE__).'/../dao/SegmentDao.php';

class SegmentService {
    private $dao;
    
    public function __construct() {
        $this->dao = new SegmentDao();
    }
    
    function getAllSegments() {
        return $this->dao->getAll();
    }
}