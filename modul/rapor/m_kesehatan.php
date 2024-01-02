<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$tapel=$_POST['tapel'];
$smt=$_POST['smt'];
$kelas=$_POST['kelas'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$ids'")->fetch_assoc();
if($smt==1){
	$tahun1=substr($tapel,0,4);
	$tahun2=substr($tapel,5,4);
	$tahunseb1=(int) $tahun1-1;
	$tahunseb2=(int) $tahun2-1;
	$tapelseb=$tahunseb1."/".$tahunseb2;
	$smtseb=2;
}else{
	$tapelseb=$tapel;
	$smtseb=1;
};
$kes=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$ids' AND smt='$smtseb' AND tapel='$tapelseb'")->fetch_assoc();
$kess=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$ids' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Data Kesehatan <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idpd" class="form-control"  value="<?=$siswa['peserta_didik_id'];?>">
					<input type="hidden" name="smt" class="form-control"  value="<?=$smt;?>">
					<input type="hidden" name="tapel" class="form-control"  value="<?=$tapel;?>">
					<input type="hidden" name="kelas" class="form-control"  value="<?=$kelas;?>">
					<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbKesehatan">
						<thead>
						  <tr>
							<th>Aspek</th>
							<th>Semester Lalu</th>
							<th>Semester Sekarang</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>Tinggi Badan (cm)</td>
							<td><input type="text" class="form-control" value="<?=$kes['tinggi'];?>" readonly="true"></td>
							<td><input type="text" class="form-control" name="tinggi" value="<?=$kess['tinggi'];?>"></td>
						  </tr>
						  <tr>
							<td>Berat Badan (Kg)</td>
							<td><input type="text" class="form-control" value="<?=$kes['berat'];?>" readonly="true"></td>
							<td><input type="text" class="form-control" name="berat" value="<?=$kess['berat'];?>"></td>
						  </tr>
						  <tr>
							<td>Pendengaran</td>
							<td><input type="text" class="form-control" value="<?=$kes['pendengaran'];?>" readonly="true"></td>
							<td><input type="text" class="form-control" name="pendengaran" value="<?=$kess['pendengaran'];?>"></td>
						  </tr>
						  <tr>
							<td>Penglihatan</td>
							<td><input type="text" class="form-control" value="<?=$kes['penglihatan'];?>" readonly="true"></td>
							<td><input type="text" class="form-control" name="penglihatan" value="<?=$kess['penglihatan'];?>"></td>
						  </tr>
						  <tr>
							<td>Gigi</td>
							<td><input type="text" class="form-control" value="<?=$kes['gigi'];?>" readonly="true"></td>
							<td><input type="text" class="form-control" name="gigi" value="<?=$kess['gigi'];?>"></td>
						  </tr>
						  <tr>
							<td>Lainnya</td>
							<td><input type="text" class="form-control" value="<?=$kes['lainnya'];?>" readonly="true"></td>
							<td><input type="text" class="form-control" name="lainnya" value="<?=$kess['lainnya'];?>"></td>
						  </tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>