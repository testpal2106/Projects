<?php

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Kolakata');

include ('includes/classes/database.class.php');

include ('includes/classes/application.class.php');
$app = new application();
include ('includes/common/global_functions.php');
$html_root_path = find_root_path();
include ('includes/common/define.php');

