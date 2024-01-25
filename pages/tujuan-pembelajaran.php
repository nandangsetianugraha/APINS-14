<?php $data="Tujuan Pembelajaran";?>
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
							<?php if($kurikulum=='Kurikulum 2013'){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Khusus Kurikulum Merdeka!!</div>
							</div>
							<?php }else{ ?>
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Tujuan Pembelajaran</h3>
									<div class="portlet-addon">
										    <?php if($level==96){?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and pai='$idku' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
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
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and penjas='$idku' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
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
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and inggris='$idku' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
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
											<?php }elseif($level==11 || $level==93){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
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
									<div class="alert alert-outline-secondary">
										<div class="alert-icon">
											<i class="fa fa-lightbulb"></i>
										</div>
										<div class="alert-content">
											Tujuan Pembelajaran (TP) merupakan deskripsi pencapaian tiga aspek kompetensi (pengetahuan, keterampilan, sikap) murid yang perlu dibangun melalui satu atau lebih kegiatan pembelajaran
										</div>
									</div>
									<form class="row g-3">
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">Mata Pelajaran</label>
											<select id="mp" name="mp" class="form-select">
												<option value="0">Pilih Mapel</option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">Materi</label>
											<select id="materi" name="materi" class="form-select">
												<option value="0">Pilih Materi</option>
											</select>
										</div>
									</form>
									<hr>
									<div class="row">
										<div class="col-lg-2 col-sm-6">
											<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#info"><i class="fas fa-plus"></i> LM</button>
										</div>
									</div>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Tujuan Pembelajaran</th>
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
				<form class="form-horizontal" action="modul/administrasi/tambah-tujuan.php" autocomplete="off" method="POST" id="buatproyek">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/administrasi/update-tujuan.php" autocomplete="off" method="POST" id="ubahproyek">
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
	$(document).ready(function(){
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
		var kelas = $('#kelas').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		var mp = $('#mp').val();
		var materi = $('#materi').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/administrasi/tp.php?kelas="+kelas+"&smt="+smt+"&lm="+materi+"&mp="+mp
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			//$("#nilaiHarian").hide();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/lm.php?kelas="+kelas+"&smt="+smt+"&tapel="+tapel+"&mp=0"
			});
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mp.php',
				data :  'kelas='+kelas,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#mp").html(data);
					$("#materi").html('<select class="form-select" id="materi" name="materi"><option value="0">Pilih Materi</option></select>');
					$('#status').unblock();
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mapel</div>');
				}
			});
		});
		$('#mp').change(function(){
			var kelas = $('#kelas').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/materi.php',
				data :  'kelas='+kelas+'&smt='+smt+'&mp='+mp,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#materi").html(data);
					$('#status').unblock();
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mapel</div>');
				}
			});
			var materi = $('#materi').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/tp.php?kelas="+kelas+"&smt="+smt+"&lm=0&mp="+mp
			});
			
		});
		$('#materi').change(function(){
			var kelas = $('#kelas').val();
			var materi = $('#materi').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/tp.php?kelas="+kelas+"&smt="+smt+"&lm="+materi+"&mp="+mp
			});
			
		});
		$('#info').on('show.bs.modal', function (e) {
            var kelas = $('#kelas').val();
			var materi = $('#materi').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/administrasi/m_tujuan.php',
				data :  'kelas='+ kelas+"&smt="+smt+"&mapel="+mp+"&materi="+materi,
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
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/administrasi/e_tujuan.php',
				data :  'rowid='+ rowid,
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
		$("#buatproyek").unbind('submit').bind('submit', function() {
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
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						var mp = $('#mp').val();
						TabelRombel.ajax.reload(null, false);
					} else {
						Swal.fire("Kesalahan","Masih ada TP yang terdaftar pada LM ini!","error");
					}
				} // /success
			}); // /ajax
			return false;
		});
	});	
		
	
	function removeTujuan(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus TP ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/administrasi/hapus-tujuan.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var kelas = $('#kelas').val();
								var tapel = $('#tapel').val();
								var smt = $('#smt').val();
								var mp = $('#mp').val();
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
