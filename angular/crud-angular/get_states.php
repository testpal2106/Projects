<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'includes/common.php';
$country_code = $_REQUEST['country_code'];
$result = search_result::get_states($country_code);
$num = count($result);
if($num > 0) {
	$data=""; $x=1;
	foreach($result as $rows){
		$data .= '{';          
		   $data .= '"state_name":"' . iconv(mb_detect_encoding($rows['state_name'], mb_detect_order(), true), "UTF-8", $rows['state_name']) . '",';          
		   $data .= '"state_code":"'   . $rows['state_code'] . '"';          
		$data .= '}'; 
		$data .= $x<$num ? ',' : ''; 
		$x++;
	}
}

//echo json_encode($result);
// json format output
echo '{"records":[' . $data . ']}';
?>
