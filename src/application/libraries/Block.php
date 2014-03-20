<?php
require_once dirname(__FILE__).'/Renderable.php';

class Block implements Renderable {
    var $layout;
    var $widgets;
    
    function render($return = FALSE) {
        $out_puts = array();
        foreach ($this->widgets as $key=>$val) {
            $html = '';
            if ($val instanceof Widget) {
                $widget = $val;
                $html = $widget->render(TRUE);
            } else if ($val instanceof Block) {
                $block = $val;
                $html = $block->render(TRUE);
            } else if (is_array($val)) {
                foreach ($val as $sub_widget) {
                    if ($sub_widget instanceof Widget) {
                        $widget = $val;
                        $html .= $widget->render(TRUE);
                    } else if ($sub_widget instanceof Block) {
                        $block = $val;
                        $html .= $block->render(TRUE);
                    } else {
                        // error handle
                    }
                }
                $out_puts[$key] = $html;
            } else {
                // error handle
            }
        }
        $r = $this->ci->parser->parse($this->layout, $out_puts, $return);
        if ($return) {
            return $r;
        }
    }
}