<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1); 
date_default_timezone_set('Asia/Kolkata');

include ('config/database.php');
include ('objects/global.class.php');
include ('objects/application.class.php');

$app = new Application();

?>
