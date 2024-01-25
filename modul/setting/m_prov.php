<?php 
require_once '../../config/db_connect.php';
$prov_id=$_POST['prov_id'];
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Provinsi</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
	<?php if($prov_id==0) { ?>
	<div class="alert alert-outline-secondary">
		<div class="alert-icon">
			<i class="fa fa-wrench"></i>
		</div>
		<div class="alert-content">Error</div>
	</div>
	<?php }else{ ?>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">ID Provinsi</label>
			<?php 
			$idprov=$connect->query("SELECT * FROM provinsi WHERE id_prov IN (SELECT MAX(id_prov) FROM provinsi)")->fetch_assoc();
			?>
			<input type="text" name="id_prov" autocomplete=off class="form-control" value="<?=$idprov['id_prov']+1;?>">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Nama Provinsi</label>
			<input type="text" name="nama_prov" autocomplete=off class="form-control" placeholder="Nama Provinsi">
		</div>
	<?php } ?>
</div>
<div class="modal-footer">
	<?php if($prov_id==0) {}else{ ?>
	<button type="submit" class="btn btn-primary">Simpan</button>
	<?php } ?>
</div>