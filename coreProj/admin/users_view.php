<?php include('header.php');

$base_url = 'http://localhost/gitProjects/coreProj/admin/';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : ''; 
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : ''; 

$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'date_added'; 
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'desc'; 
//$searchby = isset($_REQUEST['searchby']) ? $_REQUEST['searchby'] : ''; 
$search_term = isset($_REQUEST['search_term']) ? $_REQUEST['search_term'] : ''; 
$pageno = isset($_REQUEST['page']) ? $_REQUEST['page'] : ''; 

if($action == 'delete'){
	$app->tablename = 'users';
	$res = $app->delete(array('id' => $id));
	$success= 'You have deleted the user successfully.';	
}

if(!empty($orderby)){
	$sort = $orderby . ' ' . $order;
	if($order == 'desc'){
		$order = 'asc';
	}else if($order=='asc'){
		$order = 'desc';
	}	
}

$conditions = array();
if(!empty($search_term)){
	$operator = 'OR';
	$conditions = array('firstname LIKE' => '%'.$search_term.'%', 'email LIKE ' => '%'.$search_term.'%');
}


$app->tablename = 'users';
$total_results = $app->find_count( array('conditions' => $conditions, 'operator' =>$operator ) ); 
$per_page = 2;   
$total_pages = ceil($total_results / $per_page);

if (isset($_GET['page'])) {
    $show_page = $_GET['page']; //current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
	// display pagination
	$page = intval($_GET['page']);
	$tpages=$total_pages;
	if ($page <= 0)
	$page = 1;
	
	$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
    $pagination =  '<div class="pagination"><ul>';
    if ($total_pages > 1) {
        $pagination .= GlobalClass::paginate($reload, $show_page, $total_pages);
    }
  
$users = $app->find( array('*'), array('conditions' => $conditions, 'sort' => $sort, 'start' => $start, 'limit' => $end, 'operator' =>$operator ) );  ?>

	<div class="border-div" id="border-div"></div>	
	<div class="clr"></div>
	<div class="regi-main">
		<div id="wrapper2">
			<div id="container">
				<div id="header">
					<!-- Main Content Starts Here -->
					<?php if(isset($error)): ?>
					<div id="content">
						<div id="message-red" style="display:block">
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
						<div id="message-green" style="display:block;">
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


	<div class="dashboard-heading">
		<h2>title</h2>
	</div>
	<div class="dashboard-inner">
		<div class="dash-search user_search">
			
			<form name="search_form" id="search_form" method="GET" action="">
				<input type='text' class='list-search' name="search_term" value="<?php echo $search_term; ?>" placeholder='Name / Email' />
				<button type="submit" class="btn-submit btn">
					<span> <i class="fa fa-search search-icon"></i></span>
					Search
				</button>
			</form>
		</div>
		<div class="main-dash-summry Edit-profile nopadding11">
			<div class="my_table_div">
				<table class="fixes_layout">
					<thead>
						<tr>
							<th width="8%"> <h1> S. No. </h1> </th>
							<th width="15%">
								<h1>
									<a class='underline_classs' href="<?php echo $base_url; ?>/users_view.php?orderby=firstname&order=<?php echo $order; ?>" >Name </a>
								</h1>
							</th>
							<th width="20%">							
								<h1>
									<a href="<?php echo $base_url; ?>/users_view.php?orderby=email&order=<?php echo $order; ?>" >Email Id </a>
								</h1>								
							</th>
							<th width="32%">
								<h1> Address </h1>
							</th>
							<th width="20%">								
								<h1>
								<a href="<?php echo $base_url; ?>/users_view.php?orderby=date_added&order=<?php echo $order; ?>" >Posted On </a>
								</h1>
							</th>
							<th width="7%"> <h1 class=""> Action </h1> </th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						if(count($users) > 0){
							foreach($users as $row){
								$address = !empty($row['address']) ? $row['address'].', ' : '';
								
								$city = !empty($row['city']) ? $row['city'].', ' : '';
							
								$state_name = !empty($row['state']) ? GlobalClass::get_state_name($row['state']).', ': '';
								
								$country_name = !empty($row['country']) ? GlobalClass::get_country_name($row['country']).' ': '';
								$full_address = $address.$city.$state_name.$country_name;  ?>
								<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $full_address; ?></td>
									<td><?php echo date('F j, Y', strtotime($row['date_added'])); ?></td>
									<td class="action-main-block">
										<a href="<?php echo $base_url; ?>users_add.php?action=edit&id=<?php echo $row['id']; ?>"> <i aria-hidden="true" class="fa fa-pencil"></i></a>
										<a onclick="return alertDeletion()" href="<?php echo $base_url; ?>users_view.php?action=delete&id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</td>
								</tr>
					<?php
							}
						}
						
						?>
						
					</tbody>
				</table>
					<!--end-->
			</div><!-- my_table_div -->
			<div class='pagination' style='text-align:center'>
				<?php echo $pagination; ?>
				<!--strong>1</strong>
				<a rel="next" data-ci-pagination-page="2" href="http://localhost/helpu/admin/owners/posted_jobs/1/0/desc/sort/date">2</a>
				<a rel="next" data-ci-pagination-page="2" href="http://localhost/helpu/admin/owners/posted_jobs/1/0/desc/sort/date">&gt;</a-->
			</div>
		</div>
	</div>
	
</div>
					<!-- Main Content Ends Here -->
				</div>	</div>	</div>	</div>
<?php include('footer.php'); ?>
