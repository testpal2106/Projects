<?php include('header.php'); ?>

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
		<h2>title</h2>
	</div>
	<div class="dashboard-inner">
		<div class="dash-search user_search">
			<input type='text' class='list-search' placeholder='Name / Email' />
			<button class="btn-submit btn">
				<span> <i class="fa fa-search search-icon"></i></span>
				Search
			</button>
		</div>
		<div class="main-dash-summry Edit-profile nopadding11">
			<div class="my_table_div">
				<table class="fixes_layout">
					<thead>
						<tr>
							<th width="8%"> <h1 class=""> S. No. </h1> </th>
							<th width="15%">
								<a class='underline_classs' href='#'>
									<h1 class=""> 
										Name 
									</h1>
								</a>
							</th>
							<th width="20%">
								<a class='underline_classs' href='#'>
									<h1 class=""> 
										Email Id
									</h1>
								</a>
							</th>
							<th width="32%">
								<h1 class=""> Message </h1>
							</th>
							<th width="20%">
								<a class='underline_classs' href='#'>
									<h1 class=""> 
										Posted On
									</h1>
								</a>
							</th>
							<th width="7%"> <h1 class=""> Action </h1> </th>
						</tr>
					</thead>
					<tbody>
						
						<tr>
							<td>5</td>
							<td>test</td>
							<td>test@gmail.com</td>
							<td>Message Message Message MessageMessageMessage Message Message</td>
							<td>Date</td>
							<td class="action-main-block">
								<i aria-hidden="true" class="fa fa-eye"></i>
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</td>
						</tr>
					</tbody>
				</table>
					<!--end-->
			</div><!-- my_table_div -->
			<div class='pagination' style='text-align:center'>
				<strong>1</strong>
				<a rel="next" data-ci-pagination-page="2" href="http://localhost/helpu/admin/owners/posted_jobs/1/0/desc/sort/date">2</a><a rel="next" data-ci-pagination-page="2" href="http://localhost/helpu/admin/owners/posted_jobs/1/0/desc/sort/date">&gt;</a>
			</div>
		</div>
	</div>
	
</div>
					<!-- Main Content Ends Here -->
				</div>	</div>	</div>	</div>
<?php include('footer.php'); ?>
