<?php $data="Generate Rapor";?>
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
									<h3 class="portlet-title">Generate Rapor</h3>
									<div class="portlet-addon">
										    <?php if($level==96){?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and pai='$idku' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
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
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and penjas='$idku' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
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
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and inggris='$idku' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
													echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
												}	
												?>
											</select>
											<?php }elseif($level==11 || $level==93){ ?>
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
									<div class="row">
										<div class="col-lg-4 col-sm-6">
											<select id="mp" name="mp" class="form-select">
												<option value="0">Pilih Mapel</option>
											</select>
										</div>
										<div class="col-lg-8 col-sm-6">
											
										</div>
									</div>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Nilai</th>
												<th>Deskripsi</th>
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
				<form class="form-horizontal" action="modul/rapor/update-rapor.php" autocomplete="off" method="POST" id="ubahproyek">
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
		var kelas=$('#kelas').val();
		var mp=$('#mp').val();
		var tapel=$('#tapel').val();
		var smt=$('#smt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/rapor/rapor-ikm.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt+'&mp='+mp
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
					$('#status').unblock();
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/rapor/rapor-ikm.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt+'&mp='+mp
			});
		});
		$('#mp').change(function(){
			var kelas=$('#kelas').val();
			var mp=$('#mp').val();
			var tapel=$('#tapel').val();
			var smt=$('#smt').val();
			$.ajax({
				type : 'GET',
				url : 'modul/materi/materi.php',
				data :  'kelas='+kelas+'&mp='+mp+'&smt='+smt,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/rapor/rapor-ikm.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt+'&mp='+mp
			});
			
		});
		
		$(document).on('click', '#getRaport', function(e){
			e.preventDefault();
			var ukelas = $(this).data('kelas');
			var utapel = $(this).data('tapel');			// it will get id of clicked row
			var usmt = $(this).data('smt');
			var ump = $(this).data('mp');
			var updid = $(this).data('pdid');
			$.ajax({
				type : 'POST',
				url : 'modul/rapor/simpan-rapor.php',
				data :  'kelas='+ukelas+'&mp='+ump+'&smt='+usmt+'&tapel='+utapel+'&pdid='+updid,
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
						TabelRombel.ajax.reload(null, false);
					} else {
						Swal.fire("Kesalahan",response.messages,"error");
						TabelRombel.ajax.reload(null, false);
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
						
						TabelRombel.ajax.reload(null, false);
					} else {
						Swal.fire("Kesalahan","Masih ada TP yang terdaftar pada LM ini!","error");
					}
				} // /success
			}); // /ajax
			return false;
		});
	
		
	</script>
</body>
</html>
