<?php 
require_once '../../config/db_connect.php';
$kelas=$_POST['kelas'];
$smt=$_POST['smt'];
$mapel=$_POST['mapel'];
?>
<div class="modal-header">
	<h5 class="modal-title">Lingkup Materi</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
	<?php if($kelas==0 or $mapel==0) { ?>
	<div class="alert alert-outline-secondary">
		<div class="alert-icon">
			<i class="fa fa-wrench"></i>
		</div>
		<div class="alert-content">Kelas dan Mapel Harus diisi!</div>
	</div>
	<?php }else{ ?>
		<input type="hidden" class="form-control" id="kelas" name="kelas" value="<?=$kelas;?>">
		<input type="hidden" class="form-control" id="smt" name="smt" value="<?=$smt;?>">
		<input type="hidden" class="form-control" id="mapel" name="mapel" value="<?=$mapel;?>">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kode Lingkup Materi</label>
			<input type="text" class="form-control" id="n_proyek" name="n_proyek" placeholder="Kode LM">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Deskripsi Lingkup Materi</label>
			<textarea class="form-control" id="d_proyek" name="d_proyek" rows="4" placeholder="Deskripsi LM.."></textarea>
		</div>
	<?php } ?>
</div>
<div class="modal-footer">
	<?php if($kelas==0 or $mapel==0) {}else{ ?>
	<button type="submit" class="btn btn-primary">Simpan</button>
	<?php } ?>
</div>