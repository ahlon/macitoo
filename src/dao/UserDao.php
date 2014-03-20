<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/BaseDao.php';

class UserDao extends BaseDao {

//    public function __construct() {
//         $this->db = new PDO('mysql:host='.MYSQL_HOST. ';port='.MYSQL_PORT . ';dbname='.MYSQL_DB.';charset=UTF8',
//             MYSQL_USER, MYSQL_PASSWORD);
// 	    $this->db->exec("SET NAMES 'utf8'");
//    }
    
    function insertUser($email, $display_name, $password) {
        $sql = "insert into cr_users(email, display_name, password) values(:email, :display_name, :password)";
        $exe = $this->db->prepare($sql);
        //var_dump($exe);
        echo $password ;
        $md5_pwd = md5($password);
        $flag = $exe->execute(array('email'=>$email, 'display_name'=>$display_name, 'password'=>$md5_pwd));
        if (!$flag) {
            print_r($exe->errorInfo());
        }
        return $flag;
    }

    public function getUserByEmail($email) {
        $sql = "select * from cr_users where email=:email";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('email'=>$email));
        return $exe->fetch(PDO::FETCH_ASSOC);
    }
    
    function getAllUsers() {
        $sql = "select * from cr_users";
        $exe = $this->db->prepare($sql);
        $exe->execute();
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getUserProfile($user_id) {
        $sql = "select * from user_settings where user_id=:user_id";
        $exe = $this->db->prepare($sql);
        $exe->execute(array('user_id'=>$user_id));
        return $exe->fetch(PDO::FETCH_ASSOC);
    }
    
    function updateProfile($user_id, $profile) {
        $settings = $this->getUserProfile($user_id);
        if ($settings) {
            $sql = "update user_settings set calendar_url=:calendar_url where user_id=:user_id";
            $exe = $this->db->prepare($sql);
            $flag = $exe->execute(array('calendar_url'=>$profile['calendar_url'], 'user_id'=>$user_id));
            return $flag;
        } else {
            $sql = "insert into user_settings(user_id, calendar_url) values(:user_id, :calendar_url)";
            $exe = $this->db->prepare($sql);
            $flag = $exe->execute(array('calendar_url'=>$profile['calendar_url'], 'user_id'=>$user_id));
            return $flag;
        }
    }
    
    function updateBasicInfo($user_id,  $display_name, $email) {
    	$sql = "update cr_users set display_name=:display_name, email=:email where id=:user_id";
    	$exe = $this->db->prepare($sql);
    	$flag = $exe->execute(array('display_name'=>$display_name, 'email'=>$email, 'user_id'=>$user_id));
    	return $flag;
    }
    
    function updatePassword($user_id, $password) {
    	$sql = 'update cr_users set password=:password where id=:user_id';
    	$exe = $this->db->prepare($sql);
    	$flag = $exe->execute(array('user_id'=>$user_id, 'password'=>$password));
    	return $flag;
    }
    
    function updatePasswordToken($email, $reset_token) {
    	$sql = 'update cr_users set reset_token=:reset_token, reset_time=now() where email=:email';
    	$exe = $this->db->prepare($sql);
    	$flag = $exe->execute(array('email'=>$email, 'reset_token'=>$reset_token));
    	return flag;
    }
    
    function resetPassword($user_id, $password) {
    	//echo "user ".$user_id." reset pwd to ".$password;
    	$sql = 'update cr_users set password=:password, reset_token=null, reset_time=null where id=:user_id';
    	$exe = $this->db->prepare($sql);
    	$flag = $exe->execute(array('user_id'=>$user_id, 'password'=>$password));
    	return $flag;
    	
    }

}
?>