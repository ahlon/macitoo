<?php
require_once 'class/alexa.class.php';


if(!empty($_POST['page_token'])) {
	$page_token = $_POST['page_token'];
} else {
	$page_token = NULL;
}

switch($page_token) {
	case "get_website" :
		$errFlag = 0;
		
		if(empty($_POST['website_name'])) {
			die("404#Please enter a Website's name");
			$errFlag++;
		} else {
			if($errFlag == 0) {
				$AlexaRank = new AlexaRank($_POST['website_name']);
				echo "200#";
				echo $_POST['website_name'] . "'s Rank : " . $AlexaRank->get('rank') . '<br />';
				echo $_POST['website_name'] . " is created : " . $AlexaRank->get('created') . '<br />';
				echo $_POST['website_name'] . " have links in : " . $AlexaRank->get('linksin') . '<br />';
				echo $_POST['website_name'] . "'s Reach : " . $AlexaRank->get('reach') . '<br />';
				echo $_POST['website_name'] . "'s title : " . $AlexaRank->get('title') . '<br />';
				echo $_POST['website_name'] . "'s description : " . $AlexaRank->get('description') . '<br />';
			}
		}
	break;
}


?>