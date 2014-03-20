<?php
/**
 * @author ahlon
 */

/**
 * @param unknown_type $oldtime
 * @return string
 */
function nice_time($oldtime) {
    $now = time();
    $time_length = $now - $oldtime;
    $str = "<span title='" . date("Y-m-d H:i:s", $oldtime) . "'>";
    if ($time_length < 60) {
        // $str .= "刚刚";
        $str .= $time_length . "秒前";
    } elseif ($time_length < 60 * 60) {
        $str .= floor($time_length / 60) . "分钟前";
    } elseif ($time_length < 60 * 60 * 24) {
        $str .= floor($time_length / (60 * 60)) . "小时前";
    } elseif ($time_length < $now - strtotime('yesterday')) {
        $str .= "昨天";
    } elseif ($time_length < $now - strtotime("-1 day", strtotime('yesterday'))) {
        $str .= "前天";
    } else {
        $str .= date("Y-m-d", $oldtime);
    }
    $str .= "</span>";
    return $str;
}

function start_with($haystack, $needle) {
    return !strncmp($haystack, $needle, strlen($needle));
}

function end_with($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}

function is_robot() {
    if (empty($_SERVER ['HTTP_USER_AGENT']) || strlen($_SERVER ['HTTP_USER_AGENT'])<20) {
        return true;
    }
    $userAgent = strtolower ( $_SERVER ['HTTP_USER_AGENT'] );
    $spiders = array ('spider','crawler','bot','huaweisymantecspider','etaospider', 'youdaobot', 'wordpress', 'googlebot', 'baiduspider', 'bingbot', 'yandexbot', 'sina_robot', 'iaskspider', 'sogou', 'yahoo', 'sosoimagespider', 'sosospider', 'yodaobot', 'msnbot', 'yeti', 'qihoobot','larbin','java','commons-httpclient', 'wget', 'php', 'ruby', 'python' );
    foreach ( $spiders as $spider ) {
        $spider = strtolower ( $spider );
        if (strpos ( $userAgent, $spider ) !== false) {
            return true;
        }
    }
    return false;
}

function get_cur_page_url() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function get_pager_url($base_uri, $params, $page) {
    $params['p'] = $page;
    return '/' . $base_uri . '?' . http_build_query($params);
}

function get_url_page_content($url) {
    $output_type = "html";
    $handle = curl_init();
    curl_setopt_array($handle, array(CURLOPT_USERAGENT => "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0)", CURLOPT_FOLLOWLOCATION => true, CURLOPT_HEADER => false, CURLOPT_HTTPGET => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 30, CURLOPT_URL => $url));
    
    $source = curl_exec($handle);
    curl_close($handle);
    
    preg_match("/charset=([\w|\-]+);?/", $source, $match);
    $charset = isset($match[1]) ? $match[1] : 'utf-8';
    
    require_once dirname(__FILE__) . '/../libraries/Readability.inc.php';
    $readability = new Readability($source, $charset);
    $data = $readability->getContent();
    
    //     switch($output_type) {
    //         case 'json':
    //             header("Content-type: text/json;charset=utf-8");
    //             $Data['url'] = $url;
    //             echo json_encode($Data);
    //             break;
    //         case 'html': default:
    //             header("Content-type: text/html;charset=utf-8");
    //             $title   = $data['title'];
    //             $content = $data['content'];
    //             include 'reader.html';
    //     }
    return $data;
}

function get_gravatar_url($email, $size = '20', $default = '', $rating = 'G') {
    return 'http://www.gravatar.com/avatar/' . md5($email) . '?s=' . $size . '&d=' . $default . '&r=' . $rating . '" alt="" width="' . $size . 'px" height="' . $size . 'px';
}

function get_files($dir) {
    $fileArray = array();
    if (false != ($handle = opendir($dir))) {
        $i = 0;
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && strpos($file, ".")) {
                $fileArray[$i] = $file;
                if ($i == 100) {
                    break;
                }
                $i++;
            }
        }
        closedir($handle);
    }
    return $fileArray;
}

function array2object($array) {
    if (is_array($array)) {
        $obj = new StdClass();

        foreach ($array as $key => $val){
            $obj->$key = $val;
        }
    }
    else { $obj = $array;
    }

    return $obj;
}

function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
}

function currency($from_Currency,$to_Currency,$amount) {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
    $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('"', $rawdata);
    $data = explode(' ', $data['3']);
    $var = $data['0'];
    return round($var,2);
}