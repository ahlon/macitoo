<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_layout {
    private $ci, $controller, $tplpath, $layout;
    
    function __construct($_controller) {
        $this->ci = &get_instance();
        $this->tplpath = APPPATH . 'layouts/';
        $this->ci->load->library('parser');
        // $this->layout = $this->tplpath.$layout.'.php';
    }
    
    function render($layout, $widgets, $data) {
        $this->layout = 'layouts/'.$layout;// $this->tplpath.$layout.'.php';
        switch ($this->ci->url_suffix) {
            case 'data':
                header("Content-type:text/html;charset=utf-8");
                echo json_encode($data);
                return;
            case 'widgets':
                foreach ($widgets as $key=>$widget) {
                    // widget: template, data
                    $html = $this->ci->load->view($widget['template'], $widget['data'], TRUE);
                    $html = '<section id="widget-'.$key.'" style="border:1px solid red">'.$html.'</section>';
                    echo $html;
                }
                return;
            case 'layout':
                echo $this->layout;
                return;
            default:
                $out_puts = array();
                foreach ($widgets as $key=>$sub_widgets) {
                    // widget: template, data
                    $html = '';
                    if (empty($sub_widgets['template'])) {
                        foreach ($sub_widgets as $sub_widget) {
                            $html .= $this->ci->load->view($sub_widget['template'], @$sub_widget['data'], TRUE);
                        }
                    } else {
                        $widget = $sub_widgets;
                        $html = $this->ci->load->view($widget['template'], @$widget['data'], TRUE);
                    }
                    $out_puts[$key] = $html;
                }
                $this->ci->parser->parse($this->layout, $out_puts);
                return;
        }
    }
}