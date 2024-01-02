<?php $data="Kompetensi Dasar";?>
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
							<?php if($kurikulum=='Kurikulum Merdeka'){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Khusus Kurikulum 2013!!</div>
							</div>
							<?php }else{ ?>
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Kompetensi Dasar</h3>
									<div class="portlet-addon">
										    <?php if($level==96){?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and pai='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												$ak=0;
												while($nk=$query4->fetch_assoc()){
													$ac=substr($nk['nama_rombel'],0,1);
													if($ac==$ak){
														
													}else{
														$ak=$ac;
														echo '<option value="'.$ac.'">Kelas '.$ac.'</option>';
													}
												}	
												?>
											</select>
											<?php }elseif($level==95){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and penjas='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												$ak=0;
												while($nk=$query4->fetch_assoc()){
													$ac=substr($nk['nama_rombel'],0,1);
													if($ac==$ak){
														
													}else{
														$ak=$ac;
														echo '<option value="'.$ac.'">Kelas '.$ac.'</option>';
													}
												}	
												?>
											</select>
											<?php }elseif($level==94){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and inggris='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												$ak=0;
												while($nk=$query4->fetch_assoc()){
													$ac=substr($nk['nama_rombel'],0,1);
													if($ac==$ak){
														
													}else{
														$ak=$ac;
														echo '<option value="'.$ac.'">Kelas '.$ac.'</option>';
													}
												}	
												?>
											</select>
											<?php }elseif($level==11){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												$ak=0;
												while($nk=$query4->fetch_assoc()){
													$ac=substr($nk['nama_rombel'],0,1);
													if($ac==$ak){
														
													}else{
														$ak=$ac;
														echo '<option value="'.$ac.'">Kelas '.$ac.'</option>';
													}
												}	
												?>
											</select>
											<?php }elseif($level==98 or $level==97){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<option value="<?=substr($kelas,0,1);?>">Kelas <?=substr($kelas,0,1);?></option>
											</select>
											<?php }else{}; ?>
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-lg-4 col-sm-4">
											<select id="mp" name="mp" class="form-select">
												<option value="0">Pilih Mapel</option>
											</select>
										</div>
										<div class="col-lg-4 col-sm-4">
											<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#infop"><i class="fas fa-plus"></i> Pengetahuan</button>
										</div>
										<div class="col-lg-4 col-sm-4">
											<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#infok"><i class="fas fa-plus"></i> Ketrampilan</button>
										</div>
									</div>
									<hr>
									<!-- BEGIN Datatable -->
									<div class="row">
										<div class="col-lg-6 col-sm-12">
											<table id="datatable-1" class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th>KD</th>
														<th>Deskripsi</th>
														<th></th>
													</tr>
												</thead>
											</table>
										</div>
										<div class="col-lg-6 col-sm-12">
											<table id="datatable-2" class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th>KD</th>
														<th>Deskripsi</th>
														<th></th>
													</tr>
												</thead>
											</table>
										</div>
									
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
	<div class="modal fade" id="infop">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="KDPForm" method="POST" action="modul/administrasi/simpanKD.php" class="form">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="infok">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="KDKForm" method="POST" action="modul/administrasi/simpanKD.php" class="form">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="updateTemaForm" method="POST" action="modul/administrasi/updateKD.php" class="form">
				<div class="fetched-data2"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	var TabelP;
	var TabelK;
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
	$(document).ready(function(){
		var kelas = $('#kelas').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		var mp = $('#mp').val();
		TabelP = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/administrasi/kompetensi-dasar.php?kelas="+kelas+"&smt="+smt+"&aspek=3&mp=0"
		});
		TabelK = $("#datatable-2").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/administrasi/kompetensi-dasar.php?kelas="+kelas+"&smt="+smt+"&aspek=4&mp=0"
		});
		$('#caridata').on( 'keyup', function () {
			TabelP.search( this.value ).draw();
		} );
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mpl.php',
				data :  'kelas=' +kelas,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#mp").html(data);
					$('#status').unblock();
				}
			});
			TabelP = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/kompetensi-dasar.php?kelas="+kelas+"&smt="+smt+"&aspek=3&mp=0"
			});
			TabelK = $("#datatable-2").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/kompetensi-dasar.php?kelas="+kelas+"&smt="+smt+"&aspek=4&mp=0"
			});
		});
		$('#mp').change(function(){
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			TabelP = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/kompetensi-dasar.php?kelas="+kelas+"&smt="+smt+"&aspek=3&mp="+mp
			});
			TabelK = $("#datatable-2").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/kompetensi-dasar.php?kelas="+kelas+"&smt="+smt+"&aspek=4&mp="+mp
			});
			
		});
		$('#infop').on('show.bs.modal', function (e) {
            var kelas = $('#kelas').val();
			var mp = $('#mp').val();
			var smt = $('#smt').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/administrasi/modal-KD.php',
				data :  'rowid=3&kelas='+kelas+'&smt='+smt+'&mp='+mp,
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
		$('#infok').on('show.bs.modal', function (e) {
            var kelas = $('#kelas').val();
			var mp = $('#mp').val();
			var smt = $('#smt').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/administrasi/modal-KD.php',
				data :  'rowid=4&kelas='+kelas+'&smt='+smt+'&mp='+mp,
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
		$('#edit-info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/administrasi/edit-KD.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data2').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#KDPForm").unbind('submit').bind('submit', function() {
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
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						$('#datatable-1').DataTable().ajax.reload();
						$("#infop").modal('hide');
						//$("#createKDFormk")[0].reset();
						// this function is built in function of datatables;
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for Tujuan
		$("#KDKForm").unbind('submit').bind('submit', function() {
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
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						$('#datatable-2').DataTable().ajax.reload();
						$("#infok").modal('hide');
						//$("#createKDFormk")[0].reset();
						// this function is built in function of datatables;
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for Tujuan
		$("#updateTemaForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						toastr.success(response.messages);
						var kelas = $('#kelas').val();
						var smt=$('#smt').val();
						var mp=$('#mp').val();
						TabelP.ajax.reload(null, false);
						TabelK.ajax.reload(null, false);
						$("#edit-info").modal('hide');
					} else {
						toastr.error(response.messages);
					}
				} // /success
			}); // /ajax
			return false;
		});
	});	
		
	
	function removeKD(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus KD ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/administrasi/hapus-KD.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var kelas = $('#kelas').val();
								var smt=$('#smt').val();
								var mp=$('#mp').val();
								$('#datatable-1').DataTable().ajax.reload();
								$('#datatable-2').DataTable().ajax.reload();
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
