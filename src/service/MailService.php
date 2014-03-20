<?php
	//Sina App Engine Send mail demo
define("MAIL_ACCOUNT", 'macitoomail@sina.com');
define("MAIL_PASSWD", '`1234567890-=');
	
class MailService {
    private $mail;

    public function __construct() {
        $this->mail = new SaeMail();
    }
    
    public function send_email($email_receiver, $title, $content) {
    	$flag = $this->mail->quickSend($email_receiver, $title, $content, MAIL_ACCOUNT , MAIL_PASSWD);
    	$this->mail->clean();
    	
    	return $flag;
    }
}

?>
