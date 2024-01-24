<?php 
$data="Beranda";
$bulan=date('m');
$tahun=date('Y');
$bulans=date('m');
$tahuns=date('Y');
$tglsek=date('d');
if($level==98 or $level==97){
	$jlak=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel' and penempatan.smt='$smt'")->num_rows;
	$jper=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel' and penempatan.smt='$smt'")->num_rows;
	$jtot=$jlak+$jper;
}else{
	$jtot=$connect->query("select * from siswa where status=1")->num_rows;
	$jlak=$connect->query("select * from siswa where jk='L' and status=1")->num_rows;
	$jper=$connect->query("select * from siswa where jk='P' and status=1")->num_rows;
};
$jptk=$connect->query("select * from ptk where status_keaktifan_id=1")->num_rows;
?>
<?php include "layout/head.php"; ?>

<link rel="stylesheet" href="<?=base_url();?>assets/croppie.css" />
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
				<!-- isi -->
				<div class="container-fluid g-5">
					<?php if($maintenis==1){?>
					<div class="alert alert-outline-secondary">
						<div class="alert-icon">
							<i class="fa fa-wrench"></i>
						</div>
						<div class="alert-content">Server sedang dalam tahap perbaikan dan optimalisasi Database, hanya halaman ini yang bisa anda akses!</div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							<div class="portlet">
								<!-- BEGIN Widget -->
								<div class="widget10 widget10-vertical-md">
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$jtot;?></h2>
											<span class="widget10-subtitle">Jumlah Siswa</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-info avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$jlak;?></h2>
											<span class="widget10-subtitle">Laki-laki</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-primary avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$jper;?></h2>
											<span class="widget10-subtitle">Perempuan</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-success avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$jptk;?></h2>
											<span class="widget10-subtitle">Jumlah PTK</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-danger avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
								</div>
								<!-- END Widget -->
							</div>
							<!-- END Portlet -->
						</div>
					</div>
					
							<div class="row">
								<div class="col-md-6">
									<div class="portlet">
										<div class="portlet-header portlet-header-bordered">
											<div class="portlet-icon">
												<i class="fa fa-user-tag"></i>
											</div>
											<h3 class="portlet-title">Pengumuman</h3>
                                          	<div class="portlet-addon">
                                              	<?php if($level==11){ ?>
                                                <a href="<?=base_url();?>tambah-pengumuman" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
                                              	<?php } ?>
                                            </div>
										</div>
										<div class="portlet-body">
                                          	
											<!-- BEGIN Rich List -->
											<div class="rich-list rich-list-flush" id="bewara">
												<?php 
                                                $sql22 = "select * from pengumuman order by waktu desc limit 1";
												$query22 = $connect->query($sql22);
												$cekss=$query22->num_rows;
												if($cekss>0){
												while($jpesan=$query22->fetch_assoc()){
                                                ?>
												<div class="rich-list-item flex-column align-items-stretch">
													<!-- BEGIN Rich List -->
                                                  	
													<div class="rich-list-item p-0 mb-2">
														<div class="rich-list-prepend">
															<!-- BEGIN Avatar -->
															<div class="avatar">
																<div class="avatar-display" id="uploaded_image2">
																	<img src="<?=base_url();?>assets/<?=$cfgs['image_login'];?>" alt="Avatar image">
																</div>
															</div>
															<!-- END Avatar -->
														</div>
														<div class="rich-list-content">
															<h4 class="rich-list-title"><?=$jpesan['judul'];?></h4>
															<span class="rich-list-subtitle"><?=TanggalIndo($jpesan['waktu']);?></span>
														</div>
														<div class="rich-list-append">
                                                          	<?php if($level==11){ ?>
															<div class="row g-3">
																<div class="col-md-6">
																	<a href="<?=base_url();?>edit-pengumuman/<?=$jpesan['id'];?>" class="btn btn-sm btn-icon btn-primary"><i class="fa-solid fa-pencil"></i></a>
																</div>
																<div class="col-md-6">
																	<button class="btn btn-icon btn-sm btn-danger" onclick="removePengumuman('<?=$jpesan['id'];?>')"> <i class="fa fa-trash"></i></button>
																</div>
															</div>
															
															
                                                          	<?php } ?>
                                                          	
														</div>
													</div>
													<p class="text-justify mb-0"><?=$jpesan['berita'];?></p>
                                                    <!-- END Rich List -->
												</div>
												<?php }}else{ ?>
													<div class="rich-list-item flex-column align-items-stretch">
														<!-- BEGIN Rich List -->
														
														<div class="rich-list-item p-0 mb-2">
															<div class="rich-list-prepend">
																<!-- BEGIN Avatar -->
																<div class="avatar">
																	<div class="avatar-display" id="uploaded_image2">
																		<img src="<?=base_url();?>assets/<?=$cfgs['image_login'];?>" alt="Avatar image">
																	</div>
																</div>
																<!-- END Avatar -->
															</div>
															<div class="rich-list-content">
																<h4 class="rich-list-title">Admin</h4>
																<span class="rich-list-subtitle"><?=TanggalIndo(date('Y-m-d'));?></span>
															</div>
															<div class="rich-list-append">
																
															</div>
														</div>
														<p class="text-justify mb-0">Belum ada Pengumuman</p>
														<!-- END Rich List -->
													</div>
												<?php } ?>
											</div>
											<!-- END Rich List -->
										</div>
									</div>
									<!-- BEGIN Portlet -->
									<div class="portlet">
										<div class="portlet-header">
											<div class="portlet-icon">
												<i class="fa fa-bell"></i>
											</div>
											<h3 class="portlet-title">Notification</h3>
											<div class="portlet-addon">
												<?php if($level==11){ ?>
                                                <a class="btn btn-outline-success btn-sm me-1 mb-1" href="<?=base_url();?>pages/ekspor_notif.php"><i class="fa fa-download"></i> Unduh</a>
												<button class="btn btn-outline-danger btn-sm me-1 mb-1" onclick="hapusNotif()"><i class="fa fa-recycle"></i> Hapus</button>
                                              	<?php } ?>
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN Rich List -->
											<div class="rich-list rich-list-bordered rich-list-action" id="collapse1One">
												<?php 
												if($level==11){
													$logs = $connect->query("select * from log order by logDate desc limit 5");
												}else{
													$logs = $connect->query("select * from log where ptk_id='$idku' order by logDate desc limit 5");
												};
												$jlogs=$logs->num_rows;
												$hariini=date('Y-m-d H:i:s');
												if($jlogs>0){
													while($mlogs=$logs->fetch_assoc()){
														$idlog=$mlogs['id'];
														$iduser=$mlogs['ptk_id'];
														$nama=$connect->query("select * from ptk where ptk_id='$iduser'")->fetch_assoc();
														$waktu = explode(' ',$mlogs['logDate']);
												?>
												<div class="rich-list-item">
													<div class="rich-list-prepend">
														<!-- BEGIN Avatar -->
														<div class="avatar avatar-label-info">
															<div class="avatar-display">
																<img alt="AI" src="<?=base_url();?>images/ptk/<?=$nama['gambar'];?>" class=" img-fluid">
															</div>
														</div>
														<!-- END Avatar -->
													</div>
													<div class="rich-list-content">
														<h4 class="rich-list-title"><?=$nama['nama'];?></h4>
														<span class="rich-list-subtitle"><?=namahari($waktu[0]);?>, <?=TanggalIndo($waktu[0]);?> <?=$waktu[1];?> - <?=$mlogs['activity'];?></span>
													</div>
													<?php if($level==11){ ?>
													<div class="rich-list-append">
														<button onclick="removeAktivitas(<?=$idlog;?>)" class="btn btn-text-secondary btn-icon">
															<i class="fa fa-trash"></i>
														</button>
													</div>
													<?php } ?>
												</div>
												<?php }}else{ ?>
												<div class="rich-list-item">
													<div class="rich-list-prepend">
														<!-- BEGIN Avatar -->
														<div class="avatar avatar-label-info">
															<div class="avatar-display">
																<img alt="AI" src="assets/<?=$cfgs['image_login'];?>" class=" img-fluid">
															</div>
														</div>
														<!-- END Avatar -->
													</div>
													<div class="rich-list-content">
														<h4 class="rich-list-title">Belum Ada Aktivitas</h4>
														<span class="rich-list-subtitle"></span>
													</div>
												</div>
												<?php } ?>
											</div>
											<!-- END Rich List -->
										</div>
									</div>
									<!-- END Portlet -->
									<!-- BEGIN Portlet -->
									<!-- END Portlet -->
								</div>
								<div class="col-md-6">
									<div class="portlet mb-2">
										<div class="portlet-header portlet-header-bordered">
											<div class="avatar avatar-circle avatar-lg">
												<div class="avatar-display">
													<img src="<?=base_url();?>images/ptk/<?=$bioku['gambar'];?>" alt="AI">
													<input type="hidden" id="idptks" value="<?=$bioku['ptk_id'];?>">
												</div>
											</div>
											<div class="portlet-addon">
												<!-- BEGIN Nav -->
												<div class="nav nav-lines portlet-nav" id="portlet1-tab">
													<a class="nav-item nav-link active" id="portlet1-profile-tab" data-bs-toggle="tab" href="#portlet1-profile">Profile</a>
													<a class="nav-item nav-link" id="portlet1-sk-tab" data-bs-toggle="tab" href="#portlet1-sk">SK</a>
													<a class="nav-item nav-link" id="portlet1-contact-tab" data-bs-toggle="tab" href="#portlet1-contact">Password</a>
												</div>
												<!-- END Nav -->
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN Tab -->
											<div class="tab-content">
												<div class="tab-pane fade show active" id="portlet1-profile">
													<form class="row g-3" action="modul/kepegawaian/update-biodata.php" autocomplete="off" method="POST" id="ubahForm">
														<div class="col-6">
															<label for="inputAddress" class="form-label">Nama Lengkap</label>
															<input type="text" class="form-control" name="nama" value="<?=$bioku['nama'];?>">
															<input type="hidden" class="form-control" name="ptkid" value="<?=$bioku['ptk_id'];?>">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Gelar</label>
															<input type="text" class="form-control" name="gelar" value="<?=$bioku['gelar'];?>">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">Tempat Lahir</label>
															<input type="text" class="form-control" name="tempat" value="<?=$bioku['tempat_lahir'];?>">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">Tanggal Lahir</label>
															<input type="text" class="form-control" data-provide="datepicker" id="tanggal" name="tanggal" value="<?=$bioku['tanggal_lahir'];?>">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">Jenis Kelamin</label>
															<select name="jeniskelamin" class="form-select">
																<option <?php if($bioku['jenis_kelamin']==="L"){ echo "selected";}?> value="L">Laki-laki</option>
																<option <?php if($bioku['jenis_kelamin']==="P"){ echo "selected";}?> value="P">Perempuan</option>
															</select>
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">NIK</label>
															<input type="text" class="form-control" name="nik" value="<?=$bioku['nik'];?>">
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">NIY/NIGK</label>
															<input type="text" class="form-control" name="niynigk" value="<?=$bioku['niy_nigk'];?>" <?php if($level==11){}else{ echo 'readonly';}?>>
														</div>
														<div class="col-4">
															<label for="inputAddress" class="form-label">NUPTK</label>
															<input type="text" class="form-control" name="nuptk" value="<?=$bioku['nuptk'];?>" <?php if($level==11){}else{ echo 'readonly';}?>>
														</div>
														<div class="col-12">
															<label for="inputAddress" class="form-label">Alamat</label>
															<input type="text" class="form-control" name="alamat" value="<?=$bioku['alamat_jalan'];?>">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Nomor HP</label>
															<input type="text" class="form-control" name="noHP" value="<?=$bioku['no_hp'];?>">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">E-mail</label>
															<input type="text" class="form-control" name="email" value="<?=$bioku['email'];?>">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Jenis PTK</label>
															<select class="form-select" name="jenispegawai" <?php if($level==11){}else{ echo 'readonly';}?>>
																<?php 
																$sql2 = "select * from jenis_ptk";
																$query2 = $connect->query($sql2);
																while($po=$query2->fetch_assoc()){
																?>
																<option value="<?=$po['jenis_ptk_id'];?>" <?php if($po['jenis_ptk_id']===$levels){ echo "selected";}?>><?=$po['jenis_ptk'];?></option>
																<?php } ?>
															</select>
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Status Kepegawaian</label>
															<select class="form-select" name="statuspegawai" <?php if($level==11){}else{ echo 'readonly';}?>>
																<?php 
																$sql21 = "select * from status_kepegawaian";
																$query21 = $connect->query($sql21);
																while($po1=$query21->fetch_assoc()){
																?>
																<option value="<?=$po1['status_kepegawaian_id'];?>" <?php if($po1['status_kepegawaian_id']===$status){ echo "selected";}?>><?=$po1['nama'];?></option>
																<?php } ?>
															</select>
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">TMT di sekolah ini</label>
															<?php if($bioku['tmt']===NULL){ $tmtnya='';}else{$tmtnya=$bioku['tmt'];};?>
															<input type="text" class="form-control" name="tmt" id="tmt" data-provide="datepicker" value="<?=$tmtnya;?>">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Status Perkawinan</label>
															<select class="form-select" name="status">
																<?php 
																$sql2 = "select * from status_perkawinan";
																$query2 = $connect->query($sql2);
																while($po=$query2->fetch_assoc()){
																?>
																<option value="<?=$po['id_status'];?>" <?php if($po['id_status']===$bioku['status_perkawinan']){ echo "selected";}?>><?=$po['nama_status'];?></option>
																<?php } ?>
															</select>
														</div>
														<div class="row">
															<div class="col-md-12 text-end mt-3">
																<button type="submit" class="btn btn-primary modal-confirm">Simpan</button>
															</div>
														</div>
													</form>
												</div>
												<div class="tab-pane fade" id="portlet1-sk">
													<table class="table table-sm">
														<thead>
														  <tr>
															<th scope="col">Tanggal</th>
															<th scope="col">Nomor SK</th>
															<th scope="col">Jabatan</th>
															<th scope="col">Pejabat Pengangkat</th>
															<th scope="col">Print</th>
														  </tr>
														</thead>
														<tbody>
															<?php 
															$sql22 = "select * from sk where ptk_id='$idku' order by tanggal_sk desc";
															$query22 = $connect->query($sql22);
															while($skku=$query22->fetch_assoc()){
																$idsk=$skku['id_sk'];
															?>
															<tr>
																<th scope="row"><?=$skku['tanggal_sk'];?></th>
																<td><?=$skku['no_sk'];?></td>
																<td><?=$skku['jabatan'];?></td>
																<td><?=$skku['pengangkat'];?></td>
																<td><button data-ptk="<?=$idku;?>"  data-id="<?=$idsk;?>" id="cetaksuratSK" class="btn btn-info btn-border btn-round btn-sm"><i class="fas fa-print"></i></a></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
												<div class="tab-pane fade" id="portlet1-contact">
													<?php 
													$ptkid=$bioku['ptk_id'];
													$pp=$_SESSION['username'];
													$pengguna = $connect->query("select * from pengguna where username='$pp'")->fetch_assoc();
													?>
													<form class="row g-3" action="modul/kepegawaian/update-password.php" autocomplete="off" method="POST" id="ubahPassw">
														<div class="col-6">
															<label for="inputAddress" class="form-label">Username</label>
															<input type="text" class="form-control" name="username" value="<?=$pengguna['username'];?>">
															<input type="hidden" class="form-control" name="ptkid" value="<?=$bioku['ptk_id'];?>">
														</div>
														<div class="col-6">
															<label for="inputAddress" class="form-label">Password</label>
															<input type="password" class="form-control" name="password">
														</div>
														<div class="row">
															<div class="col-md-12 text-end mt-3">
																<button type="submit" class="btn btn-primary modal-confirm">Simpan</button>
															</div>
														</div>
													</form>
												</div>
											</div>
											<!-- END Tab -->
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
	<div class="modal fade" id="uploadimageModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Upload & Crop Image</h4>
				</div>
				<div class="modal-body">
					<div id="image_demo" style="width:350px; margin-top:30px"></div>
					<button class="btn btn-success crop_image">Crop & Upload Image</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="lihatpengumuman">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="fetched-data"></div>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script src="<?=base_url();?>assets/croppie.js"></script>
	
    <script>
		
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
		var idptk = $('#idptks').val();
		$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
		$('#tmt').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
		$('#tanggal_awal').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
		setInterval(function() {
			$("#collapse1One").load('modul/kepegawaian/aktivitas.php?idptk='+idptk)
		}, 5000);
        
		$("#tambahpengumuman").unbind('submit').bind('submit', function() {
			var form = $(this);
			var quillHtml1 = quill.root.innerHTML.trim();
			var tanggal = $('#tanggal_awal').val();
			var judul = $('#judul').val();
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : {content:quillHtml1,tanggal:tanggal,judul:judul},
				dataType : 'json',
				beforeSend: function(){	
					$('#tambahpengumuman').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#tambahpengumuman').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						$.ajax({
							type : 'GET',
							url : 'modul/berita/bewara.php',
							data :  'id=1',
							beforeSend: function()
							{	
									
							},
							success: function (data) {
								//jika data berhasil didapatkan, tampilkan ke dalam option select mp
								$("#bewara").html(data);
							}
						});
						$("#addpengumuman").modal('hide');
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$('#lihatpengumuman').on('show.bs.modal', function (e) {
            var idinv = $(e.relatedTarget).data('tema');
			
			//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'post',
					url : 'modul/berita/lihat-pengumuman.php',
					data :  'idinv='+idinv,
					beforeSend: function()
							{	
								$(".fetched-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
							},
					success : function(data){
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
					}
				});
			
         });
		$('#bulanku').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var bulan=$('#bulanku').val();
			var idptk = $('#idptks').val();
			var tahun = $('#tahunku').val();
			$.ajax({
				type : 'post',
				url : 'modul/kepegawaian/data-absen-ptk.php',
				data :  'rowid='+ idptk +'&bulan='+bulan+'&tahun='+tahun,
				beforeSend: function()
				{	
					$('#portlet1-home').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#portlet1-home').unblock();
					$('.absen-pegawai').html(data);//menampilkan data ke dalam modal
				}
			});
		});
      
		$('#tahunku').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var bulan=$('#bulanku').val();
			var idptk = $('#idptks').val();
			var tahun = $('#tahunku').val();
			$.ajax({
				type : 'post',
				url : 'modul/kepegawaian/data-absen-ptk.php',
				data :  'rowid='+ idptk +'&bulan='+bulan+'&tahun='+tahun,
				beforeSend: function()
				{	
					$('#portlet1-home').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#portlet1-home').unblock();
					$('.absen-pegawai').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		
		$("#ubahForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#portlet1-profile').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#portlet1-profile').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						setTimeout(function () {window.open("./","_self");},1000)
						//setTimeout(function () {window.open("./","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$("#ubahPassw").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#portlet1-contact').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#portlet1-contact').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						setTimeout(function () {window.open("./","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$(document).on('click', '#cetaksuratSK', function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var idptk = $(this).data('ptk');
			if(id==0){
				toastr.success('Masukkan SK!');
			}else{
				PopupCenter('https://simas.sdi-aljannah.web.id/cetak/surat-pengangkatan.php?id='+id+'&idptk='+idptk,'SK Pengangkatan',800,800);
			}
			
			
		});
	});

var idptk = $('#idptks').val();
$image_crop = $('#image_demo').croppie({
		enableExif: true,
		viewport: {
		  width:200,
		  height:200,
		  type:'square' //circle
		},
		boundary:{
		  width:300,
		  height:300
		}
	});
$('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"images/uploadfoto.php?idp="+idptk,
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
		  $('#uploaded_image3').html(data);
		  $('#uploaded_image4').html(data);
		  $('#uploaded_image5').html(data);
		  $('#uploaded_image6').html(data);
		  toastr.success('Photo  Profil Berhasil diubah!');
		  //setTimeout(function () {window.open(urls,"_self");},1000)
        }
      });
    })
  });
  function removeAktivitas(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Aktivitas ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/kepegawaian/hapus-aktivitas.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var idptks = $('#idptks').val();
								$.ajax({
									type : 'GET',
									url : 'modul/kepegawaian/aktivitas.php',
									data :  'idptk='+idptks,
									beforeSend: function()
									{	
										$("#loading").show();
										$(".loader").show();
									},
									success: function (data) {
										$("#loading").hide();
										$(".loader").hide();
										//jika data berhasil didapatkan, tampilkan ke dalam option select mp
										$("#collapse1One").html(data);
									}
								});
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
	function removePengumuman(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Pengumuman ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/berita/hapus-pengumuman.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								$.ajax({
									type : 'GET',
									url : 'modul/berita/bewara.php',
									data :  'id=1',
									beforeSend: function()
									{	
										
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select mp
										$("#bewara").html(data);
									}
								});
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
	function hapusNotif() {
		
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Notifikasi ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/berita/hapus-notif.php',
						type: 'post',
						data: {member_id : 0},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								toastr.success(response.messages);
								//Swal.fire("Sukses",response.messages,"success");
								$("#collapse1One").load('modul/kepegawaian/aktivitas.php?idptk='+idptk)
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		
	}
	function PopupCenter(pageURL, title,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	};
</script>
</body>
</html>
