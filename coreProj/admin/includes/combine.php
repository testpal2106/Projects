<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);


global $app;

include ('classes/application.class.php');

$app = new Application();



