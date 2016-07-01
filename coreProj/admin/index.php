<?php
include 'includes/combine.php';

if($_SESSION['is_logged_in'] === '1') {
   header("Location: dashboard.php");
   exit;
}

if(isset($_POST['login_btn']) && !empty($_POST['login_btn'])){
	$resp = $app->login();
	if($resp){
		header('location: dashboard.php');
	}else{
		header('location: index.php');
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>Login</title>
		<link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		
		<script language="JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js" type="text/javascript"></script>
		<script language="JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.js" type="text/javascript"></script>
		<script language="JavaScript" src="assets/js/custom.js" type="text/javascript"></script>

	</head>
	<body class="admin_body login-body">
		<header>
			<div id="wrapper2">
				<div class="header-base">
					<div class="logo-div">
						<img src="assets/images/logo.png">'
					</div>
				</div>
				
			</div>
		</header>
		<div class="border-div"></div>	
		
		<div class="regi-main">
		<form name="login-form" id="login_form" method="post"  action="">
		<div class="regi-base login_main">
			<div class="login-box">
				<h2><img src="assets/images/login_icon.png"/><div class="login_title"><span>HELPU</span><p>Admin Panel</p></div></h2>
				<fieldset id="personal">
					<legend style="margin-left: 0; padding-left: 8px; text-align: center; width: 100%">
						<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; } ?>
					</legend>
					
					
					<div class="input-prepend">      
						<label for="lastname">Email Id:</label>
						<input type="text" name="email" id="email" class="btn login" value="" >
					</div>
					
					<div class="clearfix"></div>
					<div class="input-prepend">
						<label for="password">Password :</label>
						<input type="password" name="password" id="password" class="btn login">
					</div>
					
					<div class="button-login" >	
						<input type="submit" name="login_btn" class="btn login" value="Login">
					</div>
					
					
				</fieldset>
			</div>			
		</div>	
	</div></form>
		<footer>
			<div class="wrapper">
				<p>&copy; Copyright 2016 All Rights Reserved. HELPU </p>
			</div>
		</footer>
	</body>
</html>
