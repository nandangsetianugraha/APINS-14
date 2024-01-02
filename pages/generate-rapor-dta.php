<?php $data="Generate Rapor DTA";?>
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
							<?php if(($ab==1 or $ab==6) and $level<>11){ ?>
                            <div class="row g-0 align-items-center justify-content-center h-100">
                                <div class="col-md-8 col-lg-6 col-xl-4 text-center">
                                    <img src="<?=base_url();?>assets/images/error.svg" height="112">
                                    <h3 class="mb-3">Halaman Ini Saat Ini Tidak Tersedia</h3>
                                    <p class="mb-4">Ini bisa dikarenakan kesalahan teknis yang sedang kami perbaiki. <br/>Coba muat ulang halaman ini.</p>
                                    <button id="segarkan" class="btn btn-label-primary btn-lg btn-widest">Muat ulang Halaman</button>
                                </div>
                            </div>
                            <?php }else{ ?>
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title"><?=$data;?></h3>
									<div class="portlet-addon">
										    <?php if($level==11){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
													$ac=substr($nk['nama_rombel'],0,1);
													if($ac==1 or $ac==6){}else{
														echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
													}
												}	
												?>
												
											</select>
											<?php }elseif($level==98 or $level==97){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<option value="<?=$kelas;?>">Kelas <?=$kelas;?></option>
											</select>
											<?php }else{}; ?>
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body" id="status">
									<div class="alert alert-outline-secondary">
										<div class="alert-icon">
											<i class="fa fa-wrench"></i>
										</div>
										<div class="alert-content">Rumus Rapor = (Rerata Harian + PTS + 2 x PAS)/4</div>
									</div>
									<hr>
									<!-- BEGIN Datatable -->
									<div id="nilaiHarian">
											<div class="alert alert-primary">
												<div class="alert-icon">
													<i class="fa fa-archive"></i>
												</div>
												<div class="alert-content">Silahkan Pilih Rombel</div>
											</div>
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
				<form class="form-horizontal" action="modul/rapor/update-pengetahuan.php" autocomplete="off" method="POST" id="ubahproyek">
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
		
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			//var mp = $('#mp').val();
			//$("#nilaiHarian").hide();
			$.ajax({
				type : 'GET',
				url : 'modul/rapor/rapor-dtas.php',
				data :  'kelas='+kelas+'&smt='+smt+'&tapel='+tapel,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
					$("#nilaiHarian").html('<div class="alert alert-primary"><div class="alert-icon"><i class="fa fa-spinner fa-pulse fa-fw"></i></div><div class="alert-content">Loading ....</div></div>');
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#nilaiHarian").html(data);
					$('#status').unblock();
				}
			});
		});
		
		
		$(document).on('click', '#getRaport', function(e){
			e.preventDefault();
			var ukelas = $(this).data('kelas');
			var utapel = $(this).data('tapel');			// it will get id of clicked row
			var usmt = $(this).data('smt');
			var updid = $(this).data('pdid');
			$.ajax({
				type : 'POST',
				url : 'modul/rapor/simpan-rapor-dta.php',
				data :  'kelas='+ukelas+'&smt='+usmt+'&tapel='+utapel+'&pdid='+updid,
				dataType : 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success === true) {
						//$("#modalmateri").modal('hide');
						toastr.success(response.messages);
						//swal(response.messages, {buttons: false,timer: 2000,});
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						//var mp = $('#mp').val();
						//$("#nilaiHarian").hide();
						$.ajax({
							type : 'GET',
							url : 'modul/rapor/rapor-dtas.php',
							data :  'kelas='+kelas+'&smt='+smt+'&tapel='+tapel,
							beforeSend: function()
							{	
								$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
								$("#nilaiHarian").html('<div class="alert alert-primary"><div class="alert-icon"><i class="fa fa-spinner fa-pulse fa-fw"></i></div><div class="alert-content">Loading ....</div></div>');
							},
							success: function (data) {
								//jika data berhasil didapatkan, tampilkan ke dalam option select mp
								$("#nilaiHarian").html(data);
								$('#status').unblock();
							}
						});
					} else {
						Swal.fire("Kesalahan",response.messages,"error");
						//TabelRombel.ajax.reload(null, false);
					}  // /else
				} // success 
			});			
		});
		
		$('#edit-info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/rapor/e_rapor.php',
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
		
	});	
		
	</script>
</body>
</html>
