<?php $data="Tambah PTK";?>
<?php include "layout/head.php"; 
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

<link rel="stylesheet" href="<?=base_url();?>assets/css/croppie.css" />
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
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							<?php if($level<>11){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Hanya Admin!!</div>
							</div>
							<?php }else{ ?>
							
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Tambah PTK</h3>
									<div class="portlet-addon">
									
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div id="dip">
										<div id="image_demo" style="width:350px; margin-top:30px"></div>
										<button class="btn btn-success crop_image">Crop & Upload Image</button>
									</div>
									<div class="row" id="dip2">
										<div class="col-md-3">
											<img src="<?=base_url();?>images/ptk/user-default.jpg" alt="avatar" id="blah"></b>
										</div>
										<div class="col-md-9">
											<div class="portlet" id="portlet1-profile">
												<div class="portlet-body">
													<form class="row g-3" action="modul/kepegawaian/tambah-ptk.php" autocomplete="off" method="POST" id="ubahForm">
														<div class="col-6">
															<label for="inputAddress" class="form-label">Nama Lengkap</label>
															<input type="text" class="form-control" name="nama">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Gelar</label>
															<input type="text" class="form-control" name="gelar">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">Tempat Lahir</label>
															<input type="text" class="form-control" name="tempat">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">Tanggal Lahir</label>
															<input type="text" class="form-control" data-provide="datepicker" id="tanggal" name="tanggal">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">Jenis Kelamin</label>
															<select name="jeniskelamin" class="form-select">
																<option value="L">Laki-laki</option>
																<option value="P">Perempuan</option>
															</select>
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">NIK</label>
															<input type="text" class="form-control" name="nik">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">NIY/NIGK</label>
															<input type="text" class="form-control" name="niynigk">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">NUPTK</label>
															<input type="text" class="form-control" name="nuptk">
														</div>
														<div class="col-12">
															<label for="inputAddress" class="form-label">Alamat</label>
															<input type="text" class="form-control" name="alamat">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Nomor HP</label>
															<input type="text" class="form-control" name="noHP">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">E-mail</label>
															<input type="text" class="form-control" name="email">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Jenis PTK</label>
															<select class="form-select" name="jenispegawai">
																<?php 
																$sql2 = "select * from jenis_ptk";
																$query2 = $connect->query($sql2);
																while($po=$query2->fetch_assoc()){
																?>
																<option value="<?=$po['jenis_ptk_id'];?>"><?=$po['jenis_ptk'];?></option>
																<?php } ?>
															</select>
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Status Kepegawaian</label>
															<select class="form-select" name="statuspegawai">
																<?php 
																$sql21 = "select * from status_kepegawaian";
																$query21 = $connect->query($sql21);
																while($po1=$query21->fetch_assoc()){
																?>
																<option value="<?=$po1['status_kepegawaian_id'];?>"><?=$po1['nama'];?></option>
																<?php } ?>
															</select>
														</div>
														<div class="row">
															<div class="col-md-12 text-end mt-3">
																<a href="<?=base_url();?>daftar-ptk" class="btn btn-danger">Kembali</a>
																<button type="submit" class="btn btn-primary">Simpan</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<!-- END Portlet -->
						</div>
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
	<!-- BEGIN Modal -->
	<div class="modal fade" id="uploadimageModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Upload & Crop Image</h4>
				</div>
				<div class="modal-body">
					<div id="image_demo" style="width:350px; margin-top:30px"></div>
					
				</div>
				<div class="modal-footer">
					<button class="btn btn-success crop_image">Crop & Upload Image</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambah-pengguna">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/kepegawaian/add-user.php" autocomplete="off" method="POST" id="adduser">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script src="<?=base_url();?>assets/js/croppie.js"></script>
	<script>
	var TabelRombel;
	$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
	$("#dip").hide(); 
	$("#dip2").show(); 
	toastr.options = {
			"closeButton": false,
			"debug": true,
			"newestOnTop": true,
			"progressBar": false,
			"positionClass": "toast-top-full-width",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": 300,
			"hideDuration": 1000,
			"timeOut": 2000,
			"extendedTimeOut": 500,
			"showEasing": "swing",
			"hideEasing": "swing",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
	$("#ubahForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#portlet1-profile').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#portlet1-profile').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						//setTimeout(function () {window.open("./","_self");},1000)
						//setTimeout(function () {window.open("./","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
	</script>
</body>
</html>
