<?php 
require_once '../../config/db_connect.php';
$rowid=$_POST['rowid'];
$jns=$_POST['jns'];
if($jns=='0'){
?>
<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Pilih Dulu Kurikulum nya</div>
							</div>
<?php 
}else{
	if($jns==='Kurikulum 2013'){
		$nmapel = $connect->query("select * from mapel where id_mapel='$rowid'")->fetch_assoc();
	}elseif($jns==='Kurikulum Merdeka'){
		$nmapel = $connect->query("select * from mata_pelajaran where id_mapel='$rowid'")->fetch_assoc();
	}else{
	}
?>
<div class="modal-header">
	<h5 class="modal-title">Edit Mapel</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kode Mata Pelajaran</label>
			<input type="hidden" name="jns" autocomplete=off class="form-control" value="<?=$jns;?>">
			<input type="hidden" name="ids" autocomplete=off class="form-control" value="<?=$rowid;?>">
			<input type="text" name="kd_mapel" autocomplete=off class="form-control" value="<?=$nmapel['kd_mapel'];?>">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Mata Pelajaran</label>
			<input type="text" name="mapel" autocomplete=off class="form-control" value="<?=$nmapel['nama_mapel'];?>">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>
<?php } ?>