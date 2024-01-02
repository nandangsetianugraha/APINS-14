<?php $data="Gallery";?>
<?php include "layout/head.php"; ?>
</head>
<?php 
// Include and initialize DB class 
require_once 'DB.class.php'; 
$db = new DB(); 
 
// Fetch existing records from database 
$products = $db->getRows(); 
 
// Get session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>
<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<?php include "layout/aside.php";?>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<?php include "layout/header.php";?>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<?php if(!empty($statusMsg)){ ?>
					<div class="col-xs-12">
						<div class="alert alert-<?php echo $statusMsgType; ?>"><?php echo $statusMsg; ?></div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-12 head">
							<h5 class="float-start">Foto Kegiatan</h5>
							<!-- Add link -->
							<div class="float-end">
								<a href="addEdit" class="btn btn-success"><i class="plus"></i> Kegiatan Baru</a>
							</div>
						</div>
						
						<!-- List the products -->
						<table class="table table-striped table-bordered">
							<thead class="thead-dark">
								<tr>
									<th width="2%">#</th>
									<th width="10%"></th>
									<th width="20%">Kegiatan</th>
									<th width="30%">Deskripsi</th>
									<th width="15%">Created</th>
									<th width="8%">Status</th>
									<th width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(!empty($products)){ 
									foreach($products as $row){ 
										$statusLink = ($row['status'] == 1)?'postAction/block/'.$row['id']:'postAction/unblock/'.$row['id']; 
										$statusTooltip = ($row['status'] == 1)?'Click to Inactive':'Click to Active'; 
								?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td class="text-center">
										<?php if(!empty($row['file_name'])){ ?>
											<img src="<?php echo $uploadDir.$row['file_name']; ?>" width="120" />
										<?php } ?>
									</td>
									<td><?php echo $row['title']; ?></td>
									<td>
										<?php  
										$description = strip_tags($row['description']); 
										echo (strlen($description)>140)?substr($description, 0, 140).'...':$description; 
										?>
									</td>
									<td><?php echo $row['created']; ?></td>
									<td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge text-bg-<?php echo ($row['status'] == 1)?'success':'danger'; ?>"><?php echo ($row['status'] == 1)?'Active':'Inactive'; ?></span></a></td>
									<td>
										<a href="details/<?php echo $row['id']; ?>" class="btn btn-sm btn-primary btn-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
										<a href="addEdit/<?php echo $row['id']; ?>" class="btn btn-sm btn-warning btn-icon"><i class="fa fa-pencil"></i></a>
										<a href="postAction/delete/<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-icon" onclick="return confirm('Are you sure to delete record?')?true:false;"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php } }else{ ?>
								<tr><td colspan="7">No record(s) found...</td></tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			<?php include "layout/footer.php";?>
			<!-- END Footer -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	
</body>
</html>
