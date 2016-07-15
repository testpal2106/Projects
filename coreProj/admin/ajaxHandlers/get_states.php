<?php

include('../includes/combine.php');
if(!empty($_REQUEST['country_id'])){
	$country_id = $_REQUEST['country_id'];
	$app->tablename = 'states';
	$res = $app->find(array('state_id,country_id,state_name'), array( 'conditions' => array('country_id = ' => $country_id)) );
	
	if(is_array($res) && count($res) > 0){
		echo json_encode($res);
	}
}

?>
