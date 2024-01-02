<?php $data="Rekap Rapor Pengetahuan";?>
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
							<?php if($kurikulum=='Kurikulum Merdeka'){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Khusus Kurikulum 2013!!</div>
							</div>
							<?php }else{ ?>
							<!-- BEGIN Portlet -->
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Rapor Pengetahuan</h3>
									<div class="portlet-addon">
										<?php if($level==96){?>
										<select class="form-select" id="kelas" name="kelas">
											<option value="0">Pilih Rombel</option>
											<?php 
											$sql4 = "select * from rombel where tapel='$tapel' and pai='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
											$query4 = $connect->query($sql4);
											while($nk=$query4->fetch_assoc()){
												
											?>
											<option value="<?=$nk['nama_rombel'];?>"><?=$nk['nama_rombel'];?></option>
											<?php };?>
										</select>
										<?php }elseif($level==95){ ?>
										<select class="form-select" id="kelas" name="kelas">
											<option value="0">Pilih Rombel</option>
											<?php 
											$sql4 = "select * from rombel where tapel='$tapel' and penjas='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
											$query4 = $connect->query($sql4);
											while($nk=$query4->fetch_assoc()){
												
											?>
											<option value="<?=$nk['nama_rombel'];?>"><?=$nk['nama_rombel'];?></option>
											<?php };?>
										</select>
										<?php }elseif($level==94){ ?>
										<select class="form-select" id="kelas" name="kelas">
											<option value="0">Pilih Rombel</option>
											<?php 
											$sql4 = "select * from rombel where tapel='$tapel' and inggris='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
											$query4 = $connect->query($sql4);
											while($nk=$query4->fetch_assoc()){
												
											?>
											<option value="<?=$nk['nama_rombel'];?>"><?=$nk['nama_rombel'];?></option>
											<?php };?>
										</select>
										<?php }elseif($level==11){ ?>
										<select class="form-select" id="kelas" name="kelas">
											<option value="0">Pilih Rombel</option>
											<?php 
											$sql4 = "select * from rombel where tapel='$tapel' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
											$query4 = $connect->query($sql4);
											while($nk=$query4->fetch_assoc()){
												
											?>
											<option value="<?=$nk['nama_rombel'];?>"><?=$nk['nama_rombel'];?></option>
											<?php };?>
										</select>
										<?php }else{ ?>
										<select class="form-select" id="kelas" name="kelas">
											<option value="0">Pilih Rombel</option>
											<option value="<?=$kelas;?>"><?=$kelas;?></option>
										</select>
										<?php }; ?>
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body" id="status">
									<form class="row g-3">
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">Jenis Rapor</label>
											<select class="form-select" id="jns" name="jns">
												<option value="0">Pilih Rapor</option>
											</select>
											
										</div>
										<div class="col-md-6">
											
										</div>
									</form>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="rekaprapor" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th class="text-center">Nama Siswa</th>
												<?php 
												$sql1 = "select * from mapel order by id_mapel asc";
												$query1 = $connect->query($sql1);
												while ($row1 = $query1->fetch_assoc()) {
												?>
												<th class="text-center"><?=$row1['kd_mapel'];?></th>
												<?php } ?>
												<th class="text-center">Jumlah</th>
												<th class="text-center">Rerata</th>
												<th class="text-center">Rank</th>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
								</div>
							</div>
							<!-- END Portlet -->
							<?php } ?>
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
				<form id="ekskulForm" method="POST" action="modul/rapor/update-pengetahuan.php" class="form">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<!--<script type="text/javascript" src="<?=base_url();?>assets/app/pages/form/datepicker.js"></script>-->
	<script>
	var temaTable;
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
	var jns = $('#jns').val();
	var kelas=$('#kelas').val();
	var tapel=$('#tapel').val();
	var smt=$('#smt').val();
	
	
	
	$('#kelas').change(function(){
		//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
		var kelas=$('#kelas').val();
		
		$.ajax({
			type : 'GET',
			url : 'modul/rapor/jnsraport.php',
			data :  'kelas=' +kelas,
			beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
			success: function (data) {
				$('#status').unblock();
				//jika data berhasil didapatkan, tampilkan ke dalam option select mp
				$("#jns").html(data);
			}
		});
	});
	$('#jns').change(function(){
		//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
		var jns = $('#jns').val();
		var kelas=$('#kelas').val();
		var tapel=$('#tapel').val();
		var smt=$('#smt').val();
		$.ajax({
			method : 'GET',
			url : 'modul/rapor/ambil-rekap.php',
			dataType: 'json',
			data :  'kelas=' +kelas+'&tapel='+tapel+'&smt='+smt+'&jns='+jns,
			beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
			success: function (response) {
				$('#status').unblock();
				//jika data berhasil didapatkan, tampilkan ke dalam option select mp
				$("#rekaprapor").html(response);
			}
		});
		
	});
	
	
	
		$( "#cetakT" ).click(function() {
			var jns = $('#jns').val();
			var kelas=$('#kelas').val();
			var tapel=$('#tapel').val();
			var smt=$('#smt').val();
			if(kelas==0 || jns==0){
				Swal.fire("Kesalahan",'Pilih Kelas Dahulu',"error");
			}else if(jns=='k3'){
				window.open('cetak/rekapnilai.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt+'&jns='+jns,' _blank');
			}else{
				window.open('cetak/rekapnilaik.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt+'&jns='+jns,' _blank');
			};
		});
	
})


	</script>
</body>
</html>
