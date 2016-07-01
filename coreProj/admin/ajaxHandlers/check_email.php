<?php

include('../includes/combine.php');
if(!empty($_REQUEST['email'])){
	$email = $_REQUEST['email'];
	
	$qry = "select * from users where email = '".$email."'";
	$res = $app->find($qry);
	
	if(is_array($res) && count($res) > 0){
		return true;
	}else{
		return false;
	}
}

?>
