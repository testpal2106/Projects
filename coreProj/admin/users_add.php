<?php 

include('header.php'); 
$app->tablename = 'countries';
$countries = $app->find();

$app->tablename = 'roles';
$roles =  $app->find();

$user_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : ''; 
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : ''; 


if(isset($_POST['submit_btn']) && !empty($_POST['submit_btn'])){
	
	$userNameErr = $firstNameErr = $lastNameErr = $emailErr = $phoneErr = $addressErr = $countryErr = ''; 
	$countErr = 0;
	if(empty($_POST['username'])){
		$countErr++;
		$userNameErr = 'Please enter your username.';
	}else{
			if(empty($user_id)){
				//check if this username is unique
				$app->tablename = 'users';
				$params = array('conditions' => array( 'username=' => $_POST['username'] )	);
				
				$selectFields = array('*');
				$rec=  $app->find($selectFields, $params);
				if(count($rec) > 0){
					$countErr++;
					$error .= $userNameErr = 'This username already exists. Please try again.';
				}
			}
	}
	if(empty($_POST['firstname'])){
		$countErr++;
		$error .=  $firstNameErr = 'Please enter your first name.';
	}
	if(empty($_POST['lastname'])){
		$countErr++;
		$error .= $lastNameErr = 'Please enter your last name.';
	}
	
	if(empty($_POST['email'])){
		$countErr++;
		$error .= $emailErr = 'Please enter your email address.';
	}else{
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$countErr++;
			$error .= $emailErr = 'Please enter valid email address.';
		}else{
			if(empty($user_id)){
				//check if this email is unique
				$app->tablename = 'users';
				$params = array('conditions' => array( 'email=' => $_POST['email'] )	);
				
				$selectFields = array('*');
				$rec=  $app->find($selectFields, $params);
				if(count($rec) > 0){
					$countErr++;
					$error .= $emailErr = 'This email address already exists. Please try again.';
				}
			}
		}		
	}
	
	if(!isset($_REQUEST['id']) && empty($_POST['password'])){
		$countErr++;
		$error .= $passwordErr = 'Please enter your password.';
	}
	
	if(!isset($_REQUEST['id']) && empty($_POST['confirm_password'])){
		$countErr++;
		$error .= $confirm_passwordErr = 'Please confirm your password.';
	}
	
	if(!isset($_REQUEST['id']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && $_POST['password'] != $_POST['confirm_password'] ){
		$countErr++;
		$error .= $confirm_passwordErr = 'Both passwords do not match.';
	}
	if(empty($_POST['phone'])){
		$countErr++;
		$error .= $phoneErr = 'Please enter your phone.';
	}
	if(empty($_POST['address'])){
		$countErr++;
		$error .= $addressErr = 'Please enter your address.';
	}
	if(empty($_POST['city'])){
		$countErr++;
		$error .= $cityErr = 'Please enter your city.';
	}
	if(!isset($_REQUEST['id']) && empty($_POST['state'])){
		$countErr++;
		$error .= $stateErr = 'Please select your state.';
	}
		
	if(empty($_POST['country'])){
		$countErr++;
		$error .= $countryErr = 'Please select your country.';
	}
	if(empty($_POST['role_id'])){
		$countErr++;
		$error .= $roleErr = 'Please select role.';
	}
	if(empty($_POST['status'])){
		$countErr++;
		$error .= $statusErr = 'Please select status.';
	}
		
	if($countErr > 0){
		$error .= 'Please fill all the required fields.';
		
	}else{
		
		$data['username'] = $_POST['username'];
		$data['firstname'] = $_POST['firstname'];
		$data['lastname'] = $_POST['lastname'];
		$data['email'] = $_POST['email'];
		$data['password'] = $_POST['password'];
		$data['address'] = $_POST['address'];
		$data['city'] = $_POST['city'];
		$data['state'] = $_POST['state'];
		$data['country'] = $_POST['country'];
		$data['phone'] = $_POST['phone'];
		$data['role_id'] = $_POST['role_id'];
		$data['status'] = $_POST['status'];
		$data['date_added'] = date('y-m-d');
		
		$app->tablename = 'users';
		if(!empty($user_id)){
			$where = array('id=' => $user_id);
			$res = $app->save($data, $where);
			if(empty($res)){
				$success="You have successfully added a new user";
				header('location:http://localhost/gitProjects/coreProj/admin/users_add.php?action=edit&id='.$user_id.'status=success');
			}else{
				$error = "There is an error in creating new user.";
			}
		}else{
			$res = $app->add($data);
			if(!empty($res)){
				$success="You have successfully added a new user";
				header('location:http://localhost/gitProjects/coreProj/admin/users_add.php?status=success');
			}else{
				$error = "There is an error in creating new user.";
			}
		}
		
		
	}
}

$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
if(!empty($status)){
	if($status == 'success'){
		$success="You have successfully added a new user";
	}
} 


if(!empty($user_id)){
	$app->tablename = 'users';
	$edit_user_details =  $app->find(array('*'), array('conditions' => array('id=' => $user_id) ));
	
}
?>

	<div class="border-div" id="border-div"></div>	
	<div class="clr"></div>
	<div class="regi-main">
		<div id="wrapper2">
			<div id="container">
				<div id="header">
					<!-- Main Content Starts Here -->
					<div id="content">
						<?php if(isset($error)): ?>
						<div id="message-red" >
							<table cellspacing="0" cellpadding="0" style="width:100%;border:0px;">
								<tr>
									<td class="red-left" style="border:0px;">
										<span class="msg_green"><i class="fa fa-times" aria-hidden="true"></i></span>
										<?php echo $error; ?>
									</td>
								</tr>
							</table>
						</div>
							<?php endif; ?>
						<?php if(isset($success)): ?>
						<div id="message-green">
							<table cellspacing="0" cellpadding="0" style="width:100%;border:0px;">
								<tbody>
									<tr>
										<td style="border:0px;" class="green-left">
											<span class="msg_green"><i class="fa fa-times" aria-hidden="true"></i></span>
											<?php echo $success; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					  <?php endif; ?>

	<div class="account-right-div">
		<div class="dashboard-heading">
			<h2><?php if(!empty($user_id)){ echo "Edit"; }else{ echo "Add"; } ?> User</h2>
			<h5>
				<a href="http://localhost/gitProjects/coreProj/admin/dashboard.php">Dashboard</a>		
			</h5>
			<span>»</span>
			<h5>
				<a href="http://localhost/gitProjects/coreProj/admin/users_add.php">Users</a>			
			</h5>
			<span>»</span>
			<h5><?php if(!empty($user_id)){ echo "Edit"; }else{ echo "Add"; } ?> user</h5>
		</div>
	
		<div class="dashboard-inner">
			<form name="<?php if(!empty($user_id)){ echo "edit"; }else{ echo "add"; } ?>-user" id="<?php if(!empty($user_id)){ echo "edit"; }else{ echo "add"; } ?>_user" method="post" action= "" >
			<div class="main-dash-summry Edit-profile">
				
				<?php if(empty($user_id)){ ?>
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Username: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value="<?php if(isset($edit_user_details[0]['username'])){ echo $edit_user_details[0]['username']; }else{ echo $_POST['username']; } ?>" class="inputbox-main">
									<span class="error-ms"><?php if(isset($userNameErr)){ echo $userNameErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Email: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="email" value="<?php if(isset($edit_user_details[0]['email'])){ echo $edit_user_details[0]['email']; }else{ echo $_POST['email']; } ?>"  class="inputbox-main">
									<span class="error-ms"><?php if(isset($emailErr)){ echo $emailErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					<?php } ?>
					<div class="input-row ">
						<div class="full">
							<div class="input-block edit_page">
								<label>First Name: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="firstname" value="<?php if(isset($edit_user_details[0]['firstname'])){ echo $edit_user_details[0]['firstname']; }else{ echo $_POST['firstname']; } ?>"  class="inputbox-main">
									<span class="error-ms"><?php if(isset($firstNameErr)){ echo $firstNameErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
				
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Lastname: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="lastname" value="<?php if(isset($edit_user_details[0]['lastname'])){ echo $edit_user_details[0]['lastname']; }else{ echo $_POST['lastname']; } ?>" class="inputbox-main">
									<span class="error-ms"><?php if(isset($lastNameErr)){ echo $lastNameErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Password: <e>*</e></label>
								<span class="reg_span">
									<input type="password" name="password" id="password" value="" class="inputbox-main">
									<span class="error-ms"><?php if(isset($passwordErr)){ echo $passwordErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Confirm Password: <e>*</e></label>
								<span class="reg_span">
									<input type="password" name="confirm_password" value=""  class="inputbox-main">
									<span class="error-ms"><?php if(isset($confirm_passwordErr)){ echo $confirm_passwordErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
				
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Phone Number: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="phone" value="<?php if(isset($edit_user_details[0]['phone'])){ echo $edit_user_details[0]['phone']; }else{ echo $_POST['phone']; } ?>" class="inputbox-main">
									<span class="error-ms"><?php if(isset($phoneErr)){ echo $phoneErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Address: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="address" value="<?php if(isset($edit_user_details[0]['address'])){ echo $edit_user_details[0]['address']; }else{ echo $_POST['address']; } ?>"  class="inputbox-main"> <span class="error-ms"><?php if(isset($addressErr)){ echo $addressErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>City: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="city" value="<?php if(isset($edit_user_details[0]['city'])){ echo $edit_user_details[0]['city']; }else{ echo $_POST['city']; } ?>"  class="inputbox-main">
									<span class="error-ms"><?php if(isset($cityErr)){ echo $cityErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
				
					<div class="input-row  pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Country: <e>*</e></label>
								<span class="reg_span">
									<select name="country" id="country" class="inputbox-main">
										<option value="">Select Country</option>
										<?php 
										if(count($countries) > 0){
											$selected = '';
											foreach($countries as $country){ 	?>
											<option value="<?php echo $country['country_id']; ?>"											
											<?php 
																		
												if(isset($edit_user_details[0]['country']) && ( $edit_user_details[0]['country'] == $country['country_id'] )){
														echo "selected = selected"; 
												}else{									
													if(isset($_POST['country']) &&	 ( $edit_user_details[0]['country'] == $country['country_id'] )){
															echo "selected = selected"; 
													}												
												}  
												
											?> >
											<?php echo $country['country_name']; ?>
											</option>
											<?php
											}
										}
										?>
									</select>
									<span class="error-ms"><?php if(isset($countryErr)){ echo $countryErr; } ?></span>
							
								</span>
							</div>
						</div>
					</div>
					<div class="input-row ">
						<div class="full">
							<div class="input-block edit_page">
								<label>State: <e>*</e></label>
								<span class="reg_span">
									<?php 
									$state_name = GlobalClass::get_state_name($_POST['state']);
									$state_name = GlobalClass::get_state_name($edit_user_details[0]['state']); 
									 ?>
									<select name="state" id="state" class="inputbox-main">
										<option value="">Select State</option>	
										<?php
											if(isset($_POST['state']) || isset($edit_user_details[0]['state'])){
												echo '<option value="'.$_POST['state'].'" selected="selected">'.$state_name.'</option>';
											}										
										?>									
									</select>
									<span class="error-ms"><?php if(isset($stateErr)){ echo $stateErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
				
				
					<div class="input-row  pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Role: <e>*</e></label>
								<span class="reg_span">
									<select name="role_id" id="role_id" class="inputbox-main">
										<option value="">Select Role</option>
										<?php 
											if(count($roles) > 0){
												$selectedrole = '';
												foreach($roles as $role){ ?>
												<option value="<?php echo $role['id']; ?>"											
											<?php 															
												if(isset($edit_user_details[0]['role_id']) && ( $edit_user_details[0]['role_id'] == $role['id'] )){
														echo "selected = selected"; 
												}else{									
													if(isset($_POST['role_id']) &&	 ( $edit_user_details[0]['role_id'] == $role['id'] )){
															echo "selected = selected"; 
													}												
												}  
											?> >
												<?php echo $role['role_name']; ?>
											</option>
											<?php
												}
											}
										?>
									</select>
									<span class="error-ms"><?php if(isset($roleErr)){ echo $roleErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Status: <e>*</e></label>
								<span class="reg_span">
									<select name="status" id="status" class="inputbox-main">
										<option value="">Select Status</option>
										
										<option value="1" <?php if(isset($edit_user_details[0]['status']) && ($edit_user_details[0]['status'] == '1')){  echo "selected=selected"; }else if( $_POST['status'] == '1'){ echo "selected=selected";} ?> >Active</option>
										
										<option value="2"  <?php if(isset($edit_user_details[0]['status']) && ($edit_user_details[0]['status'] == '2')){  echo "selected=selected"; }else if( $_POST['status'] == '2'){ echo "selected=selected";} ?> >Inactive</option>
									</select>
									<span class="error-ms"><?php if(isset($statusErr)){ echo $statusErr; } ?></span>
								</span>
							</div>
						</div>
					</div>
				
					<div class="footer_button footer_div">
					<div class="">
						<div class="full">
							<div class="input-block add-user-btn">
								<span class="">
									<input type="submit" class="btn-submit btn" name="submit_btn" value="Submit">
									<a class="btn-submit btn" href="http://localhost/helpu/admin/owners">Cancel</a>							
								 </span>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
					<!-- Main Content Ends Here -->
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

