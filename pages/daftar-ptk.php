<?php $data="Daftar PTK";?>
<?php include "layout/head.php"; 
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
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
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title"></h3>
									<div class="portlet-addon">
										<div class="row">
											<div class="col-9">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-text">
															<i class="fas fa-user-alt"></i>
														</span>
														<select class="form-select" id="stst" name="stst">
															<option value="1">Aktif</option>
															<option value="0">Non Aktif</option>
														</select>
													</div>
												</div> 
											</div>
											<div class="col-3">
												<a href="tambah-ptk" class="btn btn-effect-ripple btn-xs btn-primary"><i class="fa fa-plus"></i></a>
											</div>
										</div>
										
										
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<form class="row g-3 mb-2" action="<?=base_url();?>pages/impor_ptk.php" method="post"
											name="frmExcelImport" id="frmExcelImport"
											enctype="multipart/form-data" onsubmit="return validateFile()">
											<div class="col-md-6">
												<input type="file" name="file" id="file" class="file"
															accept=".xls,.xlsx">
											</div>
											<div class="col-md-3">
												<button class="btn btn-primary" type="submit" id="submit" name="import"><i class="fas fa-print"></i> Impor Data PTK</button>
											</div>
											<div class="col-md-3">
												
											</div>
											
										</form>
										<br/>
										<p>Untuk Format Impor PTK <a href="<?=base_url();?>pages/template/format_ptk.xlsx">Format PTK</a></p>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th></th>
												<th>Nama</th>
												<th>NIY/NIGK</th>
												<th>NUPTK</th>
												<th>Tempat Tanggal Lahir</th>
												<th></th>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
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
	<div class="modal fade" id="info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="updateTemaForm" method="POST" action="modul/kepegawaian/ubah-level.php" class="form">
				<div class="fetched-data"></div>
				</form>
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
	<script>
	var TabelRombel;
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
	//$('#waktu').timepicker({ timeFormat: 'HH:mm' });
	$(document).ready(function(){
		var stst = $('#stst').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
            "stateSave": true,
			"ajax": "modul/kepegawaian/daftar-ptk.php?status="+stst+"&smt="+smt+"&tapel="+tapel
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		
		$('#stst').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var stst = $('#stst').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/kepegawaian/daftar-ptk.php?status="+stst+"&smt="+smt+"&tapel="+tapel
			});
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mp.php',
				data :  'kelas=0',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
				}
			});
		});
		
		
		
	});	
	</script>
</body>
</html>
