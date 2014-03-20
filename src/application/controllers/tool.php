<?php
require_once dirname(__FILE__).'/auth.php';

class Tool extends Auth_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function shanbay() {
        $layout = 'layout_3';
        $this->widgets['header'] = new Widget('default/header', $this->data);
        $this->widgets['content'] = new Widget('tool/shanbay', $this->data);
        $this->render();
    }
    
    function gavatar($email = 'ahlon2002@gmail.com') {
        $this->load->helper('utils_helper');
        $url = get_gravatar_url($email);
        echo '<img src="'.$url.'"/>';
    }
    
    function services() {
        $path = dirname(__FILE__);
        $files = get_files($path);
        $result = array();
        foreach ($files as $file) {
            if (!end_with($file, '.php')) {
                continue;
            }
            if (in_array($file, array('base.php', 'cli.php', 'auth.php'))) {
                continue;
            }
            $pos = strpos($file, '.php');
            $fame = substr($file, 0, $pos);
    
            require_once $path.'/'.$file;
            $class = new ReflectionClass($fame);
            $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
            $list = array();
            foreach ($methods as $method) {
                if ($method->class == $class->getName() && !start_with($method->name, '_')) {
                    $list[] = $method->name;
                }
            }
            $result[$fame] = $list;
        }
        
        $this->widgets['content'] = new Widget('services', array('list'=>$result));
        $this->render();
    }
    
    function currency($usd) {
        print_r(currency('USD', 'CNY', $usd));
    }
    
    function import_zone() {
        $this->load->service('zone_service');
        $working_dir = getcwd();
        $file = fopen($working_dir.'/docs/zone.txt', 'r');
        $indent = array();
        $count = 0;
        while(!feof($file)) {
            $line = fgets($file);
            $line = trim($line);
            if (empty($line)) {
                continue;
            }
            $index = mb_substr_count($line, ' ');
            
            $last = end($indent);
            $key = key($indent);
            
            foreach ($indent as $k=>$item) {
                if ($k >= $index) {
                    unset($indent[$k]);
                }
            }
            
            $pieces = explode(' ', $line);
            $pieces = array_values(array_filter($pieces));
            $zone = array(
                'name'=>$pieces[1],
                'zipcode'=>$pieces[0]
            );
            if (!empty($indent)) {
                $parent = end($indent);
                if ($parent) {
                    $zone['parent_id'] = $parent['id'];
                }
            }
            $zone = $this->zone_service->save($zone);
            $indent[$index] = $zone;
            
            echo '<pre>';
            print_r($indent);
            echo '</pre>';
        }
        fclose($file);
    }
    
    
}