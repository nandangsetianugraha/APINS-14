<?php $data="KKM";?>
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
									<h3 class="portlet-title">Kriteria Ketuntasan Minimal</h3>
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
										<div class="col-lg-4 col-sm-6">
											<select id="mp" name="mp" class="form-select">
												<option value="0">Pilih Mapel</option>
											</select>
										</div>
										<div class="col-lg-4 col-sm-6">
											
										</div>
									</div>
									<hr>
									<div class="alert alert-outline-secondary">
										<div class="alert-icon">
											<i class="fa fa-lightbulb"></i>
										</div>
										<div class="alert-content">
											<table class="table mb-0">
												<thead>
													<tr>
														<th>Aspek yang dianalisis</th>
														<th>Tinggi</th>
														<th>Sedang</th>
														<th>Rendah</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Kompleksitas</td>
														<td><65</td>
														<td>65 - 79</td>
														<td>80 -100</td>
													</tr>
													<tr>
														<td>Daya Dukung</td>
														<td>80 - 100</td>
														<td>65 - 79</td>
														<td><65</td>
													</tr>
													<tr>
														<td>Intake Siswa</td>
														<td>80 - 100</td>
														<td>65 - 79</td>
														<td><65</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Kompetensi Dasar</th>
												<th>Kompleksitas</th>
												<th>Intake</th>
												<th>Daya Dukung</th>
												<th>KKM KD</th>
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
				<form class="form-horizontal" action="modul/administrasi/tambah-materi.php" autocomplete="off" method="POST" id="buatproyek">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/administrasi/update-materi.php" autocomplete="off" method="POST" id="ubahproyek">
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
		var kelas = $('#kelas').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		var mp = $('#mp').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/administrasi/kkmku.php?kelas="+kelas+"&tapel="+tapel+"&mapel="+mp
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
			$("#nilaiHarian").hide();
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mpl.php',
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
				"ajax": "modul/administrasi/kkmku.php?kelas="+kelas+"&tapel="+tapel+"&mapel=0"
			});
		});
		$('#mp').change(function(){
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			var mp = $('#mp').val();
			$("#nilaiHarian").hide();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/administrasi/kkmku.php?kelas="+kelas+"&tapel="+tapel+"&mapel="+mp
			});
			
		});
	});	
	function highlightEdit(editableObj) {
			$(editableObj).css("background","#FFF0000");
		} 
	function saveKKM(editableObj,column,kelas,tapel,mpid,kda,jenis) {
			// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "modul/administrasi/saveKKM.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&kelas='+kelas+'&tapel='+tapel+'&mp='+mpid+'&kda='+kda+'&jenis='+jenis,
			dataType: 'json',
			success: function(response)  {
				console.log(response);
				if(response.success == true) {
					$('#kkmku').html(response.kkmnya);
					$('#para'+response.KD).html(response.rata);
				}
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FFF url(checkup.png) no-repeat right");
					
				// set updated value as old value
				
				
			}          
		});
	};	
	
	function removeMateri(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Materi ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/administrasi/hapus-materi.php',
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
