<?php
/**
 * most of the methods are moved from i_user
 * must load utils_helper at same time
 */
//设置根域名，其他子站点也要做相同的设置，保证$_COOKIE['PHPSESSID']相等 即拥有相等的钥匙
// ini_set('session.cookie_domain', ROOT_DOMAIN);
function start_session() {
    if (!session_id()) {
        @session_start();
    }
}
/*
 * 判断用户是否登录
 */
function is_authed() {
    start_session();
	return isset($_SESSION['fmur']);
}

function is_level($level) {
    start_session();
    if(isset($_SESSION['level'])){
        return isset($_SESSION['fmur']) && $_SESSION['level']>=$level;
    }
}

function is_action_level(){
    return is_level(10);
}

function is_userinfo_level(){
    return is_level(100);
}

function is_admin() {
    start_session();
    if( !empty($_SESSION ['fmur']['groups']) ) {
        $groups = $_SESSION ['fmur']['groups'];
        $group_names = columns_in_array($groups, 'name');
        return in_array('admin', $group_names);
    }
    return false;
}

function get_admin() {
    return is_admin() ? get_user_profile() : false;
}

/*
 * 获取登录用户的ID
 * 未登录返回false
 */
function get_user_id() {
    start_session();
    return isset($_SESSION['fmur']['id']) ? $_SESSION['fmur']['id'] : false;
}

/**
 * 获取登录用户的promonter_id
 * @return bool
 */
function get_promonter_id() {
    start_session();
    return isset($_SESSION['promonter_id']) ? $_SESSION['promonter_id'] : false;
}

function set_promonter_id($promonter_id){
    start_session();
    $_SESSION['promonter_id'] = $promonter_id;
}

/*
 * 获取用户的ccid
 * 未登录返回false
 */
function get_user_ccid() {
    start_session();
	return isset($_COOKIE['ccid']) ? $_COOKIE['ccid'] : false;
}

/*
 * 获取登录用户显示名称
 * 未登录返回false
 */
function get_dispaly_name() {
    start_session();
    return isset($_SESSION['fmur']) ? $_SESSION['fmur']['display_name'] : false;
}

/*
 * 获取用户网络头像的url
 */
function get_avatar_url() {
    start_session();
    return isset($_SESSION['fmur']) ? $_SESSION['fmur']['avatar_url'] : false;
}

function get_user_profile() {
    start_session();
    return isset($_SESSION['fmur']) ? $_SESSION['fmur'] : false;
}

//下面两个方法在user_service, user_model 有定义，应该整理
function get_userpage_url($uid) {
    // $user_page = 'user/'.$uid;
    $guid = generate_guid($uid);
    $user_page = '/u/' . $guid;
    return $user_page;
}
function generate_guid($id) {
    $id = 1026895 + intval($id);
    $bit9 = base_convert($id, 10, 9);
    $bit9_len = strlen($bit9);
    if ($bit9 & 1) {
        $check_num = substr($bit9, $bit9_len - 1);
    } else {
        $check_num = substr($bit9, $bit9_len - 2, 1);
    }
    $stringid = ((string)$id) . $check_num;
    return (int)$stringid;
}


function set_mcrypt_cookie($key,$data,$expire){
    $data = $key.'|'.$data;
    $mcrypt_key = '\!4~sdd+';
    $cipher = MCRYPT_DES;
    $modes = MCRYPT_MODE_ECB;
    $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher,$modes),MCRYPT_RAND);
    $str_encrypt = mcrypt_encrypt($cipher,$mcrypt_key,$data,$modes,$iv);
    $domain = get_root_domain();
    if($domain===false){
        setcookie($key, $str_encrypt, $expire, '/');
    }else{
        setcookie($key, $str_encrypt, $expire, '/', $domain);
    }
}

function get_mcrypt_cookie($key){
    $data = false;
    $mcrypt_key = '\!4~sdd+';
    if (isset($_COOKIE[$key]) && !empty($_COOKIE[$key])) {
        $cipher = MCRYPT_DES;
        $modes = MCRYPT_MODE_ECB;
        $iv_size = mcrypt_get_iv_size($cipher,$modes);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $str_encrypt = $_COOKIE[$key];
        $str_data = mcrypt_decrypt($cipher,$mcrypt_key,$str_encrypt,$modes,$iv);
        $arr_data = explode('|',$str_data);
        if(count($arr_data)==2){
            $data = $arr_data[1];
        }
    }
    return $data;
}
