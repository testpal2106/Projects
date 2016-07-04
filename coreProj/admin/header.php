<?php
session_start();
include "includes/combine.php";
	
if(!$_SESSION['is_logged_in']) {
   header("Location: index.php");
   exit;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

<title>Title</title>
<link type="text/css" rel="stylesheet" href="assets/css/font-awesome.css">
<link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css">

		
		
<link type="text/css" rel="stylesheet" href="assets/css/style.css">

<script language="JavaScript" src="assets/js/jquery.min.js" type="text/javascript"></script>
<script language="JavaScript" src="assets/js/jquery.validate.js" type="text/javascript"></script>
<script language="JavaScript" src="assets/js/custom.js" type="text/javascript"></script>

</head>

<body>
	<header>
		<div id="wrapper2">
			<div class="header-base">
				<div class="logo-div">
					<img src="assets/images/logo.png">
					
				</div>
				<div class="header-right-main">
					<nav  class="dashboard-nav">
						<div class="welcometxt">
							<h2><span>
							
							</span></h2>
						</div>					
					</nav>
					<div class="navi-outer">
						<ul>
							<li><a href="#">Dashboard</a></li>
							<li id="users"><a>Users <i class="fa fa-angle-down dp-arrow"></i></a>
								<ul class="users-child nav-child" style="display:none">
									<li><a href="users_add.php">Add User</a></li>
									<li><a href="users_view.php">View users</a></li>
								</ul>
							</li>
							<li id="contact"><a href="#">Messages</a></li>
							<li id="master_data"><a>Master Data <i class="fa fa-angle-down dp-arrow"></i></a>
								<ul class="master-data-child nav-child" style="display:none">
									<li><a href="#">Categories</a></li>
									<li><a href="#">Pages</a></li>
								</ul>
							</li>
							<li id="settings"><a>Settings <i class="fa fa-angle-down dp-arrow"></i></a>
								<ul class="settings-child nav-child" style="display:none">
									<li>
										<a href="#">Change Password</a>
										<a href="logout.php">Logout</a>
									</li>
								</ul>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
