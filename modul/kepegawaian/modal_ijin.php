<?php
include("../../config/db.php");
$idr=$_POST['rowid'];
$hari=$_POST['hari'];
$utt=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM id_pegawai WHERE pegawai_id='$idr'"));
$idpeg=$utt['ptk_id'];
$ntt=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ptk WHERE ptk_id='$idpeg'"));
?>
						<div class="modal-header">
							<h5 class="modal-title">Ijin Manual <?=$ntt['nama'];?></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<input type="hidden" name="idp" class="form-control" value="<?=$idr;?>">
							<input type="hidden" name="hari" class="form-control" value="<?=$hari;?>">
							<div class="form-group">
								<label>Mulai</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" id="tanggal1" name="tanggal_awal" value="<?=$hari;?>" class="form-control"  required>
								</div>
							</div>
							
							<div class="form-group">
								<label>Akhir</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" id="tanggal2" name="tanggal_akhir" value="<?=$hari;?>" class="form-control"  required>
								</div>
							</div>
							
							<div class="form-group">
								<label>Status</label>
								<select class="form-select" id="status" name="status">
									<option value="">Pilih Status</option>
									<option value="I">Ijin</option>
									<option value="S">Sakit</option>
									<option value="C">Cuti</option>
								</select>
								
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<input type="text" class="form-control" name="keterangan">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Simpan</button>
							<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
						</div>
						