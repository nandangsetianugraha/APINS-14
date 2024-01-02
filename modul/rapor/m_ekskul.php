<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$tapel=$_POST['tapel'];
$smt=$_POST['smt'];
$kelas=$_POST['kelas'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$ids'")->fetch_assoc();
$sql = "SELECT * FROM ekskul order by id_ekskul asc";
$query = $connect->query($sql);
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Data Ekstrakurikuler <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idpd" class="form-control"  value="<?=$siswa['peserta_didik_id'];?>">
					<input type="hidden" name="smt" class="form-control"  value="<?=$smt;?>">
					<input type="hidden" name="tapel" class="form-control"  value="<?=$tapel;?>">
					<input type="hidden" name="kelas" class="form-control"  value="<?=$kelas;?>">
					<div class="form-group form-group-default">
						<label>Ekstrakurikuler</label>
						<select class="form-select" id="ide" name="ide">
						<?php 
						while ($row = $query->fetch_assoc()) {
						?>
							<option value="<?=$row['id_ekskul'];?>"><?=$row['nama_ekskul'];?></option>
						<?php 
						}
						?>
						</select>
					</div>
					<div class="form-group form-group-default">
						<label>Deskripsi Ekstrakurikuler</label>
						<textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Deskripsi Ekstrakurikuler.."></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
		
          <!-- END Connections -->