<?php 
require_once '../../config/db_connect.php';
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
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Kelompok Mapel</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kurikulum</label>
			<input type="hidden" name="jns" autocomplete=off class="form-control" value="<?=$jns;?>">
			<input type="text" name="kurikulum" autocomplete=off class="form-control" value="<?=$jns;?>" readonly>
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kelompok Mata Pelajaran</label>
			<input type="text" name="kelompok" autocomplete=off class="form-control" placeholder="Kelompok Mapel">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Urutan</label>
			<input type="text" name="urutan" autocomplete=off class="form-control" placeholder="Urutan">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>
<?php } ?>