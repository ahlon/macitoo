<?php
class DoubanClient {
    const TOKEN_KEY = '';
    const TOKEN_SECRET = '';
    
    public function __construct() {
        // $this->_client->programmaticLogin(self::TOKEN_KEY, self::TOKEN_SECRET);
    }
    
    function oauth() {
        $api_url = 'https://www.douban.com/service/auth2/auth?client_id=0851c73444e810ed18f5559cceb832c7&redirect_uri=http://macitoo.sinaapp.com/oauth/douban_call_back.php&response_type=code&scope=shuo_basic_r,shuo_basic_w';
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $api_url);
        // curl_setopt($ch2, CURLOPT_POST, 1);
        // curl_setopt($ch2, CURLOPT_POSTFIELDS, $postfield);
        curl_setopt($ch2, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        // curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); //设定是否显示头信息
        curl_setopt($ch2, CURLOPT_HEADER, true); //设定是否输出页面内容
        $document = curl_exec($ch2);
        curl_close($ch2);
        echo $document;
    }
}

$client = new DoubanClient();
$client->oauth();