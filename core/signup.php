<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>index</title>
</head>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link href="assets/css/animate.css" rel="stylesheet" type="text/css">
<script src="assets/js/wow.js"></script>

<body class="login-page">

	<!-----header-start----->
	<header>	
		<div class="header-outer">	
			<div class="wrapper">		
				<div class="logo"> <img src="assets/images/logo.png"/> </div>
				<div class="right-div">	
					<nav>
						<ul id="nav">
							<li class="active"> <a class="active" href="#"> Home  </a> </li>
							<li> <a href="#">  About Us </a> </li>
							<li> <a href="#"> Features </a> </li>
							<li> <a href="#"> Contact Us </a> </li>
						</ul>
						<script type="text/javascript">
							jQuery("i").click(function(){
							  jQuery(".dropdown-1").slideToggle();
							  });
						</script>
						
							<script type="text/javascript">
						  jQuery("#nav").addClass("js").before('<div id="menu"><img src="assets/images/menu.png"/></div>');
						  jQuery("#menu").click(function(){
						  jQuery("#nav").slideToggle();
						  });
						  jQuery(window).resize(function(){
						  if(window.innerWidth >990) {
						  jQuery("#nav").removeAttr("style");
						  }
						  });
							jQuery(document).ready(function(){
								jQuery(".slidesjs-pagination-item li").each( function(){
									alert("test");
									jQuery(this).addClass("abc");
								});
							});
								  </script>
					</nav>					
					<div class="header-btn">
						<a href="#"> Log In </a>
						<a href="#" class="active"> Sign Up </a>
					</div>
				</div>	
			</div>		
		</div>
		
	</header>
	<!-----header-end----->
		<!--register page-->
		<div class="login-page-inner">
		<div class="wrapper2">
			<div class="reg-head"><h1 class="reg-page"><img src="assets/images/login-icon.png">Sign Up</h1></div>
			<p class="reg-para">After you Create your shopping pal account, we will ask you to link your credit card, debit card, or PayPal. Then you can start using yourshoppingpal right away</p>
			
			<div class="register-steps">
				
			</div>
			<div class="payment-inner-login billing-information-payment">
						<h1 class="step-heading"> 1 Personal  Information</h1>
							<form name="signup_form" id="signup_form" method="post" action="" >
							<div class="full-block-studio">
								
									<div class="full-block-studio">
									
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="text" value="" name="user_login" id="user_login" placeholder="Username" class="block-input">
												<img src="assets/images/b-user.png">
											</div>
										</div>
										<!--end-->
									
								</div>
							</div>
							<div class="full-block-studio">
								<div class="left-block-studio">
									<div class="full-block-studio">
									
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="text" value="" name="first_name" id="first_name" placeholder="First Name" class="block-input">
												<img src="assets/images/b-user.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
								<div class="left-block-studio right">
									<div class="full-block-studio">
										
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="text" value="" placeholder="Last Name" class="block-input">
												<img src="assets/images/b-user.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
							</div>
							<div class="full-block-studio">
								<div class="left-block-studio">
									<div class="full-block-studio">
									
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="password" name ="password" id ="password" value="" placeholder="Password" class="block-input">
												<img src="assets/images/b-user.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
								<div class="left-block-studio right">
									<div class="full-block-studio">
										
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="password" name="confirm_password" id="confirm_password" value="" placeholder="Confirm Password" class="block-input">
												<img src="assets/images/b-user.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
							</div>
							<div class="full-block-studio">
								<div class="left-block-studio">
									<div class="full-block-studio">
									
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="text" name="user_email" id="user_email"  value="" placeholder="Email" class="block-input">
												<img src="assets/images/b-email.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
								<div class="left-block-studio right">
									<div class="full-block-studio">
										
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<input type="text" name="phone_no" id="phone_no" value="" placeholder="Phone" class="block-input">
												<img src="assets/images/b-phone.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
							</div>
							<div class="full-block-studio">
								<div class="full-block-studio">
									
									<!--input-->
									<div class="input-block-studio">
										<div class="img-input-block txtarea-new">
											<textarea name="address"  id="address" placeholder="Address" class="block-input "></textarea>
											<img src="assets/images/b-Address.png">
										</div>
									</div>
									<!--end-->
								</div>
							</div>
							<div class="full-block-studio">
								<div class="left-block-studio">
									<div class="full-block-studio">
									
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<select name="country" id="country"  class="block-input">
													<option value="">Select Country</option>
												</select>
												<img src="assets/images/b-Address.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
								<div class="left-block-studio right">
									<div class="full-block-studio">
										
										<!--input-->
										<div class="input-block-studio">
											<div class="img-input-block">
												<select name="state" id="state" class="block-input">
													<option>Select State</option>
												</select>
												<img src="assets/images/b-Address.png">
											</div>
										</div>
										<!--end-->
									</div>
								</div>
							</div>
							<div class="reg-btn">
								<input type="Submit" value="Submit" class="login-btn">
							</div>
							
							</form>
					</div>
				</div>
			</div>
	
	<!--end register-->
	<footer class="inner-footer">
		<div class="footer-copy-right">
			<div class="wrapper">
				<p> Copyright 2016 Your Shopping Pal.com. All rights reserved. </p>
			</div>
		</div>
	</footer>

</body>

</html>
