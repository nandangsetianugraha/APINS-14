<?php 
// Include and initialize DB class 
require_once 'DB.class.php'; 
$db = new DB(); 
 
$postData = $proData = array(); 
 
// Get session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
 
// Get posted data from session 
if(!empty($sessData['postData'])){ 
    $postData = $sessData['postData']; 
    unset($_SESSION['sessData']['postData']); 
} 
 
// Fetch data from the database 
if(!empty($tipe)){ 
    $conditions['where'] = array( 
        'id' => $tipe 
    ); 
    $conditions['return_type'] = 'single'; 
    $proData = $db->getRows($conditions); 
} 
 
// Pre-filled data 
$proData = !empty($postData)?$postData:$proData; 
 
// Define action 
$actionLabel = !empty($tipe)?'Ubah Foto Kegiatan':'Tambah Foto Kegiatan'; 
$data = !empty($tipe)?'Ubah Foto Kegiatan':'Tambah Foto Kegiatan';  
?>
<?php include "layout/head.php"; ?>
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
					
							<div class="float-end">
								<a href="<?=base_url();?>gallery" class="btn btn-secondary">Back</a>
							</div>
						
						<!-- Display status message -->
						<?php if(!empty($statusMsg)){ ?>
						
							<div class="alert alert-<?php echo $statusMsgType; ?>"><?php echo $statusMsg; ?></div>
						
						<?php } ?>
						<br/>
						
							<form method="post" action="<?=base_url();?>postAction" enctype="multipart/form-data">
								<div class="mb-3">
									<label class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo !empty($proData['waktu'])?$proData['waktu']:date('Y-m-d'); ?>">
								</div>
                                <div class="mb-3">
									<label class="form-label">Title</label>
									<input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo !empty($proData['title'])?$proData['title']:''; ?>" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Description</label>
                                    <textarea data-quilljs placeholder="Please enter text" name="description">
                                    <?php echo !empty($proData['description'])?$proData['description']:''; ?></textarea>
								</div>
								<div class="mb-3">
									<label class="form-label">Images</label>
									<input type="file" name="image_files[]" class="form-control" accept="image/*" multiple ><br/>

									<?php if(!empty($proData['images'])){ ?>
										<!-- BEGIN Carousel -->
										<div class="row row-cols-1 row-cols-md-3 g-3">
											<?php foreach($proData['images'] as $imageRow){ ?>
												<div class="col">
												<!-- BEGIN Card -->
												<div class="img-bx" id="imgbx_<?php echo $imageRow['id']; ?>">
													<div class="card h-100">
														<img src="<?=base_url();?>uploads/<?php echo $imageRow['file_name']; ?>" width="120px" class="card-img-top" alt="Card image">
														<div class="card-footer">
															<a href="javascript:void(0);" class="btn btn-sm btn-danger btn-icon" onclick="deleteImage(<?php echo $imageRow['id']; ?>)"></a>
														</div>
													</div>
												</div>
												</div>
												<!-- END Card -->
											<?php } ?>
										</div>
										<!-- END Carousel -->
										
									<?php } ?>
								</div>
								<div class="mb-3">
									<label class="form-label">Status</label>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="status" id="status1" value="1" <?php echo !empty($proData['status']) || !isset($proData['status'])?'checked':''; ?>>
										<label class="form-check-label" for="status1">Active</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="status" id="status2" value="0" <?php echo isset($proData['status']) && empty($proData['status'])?'checked':''; ?>>
										<label class="form-check-label" for="status2">Inactive</label>
									</div>
								</div>
								<input type="hidden" name="id" value="<?php echo !empty($proData['id'])?$proData['id']:''; ?>">

								<input type="submit" name="dataSubmit" class="btn btn-primary" value="Submit">
							</form>
						
					
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
    <script src="<?=base_url();?>assets/js/quill-textarea.js"></script>
	<script>
    var isRtl = $("html").attr("dir") === "rtl";
	var direction = isRtl ? "right" : "left";
    (function() {
    quilljs_textarea('.quilljs-textarea', {
    modules: { toolbar: [
        ['bold', 'italic', 'underline'],        // toggled buttons
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'align': [] }],
    ]}, 
    theme: 'snow',
    });
})();
    $("#tanggal").datepicker({ 
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: direction, 
		todayHighlight: true 
	});
	function deleteImage(row_id) {
		if(row_id && confirm('Are you sure to delete image?')){
			const img_element = document.getElementById("imgbx_"+row_id);

			img_element.setAttribute("style", "opacity:0.5;");

			fetch("../pages/ajax_request.php", {
				method: "POST",
				headers: { "Content-Type": "application/json" },
				body: JSON.stringify({ request_type:'image_delete', row_id: row_id }),
			})
			.then(response => response.json())
			.then(data => {
				if (data.status == 1) {
					img_element.remove();
				} else {
					alert(data.msg);
				}
				img_element.setAttribute("style", "opacity:1;");
			})
			.catch(console.error);
		}
	}
	</script>
</body>
</html>
