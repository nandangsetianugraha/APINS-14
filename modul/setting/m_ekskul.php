<?php 
require_once '../../config/db_connect.php';
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
			<input type="text" name="eks" autocomplete=off class="form-control" placeholder="Nama Ekstrakurikuler">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>