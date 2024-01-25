<?php 
require_once '../../config/db_connect.php';
$prov_id=$_POST['prov_id'];
$kab_id=$_POST['kab_id'];
$nprov=$connect->query("select * from provinsi where id_prov='$prov_id'")->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Kabupaten</h5>
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
		<div class="alert-content">Provinsi nya dipilih dulu!</div>
	</div>
	<?php }else{ ?>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Provinsi</label>
			<input type="hidden" name="id_prov" autocomplete=off class="form-control" value="<?=$prov_id;?>">
			<input type="text" autocomplete=off class="form-control" value="[<?=$prov_id;?>] <?=$nprov['nama'];?>" readonly>
		</div>
		<div class="mb-4">
			<?php 
			$idkab=$connect->query("SELECT * FROM kabupaten WHERE id_provinsi='$prov_id' ORDER BY id DESC")->fetch_assoc();
			?>
			<label class="form-label" for="example-text-input">ID Kabupaten</label>
			<input type="text" name="id_kab" autocomplete=off class="form-control" value="<?=$idkab['id']+1;?>">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Nama Kabupaten</label>
			<input type="text" name="nama_kab" autocomplete=off class="form-control" placeholder="Nama Kabupaten">
		</div>
	<?php } ?>
</div>
<div class="modal-footer">
	<?php if($prov_id==0) {}else{ ?>
	<button type="submit" class="btn btn-primary">Simpan</button>
	<?php } ?>
</div>