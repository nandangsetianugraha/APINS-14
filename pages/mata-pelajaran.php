<?php $data="Mata Pelajaran";?>
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
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title"><?=$data;?></h3>
									<div class="portlet-addon">
										<select id="kurikulum" name="kurikulum" class="form-select">
											<option value="0">Pilih Kurikulum</option>
											<?php 
											$sql4 = "select * from kurikulum";
											$query4 = $connect->query($sql4);
											while($nk=$query4->fetch_assoc()){
												$nkur = $nk['nama_kurikulum'];
												echo '<option value="'.$nkur.'">'.$nkur.'</option>';
											}	
											?>
										</select>    
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-lg-4 col-sm-6">
											<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#info"><i class="fas fa-plus"></i> Mata Pelajaran</button>
										</div>
									</div>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Mata Pelajaran</th>
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
				<form class="form-horizontal" action="modul/setting/tambah-mapel.php" autocomplete="off" method="POST" id="buatmapel">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/update-mapel.php" autocomplete="off" method="POST" id="ubahproyek">
				<div class="fetched-data1"></div>
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
	var TabelRombel;
	$(document).ready(function(){
		var kur = $('#kurikulum').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/setting/mapel.php?kurikulum="+kur
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#kurikulum').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kur = $('#kurikulum').val();
			$("#nilaiHarian").hide();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/setting/mapel.php?kurikulum="+kur
			});
		});
		
		$('#info').on('show.bs.modal', function (e) {
            var kur = $('#kurikulum').val();
			
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_mapel.php',
				data :  'jns='+ kur,
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
		$('#edit-info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
            var kur = $(e.relatedTarget).data('kur');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/e_mapel.php',
				data :  'rowid='+ rowid+'&jns='+kur,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data1').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#buatmapel").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
				success:function(response) {
					$("#info").modal('hide');
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						var kur = $('#kurikulum').val();
						$('#datatable-1').DataTable().ajax.reload();
						//$("#createKDFormk")[0].reset();
						// this function is built in function of datatables;
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for Tujuan
		
		$("#ubahproyek").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					$("#edit-info").modal('hide');
					if(response.success == true) {
						toastr.success(response.messages);
						var kur = $('#kurikulum').val();
						TabelRombel.ajax.reload(null, false);
					} else {
						toastr.error(response.messages);
					}
				} // /success
			}); // /ajax
			return false;
		});
	});	
		
	
	function hapusMapel(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Mata Pelajaran ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				var kur = $('#kurikulum').val();
				$.ajax({
						url: 'modul/setting/hapus-mapel.php',
						type: 'post',
						data: {member_id : id,jns : kur},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								TabelRombel.ajax.reload(null, false);
								toastr.success(response.messages);
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
