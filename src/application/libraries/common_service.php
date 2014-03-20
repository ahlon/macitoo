<?php
/**
 * CommonService包含通用CRUD的方法
 * @author ahlon
 */
class Common_service extends Base_service {
    
    function __construct($obj_type = 'common') {
        // 通过反射拿到模块的名字
        parent::__construct();
        // print_r($this);
        // echo __CLASS__;
        $mode_name = $obj_type.'_model';
        $this->model = $this->$mode_name;
    }
    
    /**
     * 保存
     * @param unknown_type $bo
     */
    function save($bo) {
        return $this->model->save($bo);
    }

    /**
     * 获取所有业务对象
     */
    function get_all() {
        return $this->model->find_all(array(), 'id');
    }
    
    /**
     * 根据id获取业务对象
     * @param unknown_type $id
     */
    function get($id) {
        return $this->model->load($id);
    }
    
    /**
     * 搜索业务对象
     */
    function search($params, $orderby, $page, $pagesize) {
        return $this->model->find_all($params, $orderby, $pagesize, $page);
    }
    
    /**
     * 获取查找的业务对象的数量
     * @param unknown_type $params
     */
    function count($params = array()) {
        return $this->model->count($params);
    }
    
    /**
     * 根据条件更新业务对象
     * @param unknown_type $parmas
     * @param unknown_type $kvs
     */
    function update($parmas, $kvs) {
        return $this->model->update($parmas, $kvs);
    }
    
    /**
     * 业务上的删除对象 
     * @param unknown_type $params
     */
    function remove($params) {
        return $this->model->delete($params);
    }
    
    /**
     * 获取业务对象的字段
     */
    function columns() {
        return $this->model->get_columns_meta();
    }
    
    function columns_for_add() {
        $colums = $this->columns();
        unset($colums['id']);
        unset($colums['created']);
        unset($colums['updated']);
        return $colums;
    }
    
    function columns_for_edit() {
        return $this->model->get_columns_meta();
    }
    
//     public function __get($name) {
//         if (isset($this->$name) && $this->$name instanceof Base_model) {
//             return $this->$name;
//         }
//         if ($name == 'model' && !empty($this->entity)) {
//             $name = $this->entity.'_model';
//         }
//         if (is_file($model_file = APPPATH . 'models/'.$name.'.php')) {
//             require_once ($model_file);
//             return $this->$name = new $name();
//         } else {
//             return $this->model = new Base_model($this->entity);
//         }
//     }
}