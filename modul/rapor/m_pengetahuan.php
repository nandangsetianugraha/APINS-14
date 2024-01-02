<?php 
require_once '../../config/db_connect.php';
$ids=$_POST['rowid'];
$utt=$connect->query("SELECT * FROM raport_k13 WHERE id_raport='$ids'")->fetch_assoc();
$idsiswa=$utt['id_pd'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$idsiswa'")->fetch_assoc();
?>

<!-- Connections -->
				<div class="modal-header">
					<h5 class="modal-title">Rapor Pengetahuan <?=$siswa['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idraport" class="form-control" value="<?=$ids;?>">
					<input type="hidden" name="jns" class="form-control" value="<?php echo $utt['jns'];?>">
					<input type="hidden"  name="ids" class="form-control" value="<?php echo $siswa['peserta_didik_id'];?>">
					<input type="hidden" name="kelas" class="form-control" value="<?php echo $utt['kelas'];?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $utt['smt'];?>">
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $utt['tapel'];?>">
					<input type="hidden" name="kelas" class="form-control" value="<?php echo $utt['kelas'];?>">
					<input type="hidden" name="mapel" class="form-control" value="<?php echo $utt['mapel'];?>">
					<div class="form-group form-group-default">
						<label>Nilai</label>
						<input type="text" class="form-control" value="<?=number_format($utt['nilai'],0);?>" name="nilai">
					</div>
					<div class="form-group form-group-default">
						<label>Pedikat</label>
						<select class="form-control" name="predikat">
							<option value="A" <?php if($utt['predikat']=="A"){echo "selected";} ?>>A</option>
							<option value="B" <?php if($utt['predikat']=="B"){echo "selected";} ?>>B</option>
							<option value="C" <?php if($utt['predikat']=="C"){echo "selected";} ?>>C</option>
							<option value="D" <?php if($utt['predikat']=="D"){echo "selected";} ?>>D</option>
							<option value="E" <?php if($utt['predikat']=="E"){echo "selected";} ?>>E</option>
						</select>
					</div>
					<div class="form-group form-group-default">
						<label>Deskripsi Pengetahuan</label>
						<textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi Pengetahuan.."><?=$utt['deskripsi'];?></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
		
          <!-- END Connections -->