<?php 
require_once '../../config/db_connect.php';
$kelas=$_POST['kelas'];
$ab=substr($kelas,0,1);
$smt=$_POST['smt'];
$mp=$_POST['mapel'];
$materi=$_POST['materi'];
$mapel=$connect->query("select * from mata_pelajaran where id_mapel='$mp'")->fetch_assoc();
$nama_materi=$connect->query("select * from lingkup_materi where kelas='$kelas' and smt='$smt' and mapel='$mp' and smt='$smt' and lm='$materi'")->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Tujuan Pembelajaran</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
				<div class="modal-body">
					<?php if($kelas==0 or $mp==0 or $materi==0 or $mapel==0) { ?>
					<div class="alert alert-outline-secondary">
						<div class="alert-icon">
							<i class="fa fa-wrench"></i>
						</div>
						<div class="alert-content">Kelas dan Mapel Harus diisi!</div>
					</div>
					<?php }else{ ?>
					<input type="hidden" class="form-control" id="kelas" name="kelas" value="<?=$kelas;?>">
					<input type="hidden" class="form-control" id="smt" name="smt" value="<?=$smt;?>">
					<input type="hidden" class="form-control" id="mp" name="mp" value="<?=$mp;?>">
					<input type="hidden" class="form-control" id="materi" name="materi" value="<?=$materi;?>">
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Lingkup Materi</label>
                      <input type="text" class="form-control" value="<?=$nama_materi['nama_lm'];?>" readonly="true">
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Kode TP</label>
                      <input type="text" class="form-control" id="kode_tp" name="kode_tp" placeholder="Kode TP" value="<?=$ab;?>.">
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Deskripsi TP</label>
					  <textarea class="form-control" id="tp" name="tp" rows="4" placeholder="Deskripsi TP.."></textarea>
                    </div>
					<?php } ?>
				</div>
				<div class="modal-footer">
					<?php if($kelas==0 or $mp==0 or $materi==0 or $mapel==0) {}else{ ?>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<?php } ?>
				</div>
				