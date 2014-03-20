<?php
require_once dirname(__FILE__).'/../auth.php';
require_once APPPATH. 'libraries/mute.php';

class Douban extends Auth_Controller implements Mute {
    private $do_count;
    private $wish_count;
    private $collect_count;
    
    function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
        $this->load->model('url_content_model');
        $this->load->model('book_model');
        $this->load->model('rd_status_model');
        $this->load->library('simple_html_dom');
    }
    
    function sync_all($douban_id = '') {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $settings = $this->setting_model->get_user_settings($user_id);
            if (!empty($settings['douban_id'])) {
                $this->sync($settings['douban_id'], 'do');
                $this->sync($settings['douban_id'], 'wish');
                $this->sync($settings['douban_id'], 'collect');
            }
        } else if ($douban_id) {
            $this->sync($douban_id, 'do');
            $this->sync($douban_id, 'wish');
            $this->sync($douban_id, 'collect');
        }
    }
    
    function sync_do($douban_id = '') {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $settings = $this->setting_model->get_user_settings($user_id);
            if (!empty($settings['douban_id'])) {
                $this->sync($settings['douban_id'], 'do');
            }
        } else if ($douban_id) {
            $this->sync($douban_id, 'do');
        }
    }
    
    function sync_wish($douban_id = '') {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $settings = $this->setting_model->get_user_settings($user_id);
            if (!empty($settings['douban_id'])) {
                $this->sync($settings['douban_id'], 'wish');
            }
        } else if ($douban_id) {
            $this->sync($douban_id, 'wish');
        }
    }
    
    function sync_collect($douban_id = '') {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $settings = $this->setting_model->get_user_settings($user_id);
            if (!empty($settings['douban_id'])) {
                $this->sync($settings['douban_id'], 'collect');
            }
        } else if ($douban_id) {
            $this->sync($douban_id, 'collect');
        }
    }
    
    private function sync($douban_id, $rd_satus) {
        $user_id = $this->session->userdata('user_id');
        $base_url = 'http://book.douban.com/people/'.$douban_id.'/'.$rd_satus.'?start=';
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
            $douban_url = $base_url.$start;
            $html = file_get_html($douban_url);
            // echo "\n";
            $url_content = array('url'=>$douban_url, 'type'=>'list', 'content'=>$html->__toString());
            try {
                // 保存网页
                echo 'save page: '.$douban_url."...";
                $key = array('url'=>$douban_url);
                $db_url_content = $this->url_content_model->find_one($key);
                if ($db_url_content) {
                    $this->url_content_model->update($key, $url_content);
                } else {
                    $this->url_content_model->save($url_content);
                }
                echo "\n";
                
                // 分析网页，保存书的信息
                echo "save books...";
                $books = $this->save_books($douban_url);
                echo "\n";
                // 建立用户与书的读的状态关系
                echo "save user reading status...";
                foreach ($books as $book) {
                    $user_id = $user_id ? $user_id : 1;
                    $this->rd_status_model->save_or_update_user_reading_status($user_id, $book['id'], $rd_satus);
                }
                echo "\n";
            } catch (Exception $e) {
                print_r($e);
            }
            $start += 15;
        }
    }
    
    private function save_books($douban_url) {
        $url_content = $this->url_content_model->find_one(array('url'=>$douban_url));
        $html = str_get_html($url_content['content']);
        $books = array();
        foreach ($html->find('.subject-item') as $item) {
            $h2s = $item->find('div.info h2');
            $title = trim(strip_tags($h2s[0]));
    
            $pubs = $item->find('div.pub');
            $pubs = explode(' / ', trim($pubs[0]->text()));
            $author = $pubs[0]; // @FIXME
            $press = $pubs[1];
    
            $imgs = $item->find('img');
            $image = $imgs[0]->src;
    
            $as = $item->find('div.pic a.nbg');
            // http://book.douban.com/subject/4750586/
            $douban_url = $as[0]->href;
            preg_match('/http:\/\/book.douban.com\/subject\/(\d+)\//', $douban_url, $matches);
            $book = array(
                'title'=>$title,
                'author'=>$author,
                'press'=>$press,
                'image'=>$image,
                'douban_id'=>$matches[1],
                'douban_url'=>$douban_url
            );
            if ($douban_url) {
                $key = array('douban_url'=>$douban_url);
                $db_book = $this->book_model->find_one($key);
                if ($db_book) {
                    $this->book_model->update($key, $book);
                    $books[] = $this->book_model->find_one($key);
                } else {
                    $this->book_model->save($book);
                    $books[] = $book;
                }
            } else {
                // $books[] = $this->book_model->save($book);
            }
        }
        return $books;
    }
    
    function sync_books() {
        $pagesize = 100;
        $page = 1;
        do {
            $books = $this->book_model->list_books($pagesize, $page++);
            $count = count($books);
            foreach ($books as $book) {
                $this->sync_book($book['id']);
            }
        } while ($count == $pagesize);
    }
    
    function sync_book($id) {
        $book = $this->book_model->load($id);
        $html = file_get_html($book['douban_url']);
        $url_content = array('url'=>$book['douban_url'], 'type'=>'item', 'content'=>$html->__toString());
        $this->url_content_model->save_or_update($url_content);
    }
    
    function get_book_from_douban($id) {
        $book = $this->book_model->load($id);
        return $this->get_douban_book_info($book['douban_url']);
    }
    
    function get_douban_book_info($douban_url) {
        // http://api.douban.com/book/subject/1031741
        // https://api.douban.com/v2/book/10570587
        $url_content = $this->url_content_model->find_one(array('url'=>$douban_url));
        $html = str_get_html($url_content['content']);
        $infos = $html->find('#info');
        print_r($infos[0]->__toString());
    }
    
    function test() {
        echo 'hello';
        sleep(2);
        echo 'world';
    }
    
}