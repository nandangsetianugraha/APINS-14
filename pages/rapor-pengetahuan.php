<?php $data="Rapor Pengetahuan";?>
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
										<select id="kelas" name="kelas" class="form-select">
                                            <?php if($level==11 or $level==94 or $level==95 or $level==96){ ?>
											<option value="0">Pilih Rombel</option>
											<?php 
											$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and kurikulum='Kurikulum 2013' order by nama_rombel asc";
											$query4 = $connect->query($sql4);
											while($nk=$query4->fetch_assoc()){
											?>
											<option value="<?=$nk['nama_rombel'];?>">Kelas <?=$nk['nama_rombel'];?></option>
											<?php }	?>
											<?php }else{ ?>
											<option value="<?=$kelas;?>">Kelas <?=$kelas;?></option>
											<?php } ?>
                                        </select>
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body" id="status">
									<form class="row g-3">
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">Mata Pelajaran</label>
											<?php if($level==98 or $level==97){ //guru kelas dan pendamping ?>
											<select class="form-select" id="mp" name="mp">
												<?php 
												$sql2 = "select * from mapel";
												$qu3 = $connect->query($sql2);
												while($po=$qu3->fetch_assoc()){
													$idmp=$po['id_mapel'];
													if($idmp==1 or $idmp==10){
														
													}else{
														if($ab<4 and ($idmp==5 or $idmp==6)){
															
														}else{
															if($ab>3 and $idmp==8){
																
															}else{
												?>
												<option value="<?=$po['id_mapel'];?>"><?=$po['nama_mapel'];?></option>
												<?php };
											};
											};
											};?>
											</select>
											<?php } ?>
											<?php if($level==96){ //mapel PAI ?>
											<select class="form-select" id="mp" name="mp">
												<option value="1">Pendidikan Agama Islam</option>
											</select>
											<?php } ?>
											<?php if($level==95){ //mapel PJOK ?>
											<select class="form-select" id="mp" name="mp">
												<option value="8">Pend. Jasmani Olahraga dan Kesehatan</option>
											</select>
											<?php } ?>
											<?php if($level==94){ //mapel Inggris ?>
											<select class="form-select" id="mp" name="mp">
												<option value="10">Bahasa Inggris</option>
											</select>
											<?php } ?>
											
											<?php if($level==11){ //Operator ?>
											<select class="form-select" id="mp" name="mp">
												<option value="0">Pilih Mapel</option>
											</select>
											<?php } ?>
										</div>
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">KKM</label>
											<?php 
											$mkkm=$connect->query("select min(nilai) as kkmsekolah from kkm where tapel='$tapel'")->fetch_assoc();
											if(empty($mkkm['kkmsekolah'])){
												$kkmsaya=0;
											}else{
												$kkmsaya=$mkkm['kkmsekolah'];
											};
											?>
											<input type="text" class="form-control" value="KKM Sekolah : <?=$kkmsaya;?>" readonly>
										</div>
									</form>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Nilai</th>
												<th>Predikat</th>
												<th>Deskripsi Pengetahuan</th>
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
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/rapor/rapor-pengetahuan.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt+"&mp=0"
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
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mpl.php',
				data :  'kelas=' +kelas,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$("#mp").html(data);
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/rapor/rapor-pengetahuan.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt+"&mp=0"
			});
		});
		$('#mp').change(function(){
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/rapor/rapor-pengetahuan.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt+"&mp="+mp
			});
		});
		$('#info').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/rapor/m_pengetahuan.php',
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
		$(document).on('click', '#getRaport', function(e){
			e.preventDefault();
			var ukelas = $(this).data('kelas');
			var utapel = $(this).data('tapel');			// it will get id of clicked row
			var usmt = $(this).data('smt');
			var updid = $(this).data('pdid');
			var ump = $(this).data('mp');
			$.ajax({
				type : 'post',
				url : 'modul/rapor/generate-pengetahuan.php',
				data :  'kelas='+ukelas+'&tapel='+utapel+'&smt='+usmt+'&mp='+ump+'&pdid='+updid,
				dataType: 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(response){
					var kelas = $('#kelas').val();
					var tapel = $('#tapel').val();
					var smt = $('#smt').val();
					var mp = $('#mp').val();
					TabelRombel.ajax.reload(null, false);
					toastr.success(response.messages);
					$('#status').unblock();
				}
			});			
		});
		$("#ekskulForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						TabelRombel.ajax.reload(null, false);
						$("#info").modal('hide');
					} else {
						toastr.error(response.messages);
					}
				} // /success
			}); // /ajax
			return false;
		});
	});	
	
	</script>
</body>
</html>
