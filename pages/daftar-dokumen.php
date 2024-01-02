<?php $data="Daftar Dokumen";?>
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
									<input type="hidden" name="ptkid" id="ptkid" class="form-control" value="<?=$bioku['ptk_id'];?>">
								</div>
								<div class="portlet-body">
									
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Tanggal</th>
												<th>Judul</th>
												<th>Dokumen</th>
												<th>Uploader</th>
												<th></th>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
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
		var ptkid = $('#ptkid').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		<?php if($level==11){ ?>
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/dokumen/daftar-dokumen.php?ptkid=0"
		});
		<?php }else{ ?>
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/dokumen/daftar-dokumen.php?ptkid="+ptkid
		});
		<?php } ?>
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		
		
		
		
	});	
	function removeDokumen(id = null) {
			if(id) {
				// click on remove button
				
				Swal.fire({
				  title: 'Yakin dihapus?',
				  text: "Apakah anda yakin menghapus Dokumen ini?",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, Hapus!'
				}).then((result) => {
				  if (result.isConfirmed) {
					$.ajax({
							url: '<?=base_url();?>modul/dokumen/hapus-dokumen.php',
							type: 'post',
							data: {member_id : id},
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {						
									// refresh the table
									toastr.success(response.messages);
									TabelRombel.ajax.reload(null, false);
								} else {
									toastr.error(response.messages);
								}
							}
						});
				  }
				})
				
			} else {
				Swal.fire("Kesalahan","Error Sistem","error");
			}
		}
	</script>
</body>
</html>
