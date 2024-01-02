<?php $data="Edit PTK";?>
<?php include "layout/head.php"; 
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

<link rel="stylesheet" href="<?=base_url();?>assets/css/croppie.css" />
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
							<?php if($level<>11){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Hanya Admin!!</div>
							</div>
							<?php }else{ ?>
							<?php 
							if($tipe==''){}else{
								$idptk=$tipe;
								$infoptk = $connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
								$idjns = $infoptk['jenis_ptk_id'];
								$jenis = $connect->query("select * from jenis_ptk where jenis_ptk_id='$idjns'")->fetch_assoc();
							?>
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title"><?=$infoptk['nama'];?></h3>
									<div class="portlet-addon">
									
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div id="dip">
										<div id="image_demo" style="width:350px; margin-top:30px"></div>
										<button class="btn btn-success crop_image">Crop & Upload Image</button>
									</div>
									<div class="row" id="dip2">
										<div class="col-md-3">
											<b id="uploaded_image"><img src="<?=base_url();?>images/ptk/<?=$infoptk['gambar'];?>" alt="avatar" id="blah"></b>
											<div class="profileupload">
												<input type="file" accept="image/*" name="upload_image" id="upload_image">
											</div>
										</div>
										<div class="col-md-9">
											<div class="portlet" id="portlet1-profile">
												<div class="portlet-body">
													<nav class="mb-3">
														<!-- BEGIN Nav -->
														<div class="nav nav-tabs" id="nav3-tab">
															<a class="nav-item nav-link active" id="nav3-home-tab" data-bs-toggle="tab" href="#nav3-home">Biodata</a>
															<a class="nav-item nav-link" id="nav3-profile-tab" data-bs-toggle="tab" href="#nav3-profile">Riwayat Pendidikan</a>
															<a class="nav-item nav-link" id="nav3-contact-tab" data-bs-toggle="tab" href="#nav3-contact">Keluarga</a>
														</div>
														<!-- END Nav -->
													</nav>
													<div class="tab-content" id="nav3-tabContent">
														<div class="tab-pane fade show active" id="nav3-home">
															<form class="row g-3" action="../modul/kepegawaian/update-biodata.php" autocomplete="off" method="POST" id="ubahForm">
																<div class="col-6">
																	<label for="inputAddress" class="form-label">Nama Lengkap</label>
																	<input type="text" class="form-control" name="nama" value="<?=$infoptk['nama'];?>">
																	<input type="hidden" class="form-control" name="ptkid" id="idpt" value="<?=$infoptk['ptk_id'];?>">
																</div>
																<div class="col-6">
																	<label for="inputAddress" class="form-label">Gelar</label>
																	<input type="text" class="form-control" name="gelar" value="<?=$infoptk['gelar'];?>">
																</div>
																<div class="col-4">
																	<label for="inputAddress" class="form-label">Tempat Lahir</label>
																	<input type="text" class="form-control" name="tempat" value="<?=$infoptk['tempat_lahir'];?>">
																</div>
																<div class="col-4">
																	<label for="inputAddress" class="form-label">Tanggal Lahir</label>
																	<input type="text" class="form-control" data-provide="datepicker" id="tanggal" name="tanggal" value="<?=$infoptk['tanggal_lahir'];?>">
																</div>
																<div class="col-4">
																	<label for="inputAddress" class="form-label">Jenis Kelamin</label>
																	<select name="jeniskelamin" class="form-select">
																		<option <?php if($infoptk['jenis_kelamin']==="L"){ echo "selected";}?> value="L">Laki-laki</option>
																		<option <?php if($infoptk['jenis_kelamin']==="P"){ echo "selected";}?> value="P">Perempuan</option>
																	</select>
																</div>
																<div class="col-3">
																	<label for="inputAddress" class="form-label">Status Perkawinan</label>
																	<select class="form-select" name="status">
																		<?php 
																		$sql2 = "select * from status_perkawinan";
																		$query2 = $connect->query($sql2);
																		while($po=$query2->fetch_assoc()){
																		?>
																		<option value="<?=$po['id_status'];?>" <?php if($po['id_status']===$infoptk['status_perkawinan']){ echo "selected";}?>><?=$po['nama_status'];?></option>
																		<?php } ?>
																	</select>
																</div>
																<div class="col-3">
																	<label for="inputAddress" class="form-label">NIK</label>
																	<input type="text" class="form-control" name="nik" value="<?=$infoptk['nik'];?>">
																</div>
																<div class="col-3">
																	<label for="inputAddress" class="form-label">NIY/NIGK</label>
																	<input type="text" class="form-control" name="niynigk" value="<?=$infoptk['niy_nigk'];?>" <?php if($level==11){}else{ echo 'readonly';}?>>
																</div>
																<div class="col-3">
																	<label for="inputAddress" class="form-label">NUPTK</label>
																	<input type="text" class="form-control" name="nuptk" value="<?=$infoptk['nuptk'];?>" <?php if($level==11){}else{ echo 'readonly';}?>>
																</div>
																<div class="col-12">
																	<label for="inputAddress" class="form-label">Alamat</label>
																	<input type="text" class="form-control" name="alamat" value="<?=$infoptk['alamat_jalan'];?>">
																</div>
																<div class="col-6">
																	<label for="inputAddress" class="form-label">Nomor HP</label>
																	<input type="text" class="form-control" name="noHP" value="<?=$infoptk['no_hp'];?>">
																</div>
																<div class="col-6">
																	<label for="inputAddress" class="form-label">E-mail</label>
																	<input type="text" class="form-control" name="email" value="<?=$infoptk['email'];?>">
																</div>
																<div class="col-4">
																	<label for="inputAddress" class="form-label">Jenis PTK</label>
																	<select class="form-select" name="jenispegawai" <?php if($level==11){}else{ echo 'readonly';}?>>
																		<?php 
																		$sql2 = "select * from jenis_ptk";
																		$query2 = $connect->query($sql2);
																		while($po=$query2->fetch_assoc()){
																		?>
																		<option value="<?=$po['jenis_ptk_id'];?>" <?php if($po['jenis_ptk_id']===$idjns){ echo "selected";}?>><?=$po['jenis_ptk'];?></option>
																		<?php } ?>
																	</select>
																</div>
																<div class="col-4">
																	<label for="inputAddress" class="form-label">Status Kepegawaian</label>
																	<select class="form-select" name="statuspegawai" <?php if($level==11){}else{ echo 'readonly';}?>>
																		<?php 
																		$sql21 = "select * from status_kepegawaian";
																		$query21 = $connect->query($sql21);
																		while($po1=$query21->fetch_assoc()){
																		?>
																		<option value="<?=$po1['status_kepegawaian_id'];?>" <?php if($po1['status_kepegawaian_id']===$infoptk['status_kepegawaian_id']){ echo "selected";}?>><?=$po1['nama'];?></option>
																		<?php } ?>
																	</select>
																</div>
																<div class="col-4">
																	<label for="inputAddress" class="form-label">TMT di sekolah ini</label>
																	<?php if($infoptk['tmt']===NULL){ $tmtnya='';}else{$tmtnya=$infoptk['tmt'];};?>
																	<input type="text" class="form-control" name="tmt" id="tmt" data-provide="datepicker" value="<?=$tmtnya;?>">
																</div>
																<div class="row">
																	<div class="col-md-12 text-end mt-3">
																		<a href="../daftar-ptk" class="btn btn-danger">Kembali</a>
																		<button type="submit" class="btn btn-primary">Simpan</button>
																	</div>
																</div>
															</form>
														</div>
														<div class="tab-pane fade" id="nav3-profile">
															<button class="btn btn-effect-ripple btn-xs btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahriwayat"><i class="fa fa-plus"></i> Riwayat Pendidikan</button>
															<table id="pendidikan-1" class="table table-bordered table-striped table-hover">
																<thead>
																	<tr>
																		<th>Jenjang</th>
																		<th>Satuan Pendidikan</th>
																		<th>Fakultas/Jurusan</th>
																		<th>Tahun Masuk</th>
																		<th>Tahun Keluar</th>
																		<th></th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="tab-pane fade" id="nav3-contact">
															<button class="btn btn-effect-ripple btn-xs btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahanak"><i class="fa fa-plus"></i> Nama Anak</button>
															<table id="anak-1" class="table table-bordered table-striped table-hover">
																<thead>
																	<tr>
																		<th>Nama</th>
																		<th>Status</th>
																		<th>JK</th>
																		<th>Tempat Tanggal Lahir</th>
																		<th>Jenjang</th>
																		<th>NISN</th>
																		<th>Tahun Masuk</th>
																		<th></th>
																	</tr>
																</thead>
															</table>
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }} ?>
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
	<div class="modal fade" id="tambahriwayat">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="tambahriwayatform" method="POST" action="../modul/kepegawaian/tambah-pendidikan.php" class="form" autocomplete="off">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahanak">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="tambahanakform" method="POST" action="../modul/kepegawaian/tambah-anak.php" class="form" autocomplete="off">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambah-pengguna">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/kepegawaian/add-user.php" autocomplete="off" method="POST" id="adduser">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script src="<?=base_url();?>assets/js/croppie.js"></script>
	<script>
	var TabelRombel;
	$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
	$('#tmt').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
	$("#dip").hide(); 
	$("#dip2").show(); 
	var idptk = $('#idpt').val();
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
	//$('#waktu').timepicker({ timeFormat: 'HH:mm' });
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
    $("#dip").show(); 
	$("#dip2").hide(); 
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"<?=base_url();?>images/uploadfoto-ptk.php?idp="+idptk,
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $("#dip").hide(); 
		  $("#dip2").show(); 
          $('#uploaded_image').html(data);
		  toastr.success("Sukses");
        }
      });
    })
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
						//setTimeout(function () {window.open("./","_self");},1000)
						//setTimeout(function () {window.open("./","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
	var TabelRiwayat;
	var TabelAnak;
		var idptk = $('#idpt').val();
		TabelRiwayat = $("#pendidikan-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "../modul/kepegawaian/daftar-riwayat.php?idptk="+idptk
		});
		TabelAnak = $("#anak-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "../modul/kepegawaian/daftar-anak.php?idptk="+idptk
		});
		$("#tambahriwayatform").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#pendidikan-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#pendidikan-1').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						$("#tambahriwayat").modal('hide');
						TabelRiwayat.ajax.reload(null, false);
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$('#tambahriwayat').on('show.bs.modal', function (e) {
            var idptk = $('#idpt').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : '../modul/kepegawaian/m_riwayat.php',
				data :  'idptk='+ idptk,
				beforeSend: function()
				{	
					$('#pendidikan-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#pendidikan-1').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$('#tambahanak').on('show.bs.modal', function (e) {
            var idptk = $('#idpt').val();
			$('#tanggal_lahir').datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true
			});
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : '../modul/kepegawaian/m_anak.php',
				data :  'idptk='+ idptk,
				beforeSend: function()
				{	
					$('#anak-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#anak-1').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#tambahanakform").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#anak-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#anak-1').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						$("#tambahanak").modal('hide');
						TabelAnak.ajax.reload(null, false);
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
	</script>
</body>
</html>
