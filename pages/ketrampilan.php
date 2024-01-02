<?php $data="Penilaian Ketrampilan";?>
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
									<h3 class="portlet-title">Penilaian Ketrampilan</h3>
									<div class="portlet-addon">
										    <?php if($level==96){?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and pai='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
														echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
												}	
												?>
											</select>
											<?php }elseif($level==95){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and penjas='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
													echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
												}	
												?>
											</select>
											<?php }elseif($level==94){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and inggris='$idku' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
													echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
												}	
												?>
											</select>
											<?php }elseif($level==11){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
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
									<form class="row g-3">
										<div class="col-md-3">
											<label for="inputEmail4" class="form-label">Mata Pelajaran</label>
											<select id="mp" name="mp" class="form-select">
												<option value="0">Pilih Mapel</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="inputEmail4" class="form-label">Tema</label>
											<select class="form-select" id="tema" name="tema">
												<option value="0">Pilih Tema</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="inputEmail4" class="form-label">KD</label>
											<select class="form-select" id="kd" name="kd">
												<option value="0">Pilih KD</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="inputEmail4" class="form-label">Jenis</label>
											<select class="form-select" id="jns" name="jns">
												<option value="0">Pilih Jenis</option>
											</select>
										</div>
									</form>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Nilai</th>
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
		var kd = $('#kd').val();
		var mp = $('#mp').val();
		var kelas=$('#kelas').val();
		var smt=$('#smt').val();
		var peta=4;
		var tema=$('#tema').val();
		var tapel=$('#tapel').val();
		var jns=$('#jns').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/penilaian/NilaiKet.php?mp="+ mp+"&kelas="+kelas+"&smt="+smt+"&peta="+peta+"&tema="+tema+"&tapel="+tapel+"&kd="+kd+"&jns="+jns
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=$('#smt').val();
			var peta=4;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			var jns=$('#jns').val();
			//$("#nilaiHarian").hide();
			$.ajax({
				type : 'GET',
				url : 'modul/penilaian/mp.php',
				data :  'kelas='+kelas,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#mp").html(data);
					$("#tema").html('<select class="form-select" id="tema" name="tema"><option value="0">Pilih Tema</option></select>');
					$("#kd").html('<select class="form-select" id="kd" name="kd"><option value="0">Pilih KD</option></select>');
					$("#jns").html('<select class="form-select" id="jns" name="jns"><option value="0">Pilih Jenis</option></select>');
					$('#status').unblock();
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/penilaian/NilaiKet.php?mp="+ mp+"&kelas="+kelas+"&smt="+smt+"&peta="+peta+"&tema="+tema+"&tapel="+tapel+"&kd="+kd+"&jns="+jns
			});
		});
		$('#mp').change(function(){
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=$('#smt').val();
			var peta=4;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			var jns=$('#jns').val();
			$.ajax({
				type : 'GET',
				url : 'modul/penilaian/tm.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#tema").html(data);
					$("#kd").html('<select class="form-select" id="kd" name="kd"><option value="0">Pilih KD</option></select>');
					$("#jns").html('<select class="form-select" id="jns" name="jns"><option value="0">Pilih Jenis</option></select>');
					$('#status').unblock();
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/penilaian/NilaiKet.php?mp="+ mp+"&kelas="+kelas+"&smt="+smt+"&peta="+peta+"&tema="+tema+"&tapel="+tapel+"&kd="+kd+"&jns="+jns
			});
			
		});
		$('#tema').change(function(){
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=$('#smt').val();
			var peta=4;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			var jns=$('#jns').val();
			$.ajax({
				type : 'GET',
				url : 'modul/penilaian/kd.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta+'&tema='+tema,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#kd").html(data);
					$("#jns").html('<select class="form-select" id="jns" name="jns"><option value="0">Pilih Jenis</option></select>');
					$('#status').unblock();
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/penilaian/NilaiKet.php?mp="+ mp+"&kelas="+kelas+"&smt="+smt+"&peta="+peta+"&tema="+tema+"&tapel="+tapel+"&kd="+kd+"&jns="+jns
			});
			
		});
		$('#kd').change(function(){
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=$('#smt').val();
			var peta=4;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			var jns=$('#jns').val();
			$.ajax({
				type : 'GET',
				url : 'modul/penilaian/jenis.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta+'&tema='+tema+'&kd='+kd,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#jns").html(data);
					$('#status').unblock();
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/penilaian/NilaiKet.php?mp="+ mp+"&kelas="+kelas+"&smt="+smt+"&peta="+peta+"&tema="+tema+"&tapel="+tapel+"&kd=0&jns="+jns
			});
			
		});
		$('#jns').change(function(){
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=$('#smt').val();
			var peta=4;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			var jns=$('#jns').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/penilaian/NilaiKet.php?mp="+ mp+"&kelas="+kelas+"&smt="+smt+"&peta="+peta+"&tema="+tema+"&tapel="+tapel+"&kd="+kd+"&jns="+jns
			});
			
		});
		
	});	
		
	
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveHarian(editableObj,column,id,kelas,smt,tapel,mpid,kd,jns,tema) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "modul/penilaian/saveKet.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel+'&mp='+mpid+'&kd='+kd+'&jns='+jns+'&tema='+tema,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FFF url(checkup.png) no-repeat right");				
			}          
	   });
	}
		
	</script>
</body>
</html>
