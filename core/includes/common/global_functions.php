<?php 
function find_root_path($exclude_dir = '') {

	$curent_dir  = getcwd();
	$root_dir = $_SERVER['DOCUMENT_ROOT'];
	$app_dir = substr($curent_dir, strlen($root_dir));
	$app_dir = str_replace('\\', '/', $app_dir);

	$is_val = isSSL();
	$server_name =  $_SERVER['HTTP_HOST'];

	if($is_val === TRUE){
		$url_value = 'https://' . $server_name;
 	}	else {
		$url_value = 'http://' . $server_name;
 	}

	return $url_value .'/'. $app_dir . '/';
}


function isSSL(){

  if($_SERVER['https'] == 1) /* Apache */ {
     return TRUE;
  } elseif ($_SERVER['https'] == 'on') /* IIS */ {
     return TRUE;
  } elseif ($_SERVER['SERVER_PORT'] == 443) /* others */ {
     return TRUE;
  } else {
  return FALSE; /* just using http */

  }

}

