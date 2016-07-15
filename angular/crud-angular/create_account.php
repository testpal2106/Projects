<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'includes/common.php';
$data = json_decode($_REQUEST['formData']);
print_r($pval);


$user_data['username'] = $data->username;
$user_data['firstname'] = $data->firstname;
$user_data['lastname'] = $data->lastname;
$user_data['email'] = $data->email;

$user_data['password'] = $data->password;
$user_data['gender'] = $data->gender;
$user_data['education'] = $data->education;
$user_data['country'] = $data->country;
$user_data['state'] = $data->state;
$user_data['address'] = $data->address;
$user_data['phone_number'] = $data->phone_number;
$user_data['zipcode'] = $data->zipcode;
$user_data['status'] = 1;
$user_data['date_added'] = date('Y-m-d H:i:s');
$app->access_table = 'users'; 
$app->add($user_data);
$user_id = $app->last_inserted_id();  
if(!empty($user_id)){
	echo 'success';
}
 //echo "<pre>"; print_r($pval); exit;

