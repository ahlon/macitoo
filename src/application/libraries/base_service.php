<?php
require_once APPPATH.'libraries/service_proxy.php';
require_once APPPATH.'libraries/manager_proxy.php';
require_once APPPATH.'libraries/model_proxy.php';

class Base_service {
    private $model;
    private $entity;
    
    protected $ci;

    private $models;
    
    public function __construct($model = false) {
        $this->ci = &get_instance();
        $this->ci->load->helper("utils_helper");
        if (!empty($model)) {
            $this->model = $model;
        } else {
            $this->model = $this->base_model;
        }
    }
    
    public function __get($name) {
        if (end_with($name, '_model')) {
            $this->models[] = $name;
        }
        if (end_with($name, '_manager')) {
            $this->managers[] = $name;
        }
        if (end_with($name, '_service')) {
            $this->services[] = $name;
        }
    
        if (end_with($name, '_model')) {
            if (is_file($model_file = APPPATH . 'models/' . $name . '.php')) {
                $proxy = new Model_proxy($name);
                $proxy->set_level($this->level + 1);
                return $this->$name = $proxy;
            } else {
                $table = substr($name, 0, -6);
                $proxy = new Model_proxy('base_model', $table);
                $proxy->set_level($this->level + 1);
                return $this->$name = $proxy;
            }
        }
    
        if (end_with($name, '_manager') && is_file($manager_file = APPPATH . 'managers/' . $name . '.php')) {
            //             require_once ($manager_file);
            //             return $this->$name = new $name();
            $proxy = new Manager_proxy($name);
            $proxy->set_level($this->level + 1);
            return $this->$name = $proxy;
        }
    
        if (end_with($name, '_service') && is_file($service_file = APPPATH . 'services/' . $name . '.php')) {
            // $service = substr($name, 0, -8);
            $proxy = new Service_proxy($name);
            $proxy->set_level($this->level + 1);
            return $this->$name = $proxy;
        }
        $class = get_class($this);
        log_message('error', $name.' not found in service['.$class.'], pls check the code');
    }

    function save($bo) {
        return $this->model->save($bo);
    }
    
    function get($id) {
        return $this->model->load($id);
    }
    
    function get_all() {
        return $this->model->find_all(array(), 'id');
    }
    
    function search($params, $orderby, $pagesize, $page) {
        return $this->model->find_all($params, $orderby, $pagesize, $page);
    }

    function count($params) {
        return $this->model->count($params);
    }
    
    function update($parmas, $kvs) {
        return $this->model->update($parmas, $kvs);
    }
    
    function remove($params) {
        return $this->model->remove($params);
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