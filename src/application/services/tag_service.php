<?php
class Tag_service extends Base_service {
    
    function get_menus() {
        $params = array('taxonomy'=>'category');
        return $this->term_taxonomy_model->get_tags($params);
    }
    
//     function add_obj_tag($obj_type, $obj_id, $tag) {
        
//     }
    
//     function is_obj_tagged($obj_type, $obj_id, $tag) {
        
//     }

//     function get_obj_tags($obj_type, $obj_id) {
        
//     }
    
//     function rm_obj_tag($obj_type, $obj_id, $tag) {
        
//     }

//     function rm_obj_tags($obj_type, $obj_id) {
        
//     }

//     function get_objs_by_tag($tag, $page_size, $page) {
        
//     }
    
//     function rm_obj_tags_by_tag($tag) {
        
//     }
    
}