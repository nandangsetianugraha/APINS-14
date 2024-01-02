<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$tapel=$_POST['tapel'];
$smt=$_POST['smt'];
$kelas=$_POST['kelas'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$ids'")->fetch_assoc();

if($smt==1){
	$blnawal='07';
	$blnakhir='12';
	$tahun=substr($tapel,0,4);
}else{
	$blnawal='01';
	$blnakhir='06';
	$tahun=substr($tapel,5,4);
};
$absensi=$connect->query("SELECT SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa FROM absensi WHERE peserta_didik_id='$ids' and month(tanggal)>='$blnawal' and month(tanggal)<='$blnakhir' and year(tanggal)='$tahun'")->fetch_assoc();
if($absensi['sakit']==0 or empty($absensi['sakit'])){
	$sakit='-';
}else{
	$sakit=$absensi['sakit'];
};
if($absensi['ijin']==0 or empty($absensi['ijin'])){
	$ijin='-';
}else{
	$ijin=$absensi['ijin'];
};
if($absensi['alfa']==0 or empty($absensi['alfa'])){
	$alfa='-';
}else{
	$alfa=$absensi['alfa'];
};
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Data Absensi <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idpd" class="form-control"  value="<?=$siswa['peserta_didik_id'];?>">
					<input type="hidden" name="smt" class="form-control"  value="<?=$smt;?>">
					<input type="hidden" name="tapel" class="form-control"  value="<?=$tapel;?>">
					<input type="hidden" name="kelas" class="form-control"  value="<?=$kelas;?>">
					<div class="form-group form-group-default">
						<label>Sakit</label>
						<input type="text" class="form-control" name="sakit" value="<?=$sakit;?>">
					</div>
					<div class="form-group form-group-default">
						<label>Ijin</label>
						<input type="text" class="form-control" name="ijin" value="<?=$ijin;?>">
					</div>
					<div class="form-group form-group-default">
						<label>Tanpa Keterangan</label>
						<input type="text" class="form-control" name="alfa" value="<?=$alfa;?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
		
          <!-- END Connections -->