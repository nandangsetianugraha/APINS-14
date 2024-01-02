<?php $data="Berita Acara";?>
<?php include "layout/head.php"; 
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

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
					
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<div class="portlet-icon">
										<i class="fa fa-map-marker-alt"></i>
									</div>
									<h3 class="portlet-title">Berita Acara</h3>
									<div class="portlet-addon">
										<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-dokumen" id="addBAPModalBtn"><i class="fa fa-plus"></i> BAP</button>
										<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
										<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
									</div>
								</div>
								<div class="portlet-body">
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover mt-2">
										<thead>
											<tr>
												<th>Hari</th>
												<th>Mata Pelajaran</th>
												<th>Kelas</th>
												<th>Waktu</th>
												<th>Pengawas</th>
												<th></th>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
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
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content fetched-data">
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambah-dokumen" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Berita Acara Pelaksanaan</h5>
					<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<form class="form" action="modul/ulangan/tambahbap.php" method="POST" id="createbapForm">
                        <div class="modal-body">
							<div class="row">
							  <div class="form-group col-md-8 col-12">
								<label>Jenis Penilaian</label>
								<select class="form-select" id="penilaian" name="penilaian">
									<option value="Penilaian Harian">Penilaian Harian (PH)</option>
									<option value="Penilaian Tengah Semester">Penilaian Tengah Semester (PTS)</option>
                                  	<option value="Sumatif Tengah Semester">Sumatif Tengah Semester (STS)</option>
									<option value="Penilaian Akhir Semester">Penilaian Akhir Semester (PAS)</option>
                                  	<option value="Sumatif Akhir Semester">Sumatif Akhir Semester (SAS)</option>
									<option value="Penilaian Akhir Tahun">Penilaian Akhir Tahun (PAT)</option>
                                  	<option value="Sumatif Akhir Tahun">Sumatif Akhir Tahun (SAT)</option>
								</select>
							  </div>
							  <div class="form-group col-md-4 col-12">
								<label>Kelas</label>
								<select class="form-select" id="kelas" name="kelas">
                                  	<option value="0">Pilih Kelas</option>
								<?php 
								$sql3 = "select * from rombel where tapel='$tapel' and smt='$smt' order by nama_rombel asc";
								$query3 = $connect->query($sql3);
								while($nk=$query3->fetch_assoc()){
								?>
									<option value="<?=$nk['nama_rombel'];?>">Kelas <?=$nk['nama_rombel'];?></option>
								<?php };?>
								</select>
							  </div>
							</div>
							<div class="row">
							  <div class="form-group col-md-4 col-12">
								<label>Tanggal</label>
								<input type="text" name="tanggal" id="tanggal" value="<?=date('Y-m-d');?>" class="form-control"  required>
							  </div>
							  <div class="form-group col-md-4 col-12">
								<label>Waktu Mulai</label>
								<input type="text" name="jam1" class="form-control">
								<input type="hidden" name="tapel" class="form-control" value="<?=$tapel;?>">
								<input type="hidden" name="smt" class="form-control" value="<?=$smt;?>">
							  </div>
							  <div class="form-group col-md-4 col-12">
								<label>Waktu Selesai</label>
								<input type="text" name="jam2" class="form-control">
							  </div>
							</div>
							<div class="form-group form-group-default">
								<label>Mata Pelajaran</label>
								<input id="mapel" name="mapel" type="text" class="form-control" value="">
							</div>
							<div class="row">
							  <div class="form-group col-md-6 col-12">
								<label>Pengawas 1</label>
								<input type="text" id="pengawas1" name="pengawas1" class="form-control">
							  </div>
							  <div class="form-group col-md-6 col-12">
								<label>Pengawas 2</label>
								<input type="text" id="pengawas2" name="pengawas2" class="form-control">
							  </div>
							</div>
							<div class="form-group form-group-default">
								<label>Jumlah Tidak Hadir</label>
								<input id="jum_absen" type="text" name="jum_absen" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default">
								<label>Nomor Peserta Tidak Hadir (pisahkan dengan tanda koma)</label>
								<input id="nomor_absen" type="text" name="nomor_absen" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default">
								<label>Catatan</label>
								<input id="catatan" type="text" name="catatan" autocomplete=off class="form-control" placeholder="Catatan">
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-border btn-round btn-sm" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-info btn-border btn-round btn-sm">Simpan</button>
                        </div>
						</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	var TabelRombel;
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
$(document).ready(function(){
	$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
		$('#tanggal1').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
          	"order": [[0, 'desc']],
			"ajax": "modul/ulangan/berita-acara.php?tapel="+tapel+"&smt="+smt
		});
		
  	$('#kelas').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var kelas=$('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			$.ajax({
				type : 'GET',
				url : 'modul/ulangan/getguru.php',
				data :  'kelas=' +kelas+'&smt='+smt+'&tapel='+tapel,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#pengawas1").val(data);
					//$("#KDPeng").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mata Pelajaran</div>');
					//$("#KDKet").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mata Pelajaran</div>');
				}
			});
          	$.ajax({
				type : 'GET',
				url : 'modul/ulangan/getguru1.php',
				data :  'kelas=' +kelas+'&smt='+smt+'&tapel='+tapel,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#pengawas2").val(data);
					//$("#KDPeng").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mata Pelajaran</div>');
					//$("#KDKet").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mata Pelajaran</div>');
				}
			});
		});
		
		$("#addBAPModalBtn").on('click', function() {
			// reset the form 
			$("#createbapForm")[0].reset();
			
			// submit form
			$("#createbapForm").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : form.attr('action'),
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						success:function(response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								toastr["success"](response.messages);
								//swal(response.messages, {buttons: false,timer: 2000,});
								// reset the form
								$("#tambah-dokumen").modal('hide');

								// reload the datatables
								TabelRombel.ajax.reload(null, false);
								$("#createbapForm")[0].reset();
								// this function is built in function of datatables;

							} else {
								
								toastr["error"](response.messages)
								//swal(response.messages, {buttons: false,timer: 3000,});
								
							}  // /else
						} // success  
					}); // ajax subit 				
				


				return false;
			}); // /submit form for create member
		}); // /add modal
});
		
</script>
</body>
</html>
