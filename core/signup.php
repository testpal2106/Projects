<?php
session_start(); 

include ('includes/common/common.php');
$page = 'register';
if($app->is_logged_in() === true) {
   header("Location: index.php");
   exit;
}

if(isset($_POST['signup_btn']) &&!empty($_POST['signup_btn'])){
	print_r($app);
}


include( LAYOUT_PATH . 'common/header.html'); 
include( LAYOUT_PATH . 'signup.html');
include( LAYOUT_PATH . 'common/footer.html');
  
?>
