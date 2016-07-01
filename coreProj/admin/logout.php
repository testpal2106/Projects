
<?php
session_start();
include ('includes/combine.php');  
$app->logout();
session_destroy();
header("Location: index.php");
exit;
 ?>
