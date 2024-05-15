<?php 
require_once '../../config/db_connect.php';
$kelas=$_POST['kelas'];
$smt=$_POST['smt'];
$tapel=$_POST['tapel'];
$proyek=$_POST['proyek'];
?>
				<div class="modal-header">
					<h5 class="modal-title">Pemetaan Proyek</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="okkk">
					<div class="mb-4">
                      <input type="hidden" class="form-control" name="kelas" value="<?=$kelas;?>">
					  <input type="hidden" class="form-control" name="smt" value="<?=$smt;?>">
					  <input type="hidden" class="form-control" name="tapel" value="<?=$tapel;?>">
					  <input type="hidden" class="form-control" name="proyek" value="<?=$proyek;?>">
					  <label>Dimensi</label>
					  <select class="form-select" id="dimensi" name="dimensi">
							<option value="0">Pilih Dimensi</option>
							<?php 
							$sql4 = "select * from dimensi_proyek order by id_dimensi asc";
							$query4 = $connect->query($sql4);
							$ck=0;
							while($nk=$query4->fetch_assoc()){
							?>
							<option value="<?=$nk['id_dimensi'];?>"><?=$nk['nama_dimensi'];?></option>
							<?php
							};
							?>
					  </select>
					  
                    </div>
					<div class="mb-4">
						<label>Elemen</label>
						<select class="form-select" id="elemen" name="elemen">
							<option value="0">Pilih Elemen</option>
					  </select>
					</div>
					<div class="mb-4">
					  <label>Sub Elemen</label>
					  <select class="form-select" id="sub_elemen" name="sub_elemen">
							<option value="0">Pilih Sub Elemen</option>
					  </select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
<script>
		$('#dimensi').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var dimensi = $('#dimensi').val();
			var kelas = $('#kelas').val();
			
			$.ajax({
				type : 'GET',
				url : 'modul/proyek/daftar-elemen.php',
				data :  'dimensi='+dimensi+'&kelas='+kelas,
				beforeSend: function()
				{	
					$('#okkk').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#okkk').unblock();
					$("#elemen").html(data);
				}
			});
		});
		$('#elemen').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var dimensi = $('#dimensi').val();
			var kelas = $('#kelas').val();
			var elemen = $('#elemen').val();
			
			$.ajax({
				type : 'GET',
				url : 'modul/proyek/daftar-sub_elemen.php',
				data :  'dimensi='+dimensi+'&kelas='+kelas+'&elemen='+elemen,
				beforeSend: function()
				{	
					$('#okkk').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#okkk').unblock();
					$("#sub_elemen").html(data);
				}
			});
		});
</script>			