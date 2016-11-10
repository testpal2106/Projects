
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "root", "crud1");
$result = $conn->query("SELECT * FROM users");

$response = $resp = array();
$i=1;
if($result->num_rows > 0){
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$date=$row['date_created'];
			
		$response[$i]['sno'] = $i++;
		$response[$i]['id'] = $row['id'];
		$response[$i]['name'] = $row['firstname']. ' ' .$row['lastname'];
		$response[$i]['email'] = $row['email'];
		$response[$i]['address'] = $row['address'];
	    $response[$i]['date_created'] = date("F j, Y", strtotime($date));
	}
}
$conn->close();
$resp['records'] = $response;
echo json_encode($resp); 
?>
