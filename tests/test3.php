<?php
// http://book.douban.com/subject/4750586/
$douban_url = 'http://book.douban.com/subject/4750586/';
preg_match('/http:\/\/book.douban.com\/subject\/(\d+)\//', $douban_url, $matches);
print_r($matches);