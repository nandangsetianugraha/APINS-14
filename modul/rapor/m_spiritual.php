<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$utt=$connect->query("SELECT * FROM deskripsi_k13 WHERE id_raport='$ids'")->fetch_assoc();
$idsiswa=$utt['id_pd'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$idsiswa'")->fetch_assoc();
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Rapor Spiritual <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idraport" class="form-control" value="<?=$ids;?>">
					<div class="form-group form-group-default">
						<label>Deskripsi Spiritual</label>
						<textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi Spiritual.."><?=$utt['deskripsi'];?></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
		
          <!-- END Connections -->