<?php include('header.php'); 
$countries = $app->get_countries();
$roles = $app->get_roles();


?>

	<div class="border-div" id="border-div"></div>	
	<div class="clr"></div>
	<div class="regi-main">
		<div id="wrapper2">
			<div id="container">
				<div id="header">
					<!-- Main Content Starts Here -->
					<div id="content">
						<div id="message-red" style="display:none">
								<table cellspacing="0" cellpadding="0" style="width:100%;border:0px;">
								<tr>
									<td class="red-left" style="border:0px;">
										<span class="msg_green"><i class="fa fa-times" aria-hidden="true"></i></span>
										Message</td>
								</tr>
								</table>
							</div>
						<div id="message-green" style="display:none;">
								<table cellspacing="0" cellpadding="0" style="width:100%;border:0px;">
									<tbody>
										<tr>
											<td style="border:0px;" class="green-left">
												<span class="msg_green"><i class="fa fa-times" aria-hidden="true"></i></span>
												Message
											</td>
											
										</tr>
									</tbody>
								</table>
							</div>




	<div class="account-right-div">
		<div class="dashboard-heading">
			<h2>Add User</h2>
			<h5>
				<a href="http://localhost/gitProjects/coreProj/admin/dashboard.php">Dashboard</a>		
			</h5>
			<span>»</span>
			<h5>
				<a href="http://localhost/gitProjects/coreProj/admin/users_add.php">Users</a>			
			</h5>
			<span>»</span>
			<h5>Add user</h5>
		</div>
	
		<div class="dashboard-inner">
			<form name="add-user" id="add-user" method="post" action= "" >
			<div class="main-dash-summry Edit-profile">
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Username: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value="" class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>First Name: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value=""  class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Lastname: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="lastname" value="" class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Email: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="email" value=""  class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Password: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value="" class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Confirm Password: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value=""  class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
				
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Phone Number: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value="" class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Address: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value=""  class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Country: <e>*</e></label>
								<span class="reg_span">
									<select name="country" id="country" class="inputbox-main">
										<option value="">Select Country</option>
										<?php 
										if(count($countries) > 0){
											foreach($countries as $country){
												echo '<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
											}
										}
										
										?>
									</select>
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>State: <e>*</e></label>
								<span class="reg_span">
									<input type="text" name="username" value=""  class="inputbox-main">
								</span>
							</div>
						</div>
					</div>
				
				
					<div class="input-row">
						<div class="full">
							<div class="input-block edit_page">
								<label>Role: <e>*</e></label>
								<span class="reg_span">
									<select name="role_id" id="role" class="inputbox-main">
										<option value="">Select Role</option>
										<?php 
										if(count($roles) > 0){
											foreach($roles as $role){
												echo '<option value="'.$role['role_id'].'">'.$role['role_name'].'</option>';
											}
										}
										
										?>
									</select>
								</span>
							</div>
						</div>
					</div>
					<div class="input-row pull-right">
						<div class="full">
							<div class="input-block edit_page">
								<label>Status: <e>*</e></label>
								<span class="reg_span">
									<select name="role_id" id="role" class="inputbox-main">
										<option value="">Select Status</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</span>
							</div>
						</div>
					</div>
				
					<div class="footer_button footer_div">
					<div class="">
						<div class="full">
							<div class="input-block add-user-btn">
								<span class="">
									<input type="submit" class="btn-submit btn" value="Submit">
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

