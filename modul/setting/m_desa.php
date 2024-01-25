<?php 
require_once '../../config/db_connect.php';
$prov_id=$_POST['prov_id'];
$kab_id=$_POST['kab_id'];
$kec_id=$_POST['kec_id'];
$nprov=$connect->query("select * from provinsi where id_prov='$prov_id'")->fetch_assoc();
$nkab=$connect->query("select * from kabupaten where id='$kab_id' and id_provinsi='$prov_id'")->fetch_assoc();
$nkec=$connect->query("select * from kecamatan where id='$kec_id' and id_kabupaten='$kab_id'")->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Desa</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
	<?php if($kec_id==0) { ?>
	<div class="alert alert-outline-secondary">
		<div class="alert-icon">
			<i class="fa fa-wrench"></i>
		</div>
		<div class="alert-content">Kecamatan nya dipilih dulu!</div>
	</div>
	<?php }else{ ?>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Provinsi</label>
			<input type="hidden" name="id_prov" autocomplete=off class="form-control" value="<?=$prov_id;?>">
			<input type="hidden" name="id_kab" autocomplete=off class="form-control" value="<?=$kab_id;?>">
			<input type="hidden" name="id_kec" autocomplete=off class="form-control" value="<?=$kec_id;?>">
			<input type="text" autocomplete=off class="form-control" value="[<?=$prov_id;?>] <?=$nprov['nama'];?>" readonly>
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kabupaten</label>
			<input type="text" autocomplete=off class="form-control" value="[<?=$kab_id;?>] <?=$nkab['nama'];?>" readonly>
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kecamatan</label>
			<input type="text" autocomplete=off class="form-control" value="[<?=$kec_id;?>] <?=$nkec['nama'];?>" readonly>
		</div>
		<div class="mb-4">
			<?php 
			$iddesa=$connect->query("SELECT * FROM desa WHERE id_kecamatan='$kec_id' ORDER BY id DESC")->fetch_assoc();
			?>
			<label class="form-label" for="example-text-input">ID Desa</label>
			<input type="text" name="id_desa" autocomplete=off class="form-control" value="<?=$iddesa['id']+1;?>">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Nama Desa</label>
			<input type="text" name="nama_desa" autocomplete=off class="form-control" placeholder="Nama Desa">
		</div>
	<?php } ?>
</div>
<div class="modal-footer">
	<?php if($kab_id==0) {}else{ ?>
	<button type="submit" class="btn btn-primary">Simpan</button>
	<?php } ?>
</div>