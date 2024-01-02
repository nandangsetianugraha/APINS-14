<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$tapel=$_POST['tapel'];
$smt=$_POST['smt'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$ids'")->fetch_assoc();

$ckkur=$connect->query("select * from rombel where nama_rombel like '%6%' and tapel='$tapel'")->fetch_assoc();
$nkur=$ckkur['kurikulum'];
$idkur=$connect->query("select * from kurikulum where nama_kurikulum='$nkur'")->fetch_assoc();
$idk=$idkur['id_kurikulum'];
if($ckkur['kurikulum']=='Kurikulum 2013'){
	$sql4 = "select * from mapel order by id_mapel asc";
}else{
	$sql4 = "select * from mata_pelajaran order by id_mapel asc";
};
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Nilai US <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idpd" class="form-control"  value="<?=$siswa['peserta_didik_id'];?>">
					<input type="hidden" name="smt" class="form-control"  value="<?=$smt;?>">
					<input type="hidden" name="tapel" class="form-control"  value="<?=$tapel;?>">
					<input type="hidden" name="kur" class="form-control"  value="<?=$idk;?>">
					<div class="row">
					<?php 
					$query4 = $connect->query($sql4);
					while($nk=$query4->fetch_assoc()){
						$idmp=$nk['id_mapel'];
						$cekn = $connect->query("select * from nilai_us where tapel='$tapel' and peserta_didik_id='$ids' and kurikulum='$idk' and mapel='$idmp'")->num_rows;
						if($cekn>0){
							$m=$connect->query("select * from nilai_us where tapel='$tapel' and peserta_didik_id='$ids' and kurikulum='$idk' and mapel='$idmp'")->fetch_assoc();
							$nilaius=$m['nilai'];
						}else{
							$nilaius='';
						}
					?>
					<div class="col-6">
					<div class="form-group form-group-default">
						<label><?=$nk['kd_mapel'];?></label>
						<input type="text" class="form-control" name="mapel<?=$nk['id_mapel'];?>" value="<?=$nilaius;?>">
					</div>
					</div>
					<?php } ?>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
		
          <!-- END Connections -->