<?php 
require_once '../../config/db_connect.php';
$jns=$_POST['jns'];
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Pekerjaan</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kode Pekerjaan (Angka)</label>
			<input type="text" name="kd_pek" autocomplete=off class="form-control" placeholder="Kode Pekerjaan">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Nama Pekerjaan</label>
			<input type="text" name="pek" autocomplete=off class="form-control" placeholder="Nama Pekerjaan">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>