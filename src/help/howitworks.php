<?php
header("Content-Type: text/html;charset=utf-8");
//include_once './includes/auth.php';
include_once '../includes/res.php';
include_once '../includes/header.php';
?>
<div class="container">
	<div class="well">
		<p>习惯养成 </p>
	</div>
	<div class="well">
		<p>每日计划 </p>
	</div>
	<div class="well">
		<p>目标跟踪 </p>
	</div>
	<div class="well action">
		<p align="center">
			<a class="btn btn-primary btn-large" href="/modules/users/register.php" >立即注册 &raquo</a>
		</p>
	</div>
</div>

<?php 
include_once '../includes/footer.php';
?>