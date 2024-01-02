<?php $data="Hari Libur";?>
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
									<h3 class="portlet-title">Hari Libur</h3>
									<div class="portlet-addon">
										<div class="row">
											<div class="col-9">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-text">
															<i class="fas fa-user-alt"></i>
														</span>
														<select class="form-select" id="stst" name="stst">
															<option value="1">Verifikasi</option>
															<option value="0">Pending</option>
														</select>
													</div>
												</div> 
											</div>
											<div class="col-3">
												<button class="btn btn-effect-ripple btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTema"><i class="fa fa-plus"></i></button>
											</div>
										</div>
										
										
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Tanggal Awal</th>
												<th>Tanggal Akhir</th>
												<th>Keterangan</th>
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
	<div class="modal fade" id="editTema">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="updateTemaForm" method="POST" action="modul/setting/update-libur.php" class="form" autocomplete="off">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahTema">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form" action="modul/setting/tambah-libur.php" method="POST" id="tambahLibur" autocomplete="off">
						<div class="modal-header">
							<h5 class="modal-title">Hari Libur</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<div class="form-group form-group-default row">
								<div class="form-group col-md-6 border-top-0 pt-0">
									<label for="inputCity">Tanggal Awal</label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fas fa-calendar-alt"></i>
										</span>
										<input type="text" id="tanggal_awal" name="tanggal_awal" class="form-control"  required>
									</div>
								</div>
								<div class="form-group col-md-6 border-top-0 pt-0">
									<label for="inputCity">Tanggal Awal</label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fas fa-calendar-alt"></i>
										</span>
										<input type="text" id="tanggal_akhir" name="tanggal_akhir" class="form-control"  required>
									</div>
								</div>
							</div>
							<div class="form-group form-group-default">
								<label>Keterangan</label>
								<textarea class="form-control" id="keterangan" name="keterangan" ></textarea>
							</div>							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan</button>
						</div>
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
			"ajax": "modul/setting/daftar-libur.php"
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		
		$('#editTema').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/e_libur.php',
				data :  'rowid='+ rowid,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#updateTemaForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						TabelRombel.ajax.reload(null, false);
						$("#editTema").modal('hide');
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$('#tambahTema').on('show.bs.modal', function (e) {
            //menggunakan fungsi ajax untuk pengambilan data
			$('#tanggal_awal').datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true
			});
			$('#tanggal_akhir').datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true
			});
			
			$('#keterangan').text('');
		});
		$("#tambahLibur").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						TabelRombel.ajax.reload(null, false);
						$("#tambahTema").modal('hide');
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		
	});	
	
	function PopupCenter(pageURL, title,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	};
	function removeLibur(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin Menghapus Hari Libur ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-libur.php',
						type: 'post',
						data: {tema : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var stst = $('#stst').val();
								var tapel = $('#tapel').val();
								var smt = $('#smt').val();
								TabelRombel.ajax.reload(null, false);
								toastr.success(response.messages);
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
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
