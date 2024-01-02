<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$tapel=$_POST['tapel'];
$smt=$_POST['smt'];
$kelas=$_POST['kelas'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$ids'")->fetch_assoc();

$sql = "SELECT * FROM saran WHERE peserta_didik_id='$ids' and smt='$smt' and tapel='$tapel'";
$query = $connect->query($sql)->fetch_assoc();
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Saran dan Pesan <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idpd" class="form-control"  value="<?=$siswa['peserta_didik_id'];?>">
					<input type="hidden" name="smt" class="form-control"  value="<?=$smt;?>">
					<input type="hidden" name="tapel" class="form-control"  value="<?=$tapel;?>">
					<input type="hidden" name="kelas" class="form-control"  value="<?=$kelas;?>">
					<div class="form-group form-group-default">
						<label>Saran dan Pesan</label>
						<textarea class="form-control" id="sarantext" name="sarantext" rows="4" placeholder="Saran dan Pesan.."><?=$query['saran'];?></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
		
          <!-- END Connections -->