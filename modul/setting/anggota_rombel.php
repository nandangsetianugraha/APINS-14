<?php 
require_once '../../config/db_connect.php';
$idr=$_POST['rowid'];
$romb=$connect->query("SELECT * FROM rombel where id_rombel='$idr'")->fetch_assoc();
$tapel=$romb['tapel'];
$kurikulum=$romb['kurikulum'];
$nrombel=$romb['nama_rombel'];
?>
				<div class="modal-header">
					<h5 class="modal-title">Anggota Rombel</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-6">
							<div class="portlet">
								
								<div class="portlet-body">
									<div class="table-responsive">
									<!-- BEGIN Datatable -->
									<table id="siswa-1" class="table table-bordered table-striped table-hover table-responsive">
										<thead>
											<tr>
												<th width="60%">Nama</th>
												<th>NIS</th>
												<th>NISN</th>
												<th>Kelas</th>
												
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Kelas</h3>
									<div class="portlet-addon">
										<select class="form-select" id="kelas" name="kelas">
											<option value="<?=$nrombel;?>">Kelas <?=$nrombel;?></option>
										</select>
										<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel_aktif;?>" placeholder="Username">
										<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt_aktif;?>" placeholder="Username">
									</div>
									
								</div>
								<div class="portlet-body">
									<div class="table-responsive">
									<!-- BEGIN Datatable -->
									<table id="siswa-2" class="table table-bordered table-striped table-hover table-responsive">
										<thead>
											<tr>
												<th width="60%">Nama</th>
												<th>NIS</th>
												<th>NISN</th>
												
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
<script>
	var Siswa1;
	var Siswa2;
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
		Siswa1 = $("#siswa-1").DataTable({ 
			destroy:true,
			responsive: true, 
			"ajax": "modul/siswa/siswakosongs.php?kelas="+kelas+"&smt="+smt+"&tapel="+tapel
		});
		Siswa2 = $("#siswa-2").DataTable({ 
			destroy:true,
			responsive: true, 
			"ajax": "modul/siswa/siswas.php?kelas="+kelas+"&smt="+smt+"&tapel="+tapel
		});
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			Siswa2 = $("#siswa-2").DataTable({ 
				destroy:true,
				responsive: true, 
				"ajax": "modul/siswa/siswas.php?kelas="+kelas+"&smt="+smt+"&tapel="+tapel
			});
		});
	});	
	function tempatkan(id = null,smt,tapel) {
		if(id) {
			// click on remove button
			var kelas = $('#kelas').val();
			$.ajax({
				url: 'modul/siswa/tempatkan-siswa.php',
				type: 'post',
				data: {idsiswa : id,kelas:kelas,smt:smt,tapel:tapel},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						Siswa1.ajax.reload(null, false);
						Siswa2.ajax.reload(null, false);
					} else {
						Swal.fire("Kesalahan",response.messages,"error");
					}
				}
			});
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function keluarkan(id = null) {
		if(id) {
			// click on remove button
			var kelas = $('#kelas').val();
			$.ajax({
				url: 'modul/siswa/keluarkan-siswa.php',
				type: 'post',
				data: {idr : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						Siswa1.ajax.reload(null, false);
						Siswa2.ajax.reload(null, false);
					} else {
						Swal.fire("Kesalahan",response.messages,"error");
					}
				}
			});
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	</script>				