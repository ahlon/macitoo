<?php
require_once dirname(__FILE__).'/Widget.php';
require_once dirname(__FILE__).'/Block.php';
require_once dirname(__FILE__).'/Renderable.php';

class Page extends Block {
    var $uri;
    var $content_type;

    var $ci;
    
    function __construct($config) {
        $this->content_type = $config['content_type'];
        $this->layout = $config['layout'];
        $this->widgets = $config['widgets'];
        $this->data = $config['data'];
    
        if (empty($this->layout)) {
            $this->layout = 'layouts/default';
        }
        $this->ci = &get_instance();
        $this->ci->load->library('parser');
    }
    
    function render() {
        switch ($this->content_type) {
        case 'json':
            header("Content-type:text/json;charset=utf-8");
            echo json_encode($this->data);
            return;
        case 'widgets':
            foreach ($this->widgets as $key=>$widget) {
                // widget: template, data
                $html = $this->ci->load->view($widget['template'], $widget['data'], TRUE);
                $html = '<section id="widget-'.$key.'" style="border:1px solid red">'.$html.'</section>';
                echo $html;
            }
            return;
        case 'layout':
            $this->ci->load->view($this->layout);
            return;
        default:
            $out_puts = array();
            foreach ($this->widgets as $key=>$val) {
                $html = '';
                if ($val instanceof Renderable) {
                    $renderer = $val;
                    $html = $renderer->render(TRUE);
                } else if (is_array($val)) {
                    foreach ($val as $sub_widget) {
                        if ($sub_widget instanceof Renderable) {
                            $renderer = $sub_widget;
                            $html .= $renderer->render(TRUE);
                        } else {
                            // error handle
                        }
                    }
                } else {
                    // error handle
                }
                $out_puts[$key] = $html;
            }
            $this->ci->parser->parse($this->layout, $out_puts);
            return;
        }
    }
    
//     function render_by_default($content_widgets) {
//         $widget = new Widget();
//         $widgets = array(
//             'header'=>$widget->get('header'),
//             'content'=>$content_widgets,
//             'footer'=>$widget->get('footer'),
//         );
//         $this->render('layout_1', $widgets);
//     }
    
//     function render_admin($content_widgets) {
//         $widget = new Widget();
//         $widgets = array(
//             'header'=>$widget->get('admin_header'),
//             'content'=>$content_widgets,
//             'footer'=>$widget->get('footer'),
//         );
//         $this->render('layout_1', $widgets);
//     }
}