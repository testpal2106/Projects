<?php 
class search_result {   
	Public static function get_countries(){ 
		$app = $GLOBALS['app'];
		$query = "SELECT 
						 country_name, country_code
					FROM 
						countries
					ORDER BY 
						country_name ASC";
		$data = $app->getrows($query);	
		return $data;
	}
	Public static function get_states($code=null){ 
		$app = $GLOBALS['app'];
		$query = "SELECT 
						 state_name, state_code 
					FROM 
						states
					WHERE
						country_code = '".$code."'
					ORDER BY 
						state_name ASC";
		$data = $app->getrows($query);	
		return $data;
	}

}  
?>
