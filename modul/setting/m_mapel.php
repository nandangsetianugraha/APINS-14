<?php 
require_once '../../config/db_connect.php';
$jns=$_POST['jns'];
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Mapel</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kode Mata Pelajaran</label>
			<input type="hidden" name="jns" autocomplete=off class="form-control" value="<?=$jns;?>">
			<input type="text" name="kd_mapel" autocomplete=off class="form-control" placeholder="Kode Mata Pelajaran">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Mata Pelajaran</label>
			<input type="text" name="mapel" autocomplete=off class="form-control" placeholder="Nama Mata Pelajaran">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>