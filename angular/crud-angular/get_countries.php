<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'includes/common.php';
$result = search_result::get_countries();
$num = count($result);
if($num > 0) {
	$data=""; $x=1;
	foreach($result as $rows){
		$data .= '{';          
		   $data .= '"country_name":"'   . $rows['country_name'] . '",';          
		
		   $data .= '"country_code":"'   . $rows['country_code'] . '"';          
		$data .= '}'; 
		$data .= $x<$num ? ',' : ''; 
		$x++;
	}
}

//echo json_encode($result);
// json format output
echo '{"records":[' . $data . ']}';
?>
