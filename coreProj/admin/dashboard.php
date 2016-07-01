<?php

	if($_SESSION['is_logged_in'] === '1') {
	   header("Location: dashboard.php");
	   exit;
	}

	include('header.php'); 

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
										'.$this->session->flashdata('error').'</td>
								</tr>
								</table>
							</div>
						<div id="message-green" style="display:none;">
								<table cellspacing="0" cellpadding="0" style="width:100%;border:0px;">
									<tbody>
										<tr>
											<td style="border:0px;" class="green-left">
												<span class="msg_green"><i class="fa fa-times" aria-hidden="true"></i></span>
												'.$this->session->flashdata('success').'
											</td>
											
										</tr>
									</tbody>
								</table>
							</div>



						<div class="dashboard-heading">
							<h2>Dashboard</h2>
						</div>
						<div class="dashboard-inner">
							
						</div>
	
				</div>
					<!-- Main Content Ends Here -->
			</div>
		</div>	
	</div>
</div>
				
				<?php include('footer.php'); ?>
