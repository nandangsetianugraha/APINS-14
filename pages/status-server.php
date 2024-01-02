<?php $data="Status Server";?>
<?php include "layout/head.php"; ?>
</head>
<?php  
$sql = "SELECT * FROM setting_dokumen";
$querys = $connect->query($sql);
$row = $querys->fetch_assoc();
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
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							
                                            <div class="portlet mb-0">
												<div class="portlet-body">
													<nav class="mb-3">
														<!-- BEGIN Nav -->
														<div class="nav nav-tabs" id="nav3-tab">
															<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
															<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
															<a class="nav-item nav-link active" id="nav3-home-tab" data-bs-toggle="tab" href="#nav3-home">Server</a>
															<a class="nav-item nav-link" id="nav3-profile-tab" data-bs-toggle="tab" href="#nav3-profile">Konfigurasi Lainnya</a>
															<a class="nav-item nav-link" id="nav3-contact-tab" data-bs-toggle="tab" href="#nav3-contact">Pengembangan</a>
														</div>
														<!-- END Nav -->
													</nav>
													<!-- BEGIN Tab -->
													<div class="tab-content" id="nav3-tabContent">
														<div class="tab-pane fade show active" id="nav3-home">
															<form class="d-grid gap-3" action="modul/setting/update-server.php" autocomplete="off" method="POST" id="ubahForm" autocomplete="off">
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="ptapel" name="ptapel">
                                                                            <option>Pilih Tahun Ajaran</option>
                                                                            <?php 
                                                                            $sql4 = "select * from tapel order by nama_tapel asc";
                                                                            $query4 = $connect->query($sql4);
                                                                            $ak=0;
                                                                            while($nk=$query4->fetch_assoc()){
                                                                                if($tapel==$nk['nama_tapel']){
                                                                                    $stt="selected";
                                                                                }else{
                                                                                    $stt='';
                                                                                };
                                                                                echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahTema"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#hapusTema"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Semester</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="psmt" name="psmt">
                                                                            <option value="0">Pilih Semester</option>
                                                                            <option value="1" <?php if($smt==1) echo "selected"; ?>>Semester 1</option>
                                                                            <option value="2" <?php if($smt==2) echo "selected"; ?>>Semester 2</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Perawatan</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="pstatus" name="pstatus">
                                                                            <option>Pilih Perawatan</option>
                                                                            <option value="0" <?php if($maintenis==0) echo "selected"; ?>>Tidak</option>
                                                                            <option value="1" <?php if($maintenis==1) echo "selected"; ?>>Ya</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tutup Dokumen</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="pdok" name="pdok">
                                                                            <option value="0" <?php if($row['tutup']==0) echo "selected"; ?>>Tidak</option>
                                                                            <option value="1" <?php if($row['tutup']==1) echo "selected"; ?>>Ya</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal dan Waktu</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" name="twaktu" value="<?=$row['tanggal'];?>"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 text-end mt-3">
                                                                        <button type="submit" class="btn btn-primary modal-confirm">Simpan</button>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </form>
														</div>
														<div class="tab-pane fade" id="nav3-profile">
															<p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>
														</div>
														<div class="tab-pane fade" id="nav3-contact">
															<p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containLorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
														</div>
													</div>
													<!-- END Tab -->
												</div>
											</div>

							
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
	<div class="modal fade" id="tambahTema">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tahun Ajaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="createTemaForm" method="POST" action="modul/setting/tambahtapel.php" class="form">
				<div class="modal-body">
					<div class="form-group form-group-default">
					<label>Tahun Ajaran</label>
						<input type="text" name="nama_tapel" autocomplete=off class="form-control" placeholder="Tahun Ajaran">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="hapusTema">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Hapus Tahun Ajaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="createTapelForm" method="POST" action="modul/setting/hapus-tapel.php" class="form">
				<div class="modal-body">
					<div class="form-group form-group-default">
					<label>Tahun Ajaran</label>
						<select class="form-select" id="stapel" name="stapel">
							<option>Pilih Tahun Ajaran</option>
							<?php 
							$sql4 = "select * from tapel order by nama_tapel asc";
							$query4 = $connect->query($sql4);
							$ak=0;
							while($nk=$query4->fetch_assoc()){
								if($tapel==$nk['nama_tapel']){
									$stt="selected";
								}else{
									$stt='';
								};
							echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
							}	
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Hapus</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
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
	var isRtl = $("html").attr("dir") === "rtl";
	var direction = isRtl ? "right" : "left";
	$("#tanggal").datepicker({ 
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: direction, 
		todayHighlight: true 
	});
	
	$("#ubahForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
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
	$("#createTemaForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahTema").modal('hide');
					var tapel=$('#tapel').val();
					$.ajax({
						type : 'get',
						url : 'modul/setting/daftar-tapel.php',
						data :  'tapel='+ tapel,
						success : function(data){
							$("#ptapel").html(data);
						}
					});
					$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	$("#createTapelForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#hapusTema").modal('hide');
					var tapel=$('#tapel').val();
					$.ajax({
						type : 'get',
						url : 'modul/setting/daftar-tapel.php',
						data :  'tapel='+ tapel,
						success : function(data){
							$("#ptapel").html(data);
							$("#stapel").html(data);
						}
					});
					//$("#createTemaForm")[0].reset();
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
