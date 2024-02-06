<?php 
require_once '../../config/db_connect.php';
$rowid=$_POST['rowid'];
$nmapel = $connect->query("select * from ekskul where id_ekskul='$rowid'")->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Ekstrakurikuler</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Nama Ekstrakurikuler</label>
			<input type="hidden" name="ids" autocomplete=off class="form-control" value="<?=$rowid;?>">
			<input type="text" name="eks" autocomplete=off class="form-control" value="<?=$nmapel['nama_ekskul'];?>">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>