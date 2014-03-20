<?php
require_once dirname(__FILE__).'/../application/libraries/simple_html_dom.php';
require_once dirname(__FILE__).'/../application/models/url_content_model.php';

class Douban_client {
    protected $url_content_model;
    
    public function __construct() {
        $this->url_content_model = new Url_content_model();
    }
    
    
    function sync_douban_id_reading_status($douban_id, $rd_satus) {
        $base_url = 'http://book.douban.com/people/'.$douban_id.'/do?start=';
        $start = 0;
        // echo 'get '.$base_url.$start;
        $html = file_get_html($base_url.$start);
        // echo "\n";
        
        $array = $html->find('.subject-num');
        $r = explode('&nbsp;/&nbsp;', $array[0]->text());
        $do_count = intval($r[1]);
        echo $douban_id.' '.$rd_satus.' total:'.$do_count;
        
        while($start < $do_count) {
            // echo 'get '.$base_url.$start;
            $html = file_get_html($base_url.$start);
            // echo "\n";
            $url_content = array('url'=>$base_url.$start, 'content'=>$html->__toString());
            try {
                $this->url_content_model->save($url_content);
            } catch (Exception $e) {
                print_r($e);
            }
            $start += 15;
        }
    }
}

$client = new Douban_client();
$client->sync_douban_id_reading_status('ahlon', 'do');