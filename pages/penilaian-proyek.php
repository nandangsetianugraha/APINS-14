<?php $data="Penilaian Proyek";?>
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
									<h3 class="portlet-title">Penilaian Proyek</h3>
									<div class="portlet-addon">
										    <?php if($level==11){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
													echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
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
								<div class="portlet-body">
									<div class="alert alert-outline-secondary">
										
										<div class="alert-content">
											<div class="row">
											  <div class="col-3"><span class="badge badge-danger badge-square">BB</span> Belum Berkembang</div>
											  <div class="col-3"><span class="badge badge-warning badge-square">MB</span> Mulai Berkembang</div>
											  <div class="col-3"><span class="badge badge-info badge-square">BSH</span> Berkembang Sesuai Harapan</div>
											  <div class="col-3"><span class="badge badge-primary badge-square">BSB</span> Berkembang Sangat Baik</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6">
											<select class="form-select" id="proyek" name="proyek">
												<option value="0">Pilih Proyek</option>
												
											</select>
											
										</div>
										<div class="col-lg-6 col-sm-6">
											<select class="form-select" id="siswa" name="siswa">
												<option value="0">Pilih Siswa</option>
											</select>
										</div>
									</div>
									<hr>
									<!-- BEGIN Datatable -->
									<div id="nilaiHarian">
										<div class="alert alert-outline-secondary">
											<div class="alert-icon">
												<i class="fa fa-wrench"></i>
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
				<form class="form-horizontal" action="modul/proyek/tambahpeta.php" autocomplete="off" method="POST" id="buatproyek">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/proyek/ubahproyek.php" autocomplete="off" method="POST" id="ubahproyek">
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
		
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var proyek = $('#proyek').val();
			$.ajax({
				type : 'GET',
				url : 'modul/proyek/daftar-proyek.php',
				data :  'kelas='+kelas+'&proyek='+proyek+'&smt='+smt+'&tapel='+tapel,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
					$("#siswa").html('<option value="0">Pilih Siswa</option>');
					$("#proyek").html(data);
					$("#nilaiHarian").html('<div class="alert alert-outline-secondary"><div class="alert-icon"><i class="fa fa-wrench"></i></div><div class="alert-content">Silahkan Pilih Proyek!</div></div>');
				}
			});
		});
		$('#proyek').change(function(){
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var proyek = $('#proyek').val();
			$.ajax({
				type : 'GET',
				url : 'modul/proyek/daftar-siswa.php',
				data :  'kelas='+kelas+'&proyek='+proyek+'&smt='+smt+'&tapel='+tapel,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
					$("#siswa").html(data);
					$("#nilaiHarian").html('<div class="alert alert-outline-secondary"><div class="alert-icon"><i class="fa fa-wrench"></i></div><div class="alert-content">Silahkan Pilih Siswa!</div></div>');
				}
			});			
		});
		$('#siswa').change(function(){
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var proyek = $('#proyek').val();
			var siswa = $('#siswa').val();
			$.ajax({
				type : 'GET',
				url : 'modul/proyek/nilai-proyek.php',
				data :  'kelas='+kelas+'&proyek='+proyek+'&smt='+smt+'&tapel='+tapel+'&siswa='+siswa,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
					$("#nilaiHarian").html(data);
				}
			});
		});
		
	});	
		
	
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function savePilihan(siswa,kelas,tapel,smt,proyek,idel,dimensi,nilai) {
		// no change change made then return false
		// send ajax to update value
		$.ajax({
			url: "modul/proyek/savePilihan.php",
			cache: false,
			data:'id='+siswa+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel+'&proyek='+proyek+'&idel='+idel+'&dimensi='+dimensi+'&nilai='+nilai,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
					
				
			}          
	   });
	}
		
	</script>
</body>
</html>
