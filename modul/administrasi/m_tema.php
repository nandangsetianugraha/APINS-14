<?php 
require_once '../../config/db_connect.php';
$kelas=$_POST['kelas'];
$smt=$_POST['smt'];
$ab=substr($kelas,0,1);
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Tema</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
				<div class="modal-body">
					<?php if($kelas==0) { ?>
					<div class="alert alert-outline-secondary">
						<div class="alert-icon">
							<i class="fa fa-wrench"></i>
						</div>
						<div class="alert-content">Pilih Kelas terlebih dahulu!</div>
					</div>
					<?php }else{ ?>
					<div class="form-group form-group-default">
								<label>Nomor Tema</label>
								<input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $kelas;?>">
								<input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $smt;?>">
								<input id="tema" type="text" name="tema" autocomplete=off class="form-control" placeholder="Tema">
							</div>
							<div class="form-group form-group-default">
								<label>Deskripsi</label>
								<input id="nama_tema" type="text" name="nama_tema" autocomplete=off class="form-control" placeholder="Tema">
							</div>
					<?php } ?>
				</div>
				<div class="modal-footer">
					<?php if($kelas==0) {}else{ ?>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<?php } ?>
				</div>
				