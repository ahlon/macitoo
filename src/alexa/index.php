<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Get Alexa Rank</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="script/validate.js"></script>
</head>

<body>
<form id="start" action="alexa.action.php" name="start">
	<h1>Get Alexa Rank</h1>
    <p>
    	<label for="website_name">Website Name</label>
		<input id="website_name" type="text" name="website_name" />
	</p>
    <p>
    	<input type="hidden" name="page_token" value="get_website" />
    	<input type="submit" class="submit" name="submit" value="Get Rank" />
    </p>
    <p>
    	<img id="loader" src="images/ajax-loader.gif" />
    	<div id="success"></div>
        <div id="error"></div>
    </p>
</form>
</body>
</html>