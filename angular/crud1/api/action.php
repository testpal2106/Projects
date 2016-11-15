
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "root", "root", "crud1");
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
//~ $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';
$data =  json_decode(file_get_contents("php://input"));

switch($action){
	case 'get_students':
		get_students($data); break;
	case 'add_student':
		add_student($data); break;
	case 'update_student':
		update_student($data); break;
	case 'delete_student':
		delete_student($data); break;
	default:
		echo "default case";
		break;
}

function get_students($data){
	global $conn;
	
	$arrData = (array) $data;
	
	extract($arrData);
	 
	$qry = "SELECT * FROM users";
	if(isset($id) && !empty($id)){
		$qry .= " where id = $id";
	}
	$result = $conn->query($qry);
	$response = $resp = array();
	
	
	if($result->num_rows > 0){
		$i=0;
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$date=$row['date_created'];
			$response[$i]['sno'] = $i+1;
			$response[$i]['id'] = $row['id'];
			$response[$i]['firstname'] = $row['firstname'];
			$response[$i]['lastname'] = $row['lastname'];
			$response[$i]['name'] = $row['firstname']. ' ' .$row['lastname'];
			$response[$i]['email'] = $row['email'];
			$response[$i]['address'] = $row['address'];
			$response[$i]['date_created'] = date("F j, Y", strtotime($date));
			$i++;
		}
	}
	$conn->close();
	$resp['records'] = $response;
	echo json_encode($resp); 
}

function add_student($data){
	global $conn;
	$arrData = (array) $data;
	extract($arrData);
	
	$count = 0;
	
	if(empty($firstname) || empty($lastname) || empty($email) ||  empty($password) || empty($confirm_password) || $password != $confirm_password  ){
		$count++;
		$error = "Please fill all the required fields.";
	} else {
		if($password != $confirm_password  ){
			$count++;
			$error = "Both passwords do not match.";
		} 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$count++;
			$error = "Please enter a valid email.";
		} 
	}
	
	if($count > 0){
		$response['status'] = 'error';
		$response['msg'] = $error;
	}else{
		$qry = "Insert into users set 
					firstname='".$firstname."', 
					lastname='".$lastname."', 
					email='".$email."', 
					password='".$password."' ";
					
		$exec = $conn->query($qry);
		if($exec){
			$response['status'] = 'success';
			$response['msg'] = 'You have added a student successfully.';			
		} else{
			$response['status'] = 'error';
			$response['msg'] = 'There is error in saving your record.';			
		}
	}
	
	echo json_encode($response);
	$conn->close();
	
}


function update_student($data){
	global $conn;
	$arrData = (array) $data;
	extract($arrData);
	
	$count = 0;
	
	if(empty($firstname) || empty($lastname)  || empty($email)  ){
		$count++;
		$error = "Please fill all the required fields.";
	} 
	if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$count++;
		$error = "Please enter a valid email.";
	} 
	if(!empty($confirm_password) &&  empty(!$password)){
		if($password != $confirm_password  ){
			$count++;
			$error = "Both passwords do not match.";
		} 
	}
		
	if($count > 0){
		$response['status'] = 'error';
		$response['msg'] = $error;
	}else{
		$qry = "Update users set 
					firstname='".$firstname."', 
					lastname='".$lastname."', 
					email='".$email."', 
					password='".$password."' 
					where id ='".$student_id."' ";
					
		$exec = $conn->query($qry);
		if($exec){
			$response['status'] = 'success';
			$response['msg'] = 'You have updated the student successfully.';			
		} else{
			$response['status'] = 'error';
			$response['msg'] = 'There is error in saving your record.';			
		}
	}
	
	echo json_encode($response);
	$conn->close();
	
}

function delete_student($data){
	global $conn;
	$arrData = (array) $data;
	extract($arrData);
	
	$count = 0;
	
	
	if(!empty($id)) {
		$qry = "delete from users where id ='".$id."' ";
					
		$exec = $conn->query($qry);
		if($exec){
			$response['status'] = 'success';
			$response['msg'] = 'You have updated the student successfully.';			
		} else{
			$response['status'] = 'error';
			$response['msg'] = 'There is error in saving your record.';			
		}
	} else{
		$response['status'] = 'error';
		$response['msg'] = 'There is an error in deleting the records.';
		
	}
	
		
	
	echo json_encode($response);
	$conn->close();
	
}


?>
