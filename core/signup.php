<?php
session_start(); 

include ('includes/common/common.php');
$page = 'register';
/*if($app->is_logged_in() === true) {
   header("Location: index.php");
   exit;
}*/


$date = date('Y-m-d H:i:s');

$con = mysql_connect('localhost', 'root' , 'root');
$select_db = mysql_select_db('core');

if(isset($_POST['signup_btn']) &&!empty($_POST['signup_btn'])){
	
}


include( LAYOUT_PATH . 'common/header.html'); 
include( LAYOUT_PATH . 'signup.html');
include( LAYOUT_PATH . 'common/footer.html');
  
?>

