<?php
require_once dirname ( __FILE__ )."/../config.php";
require_once dirname(__FILE__).'/../service/UserService.php';
$userService = new UserService();
if (!$userService->isAuthed()) {
    header("location:/login?from=".$_SERVER["REQUEST_URI"]);
}
?>