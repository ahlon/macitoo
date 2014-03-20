<?php
require_once dirname(__FILE__).'/../dao/UserDao.php';
require_once 'MailService.php';

class UserService {
    private $dao;

    public function __construct() {
        $this->dao = new UserDao();
    }
    
    function register($email, $display_name, $password) {
        return $this->dao->insertUser($email, $display_name, $password);
    }

    function auth($email, $password) {
        $user = $this->dao->getUserByEmail($email);
        if ($user['password'] == md5($password)) {
            session_destroy();
        	session_start();
            $_SESSION['user'] = $user;
            return true;
        } else {
            return false;
        }
    }
    
    function updateSettings($profile) {
        @session_start();
        $user = $_SESSION['user'];
        $this->dao->updateProfile($user['id'], $profile);
    }
    
	function updateAccntInfo($accntInfo) {
		@session_start();
		$user = $_SESSION['user'];
		if(isset($accntInfo['display_name']) && isset($accntInfo['email'])) {
			$flag = $this->dao->updateBasicInfo($user['id'], $accntInfo['display_name'], $accntInfo['email']);
			if($flag) {
				$user = $this->dao->getUserByEmail($accntInfo['email']);
	    		$_SESSION['user'] = $user;
			}
		} else if(isset($accntInfo['password'])) {
			$flag = $this->dao->updatePassword($user['id'], md5($accntInfo['password']));
		}
		
		return $flag;
	}
	    
    function getSettings() {
        @session_start();
        $user = $_SESSION['user'];
        return $this->dao->getUserProfile($user['id']);
    }
    
    function isAuthed() {
        @session_start();
        return isset($_SESSION['user']);
    }
    
    function getCurrentUser() {
        @session_start();
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

    function getUserByLoginname($loginname) {
        $user = $this->dao->getUserByLoginname($loginname);
        return $user;
    }
    
    function getAllUsers() {
        return $this->dao->getAllUsers();
    }
    
    function isEmailRegistered($email) {
    	$user = $this->dao->getUserByEmail($email);
    	return !empty($user);
    	/*if($user) {
    		return True;
    	}
    	return FALSE;*/
    }
    
    function updateResetPasswordToken($email) {
    	$reset_token = uniqid();
		$flag = $this->dao->updatePasswordToken($email, $reset_token);
		if($flag) {
	    	$mail_man = new MailService();
	    	$title='重置您在Macitoo的账户密码';
	    	$content = "http://macitoo.sinaapp.com/reset_passwd.php?email=".$email."&token=".$reset_token;
	    	$flag = $mail_man->send_email($email, $title, $content);
		}
		
		return $flag;
    	
    }

    function resetPassword($email, $token, $password) {
    	$user = $this->dao->getUserByEmail($email);
    	if(empty($user) or $user['reset_token'] != $token) {
    		return false;
    	} 
    	return $this->dao->resetPassword($user['id'], md5($password));
    }
}
