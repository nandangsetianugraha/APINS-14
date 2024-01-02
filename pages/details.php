<?php $data="";?>
<?php include "layout/head.php"; ?>
<?php 
// Include and initialize DB class 
require_once 'DB.class.php'; 
$db = new DB(); 
 
// If record ID is available in the URL 
if($tipe==''){
	header("Location: gallery"); 
    exit();  
}else{ 
    // Fetch data from the database 
    $conditions['where'] = array( 
        'id' => $tipe 
    ); 
    $conditions['return_type'] = 'single'; 
    $proData = $db->getRows($conditions);    
} 
?>
</head>

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
					<?php if($tipe==''){ ?>
					<?php }else{ ?>
					<div class="row align-items-start col-md-6">
						<div class="col col-md-12">
							<h5 class="float-start">Product Details</h5>
							
							<div class="float-end">
								<a href="../gallery" class="btn btn-secondary"><-- Back</a>
							</div>
						</div>
						
						<div class="col col-md-12">
							<div class="mb-3">
								<label class="form-label">Title</label>
								<p><?php echo !empty($proData['title'])?$proData['title']:''; ?></p>
							</div>
							<div class="mb-3">
								<label class="form-label">Description</label>
								<p><?php echo !empty($proData['description'])?$proData['description']:''; ?></p>
							</div>
							<div class="mb-3">
								<label class="form-label">Images</label>
								<?php if(!empty($proData['images'])){ ?>
									<div class="image-grid">
									<?php foreach($proData['images'] as $imageRow){ ?>
										<div class="img-bx" id="imgbx_<?php echo $imageRow['id']; ?>">
											<img src="../uploads/<?php echo $imageRow['file_name']; ?>" width="120"/>
											<a href="javascript:void(0);" class="badge text-bg-danger" onclick="deleteImage(<?php echo $imageRow['id']; ?>)">delete</a>
										</div>
									<?php } ?>
									</div>
								<?php } ?>
							</div>
							<div class="mb-3">
								<label class="form-label">Status</label>
								<p><?php echo $proData['status'] == 1?'<span class="badge text-bg-success">Active</span>':'<span class="badge text-bg-danger">Inactive</span>'; ?></p>
							</div>
						</div>
					</div>
					<?php } ?>
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
