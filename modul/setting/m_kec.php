<?php 
require_once '../../config/db_connect.php';
$prov_id=$_POST['prov_id'];
$kab_id=$_POST['kab_id'];
$nprov=$connect->query("select * from provinsi where id_prov='$prov_id'")->fetch_assoc();
$nkab=$connect->query("select * from kabupaten where id='$kab_id' and id_provinsi='$prov_id'")->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Kecamatan</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
	<?php if($kab_id==0) { ?>
	<div class="alert alert-outline-secondary">
		<div class="alert-icon">
			<i class="fa fa-wrench"></i>
		</div>
		<div class="alert-content">Kabupaten nya dipilih dulu!</div>
	</div>
	<?php }else{ ?>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Provinsi</label>
			<input type="hidden" name="id_prov" autocomplete=off class="form-control" value="<?=$prov_id;?>">
			<input type="hidden" name="id_kab" autocomplete=off class="form-control" value="<?=$kab_id;?>">
			<input type="text" autocomplete=off class="form-control" value="[<?=$prov_id;?>] <?=$nprov['nama'];?>" readonly>
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kabupaten</label>
			<input type="text" autocomplete=off class="form-control"value="[<?=$kab_id;?>] <?=$nkab['nama'];?>" readonly>
		</div>
		<div class="mb-4">
			<?php 
			$idkec=$connect->query("SELECT * FROM kecamatan WHERE id_kabupaten='$kab_id' ORDER BY id DESC")->fetch_assoc();
			?>
			<label class="form-label" for="example-text-input">ID Kecamatan</label>
			<input type="text" name="id_kec" autocomplete=off class="form-control" value="<?=$idkec['id']+1;?>">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Nama Kecamatan</label>
			<input type="text" name="nama_kec" autocomplete=off class="form-control" placeholder="Nama Kecamatan">
		</div>
	<?php } ?>
</div>
<div class="modal-footer">
	<?php if($kab_id==0) {}else{ ?>
	<button type="submit" class="btn btn-primary">Simpan</button>
	<?php } ?>
</div>