<?php
require_once dirname(__FILE__).'/base.php';

class Test extends Base_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('url_content_model');
        $this->load->model('book_model');
        $this->load->library('simple_html_dom');
    }
    
    function modal() {
        $this->widgets['content'] = new Widget('test/test-modal', $this->data);
        $this->render();
    }
    
    function modal_dialog() {
        $this->load->view('common/modal');
//         $this->widgets['content'] = new Widget('common/modal', $this->data);
//         $this->render();
    }
    
    function test1($args = 'ahlon') {
        $douban_name = $args;
        
        $start = 0;
        $url = 'http://book.douban.com/people/ahlon/do?start=';
        echo 'get '.$url.$start;
        $html = file_get_html($url.$start);
        echo "\n";
        
        $array = $html->find('.subject-num');
        $r = explode('&nbsp;/&nbsp;', $array[0]->text());
        $do_count = intval($r[1]);
        
        while($start < $do_count) {
            echo 'get '.$url.$start;
            $html = file_get_html($url.$start);
            echo "\n";
            $url_content = array('url'=>$url.$start, 'content'=>$html->__toString());
            try {
                $this->url_content_model->save($url_content);
            } catch (Exception $e) {
                print_r($e);
            }
            $start += 15;
        }
        
        $start = 0;
        $url = 'http://book.douban.com/people/ahlon/wish?start=';
        echo 'get '.$url.$start;
        $html = file_get_html($url.$start);
        echo "\n";
        
        $array = $html->find('.subject-num');
        $r = explode('&nbsp;/&nbsp;', $array[0]->text());
        $do_count = intval($r[1]);
        
        while($start < $do_count) {
            echo 'get '.$url.$start;
            $html = file_get_html($url.$start);
            echo "\n";
            $url_content = array('url'=>$url.$start, 'content'=>$html->__toString());
            try {
                $this->url_content_model->save($url_content);
            } catch (Exception $e) {
                print_r($e);
            }
            $start += 15;
        }
        
        $start = 0;
        $url = 'http://book.douban.com/people/ahlon/collect?start=';
        echo 'get '.$url.$start;
        $html = file_get_html($url.$start);
        echo "\n";
        
        $array = $html->find('.subject-num');
        $r = explode('&nbsp;/&nbsp;', $array[0]->text());
        $do_count = intval($r[1]);
        
        while($start < $do_count) {
            echo 'get '.$url.$start;
            $html = file_get_html($url.$start);
            echo "\n";
            $url_content = array('url'=>$url.$start, 'type'=>'list', 'content'=>$html->__toString());
            try {
                $this->url_content_model->save($url_content);
            } catch (Exception $e) {
                print_r($e);
            }
            $start += 15;
        }
    }
    
    function test2($page = 1) {
        $url_content = $this->url_content_model->load($page);
        $html = str_get_html($url_content['content']);
        foreach ($html->find('.subject-item') as $item) {
            $h2s = $item->find('div.info h2');
            $title = trim(strip_tags($h2s[0]));
            
            $pubs = $item->find('div.pub');
            $pubs = explode(' / ', trim($pubs[0]->text()));
            $author = $pubs[0];
            $press = $pubs[1];
            
            $imgs = $item->find('img');
            $image = $imgs[0]->src;
            
            $as = $item->find('div.pic a.nbg');
            $douban_url = $as[0]->href;
            
            $book = array(
                'title'=>$title,
                'author'=>$author,
                'press'=>$press,
                'image'=>$image,
                'douban_url'=>$douban_url
            );
            $this->book_model->save($book);
        }
    }
    
    function test3() {
        $this->load->library('doctrine');
        $em = $this->doctrine->em;

        // $this->load->model('entities/userbean');
        require_once dirname(__FILE__).'/../models/Userbean.php';

        $user = new UserBean();
        $user->setId(0);
        $user->setEmail('ahlon2002@163.com');
        
        $em->persist($user);
    }
    
    function test4() {
        $this->load->helper('utils');
        $r = get_url_page_content('http://lixiaolai.com/fly-mode-vs-bee-mode');
        print_r($r);
    }
    
    function test5() {
        $this->load->service('user_service');
        print_r($this->user_service->get(1));
    }
    
    function test6() {
        function increment($value,$amount = 1) {
            $value = $value + $amount;
        }
        $a = 10;
        echo $a;
        increment ($a);
        echo $a;
    }
    
    function readability() {
        // $url = 'http://www.medialens.org/index.php/alerts/alert-archive/alerts-2013/729-thatcher.html';
        $url = 'http://www.csdn.net/article/2013-12-10/2817692-mobile-develop-interviewi-qiniu';
        $html = file_get_contents($url);
        
        // Note: PHP Readability expects UTF-8 encoded content.
        // If your content is not UTF-8 encoded, convert it
        // first before passing it to PHP Readability.
        // Both iconv() and mb_convert_encoding() can do this.
        
        // If we've got Tidy, let's clean up input.
        // This step is highly recommended - PHP's default HTML parser
        // often doesn't do a great job and results in strange output.
        if (function_exists('tidy_parse_string')) {
            $tidy = tidy_parse_string($html, array(), 'UTF8');
            $tidy->cleanRepair();
            $html = $tidy->value;
        }
        
        // give it to Readability
        $readability = new Readability($html, $url);
        // print debug output?
        // useful to compare against Arc90's original JS version -
        // simply click the bookmarklet with FireBug's console window open
        $readability->debug = false;
        // convert links to footnotes?
        $readability->convertLinksToFootnotes = true;
        // process it
        $result = $readability->init();
        // does it look like we found what we wanted?
        if ($result) {
            echo "== Title =====================================\n";
            echo $readability->getTitle()->textContent, "\n\n";
            echo "== Body ======================================\n";
            $content = $readability->getContent()->innerHTML;
            // if we've got Tidy, let's clean it up for output
            if (function_exists('tidy_parse_string')) {
                $tidy = tidy_parse_string($content, array('indent'=>true, 'show-body-only' => true), 'UTF8');
                $tidy->cleanRepair();
                $content = $tidy->value;
            }
            echo $content;
        } else {
            echo 'Looks like we couldn\'t find the content. :(';
        }
    }
}