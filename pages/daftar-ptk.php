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
														<select class="form-select" name="stst" id="stst">
															<?php 
															$sql2 = "select * from jns_mutasi";
															$query2 = $connect->query($sql2);
															while($nk=$query2->fetch_assoc()){
															?>
															<option value="<?=$nk['id_mutasi'];?>" <?php if($nk['id_mutasi']==1) echo 'selected';?>><?=$nk['nama_mutasi'];?></option>
															<?php };?>
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
	
	<div class="modal fade" id="mutasikan">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/kepegawaian/mutasi-ptk.php" autocomplete="off" method="POST" id="mutasiptk">
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
		
		$('#mutasikan').on('show.bs.modal', function (e) {
			var siswa = $(e.relatedTarget).data('siswa');
			var smt = $(e.relatedTarget).data('smt');
			var tapel = $(e.relatedTarget).data('tapel');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'get',
				url : 'modul/kepegawaian/e_mutasi.php',
				data :  'ptk='+siswa+'&smt='+smt+'&tapel='+tapel,
				beforeSend: function()
				{	
					$(".fetched-data1").html('<div class="modal-header"><button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="fa fa-times"></i></button></div><div class="modal-body"><div class="portlet"><div class="portlet-body"><i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...</div></div></div>');
				},
				success : function(data){
					$('.fetched-data1').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		
		$("#mutasiptk").unbind('submit').bind('submit', function() {
			var form = $(this);
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function()
				{	
					$(".fetched-data1").html('<div class="modal-header"><button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="fa fa-times"></i></button></div><div class="modal-body"><div class="portlet"><div class="portlet-body"><i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...</div></div></div>');
				},
				success:function(response) {
					if(response.success == true) {
						const Toast = Swal.mixin({
						  toast: true,
						  position: 'top-right',
						  iconColor: 'white',
						  customClass: {
							popup: 'colored-toast'
						  },
						  showConfirmButton: false,
						  timer: 1500,
						  timerProgressBar: true
						})
						Toast.fire({
						  icon: 'success',
						  title: response.messages
						})
						$("#mutasikan").modal('hide');
						TabelRombel.ajax.reload(null, false);
					} else {
						const Toast = Swal.mixin({
						  toast: true,
						  position: 'top-right',
						  iconColor: 'white',
						  customClass: {
							popup: 'colored-toast'
						  },
						  showConfirmButton: false,
						  timer: 1500,
						  timerProgressBar: true
						})
						Toast.fire({
						  icon: 'success',
						  title: response.messages
						})
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		
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
	
	function hapusPTK(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus PTK ini? Akan dihapus juga akun dari PTK yang bersangkutan!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/kepegawaian/hapus-ptk.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								toastr.success(response.messages);
								TabelRombel.ajax.reload(null, false);
								$("#info").modal('hide');
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
