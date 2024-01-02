<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idr=$_POST['rowid'];
$row = $connect->query("select * from shift where id_shift='$idr'")->fetch_assoc();
?>
						<div class="modal-header">
							<h5 class="modal-title">Edit Shift Kerja</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<div class="form-group form-group-default row">
								<div class="form-group col-md-6 border-top-0 pt-0">
									<label for="inputCity">Tanggal Awal</label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fas fa-calendar-alt"></i>
										</span>
										<input type="text" id="tanggal_awal" name="tanggal_awal" value="<?=$row['tanggal_awal'];?>" class="form-control"  required>
										<input type="hidden" id="ids" name="ids" value="<?=$idr;?>" class="form-control">
									</div>
								</div>
								<div class="form-group col-md-6 border-top-0 pt-0">
									<label for="inputCity">Tanggal Awal</label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fas fa-calendar-alt"></i>
										</span>
										<input type="text" id="tanggal_akhir" name="tanggal_akhir" value="<?=$row['tanggal_akhir'];?>" class="form-control"  required>
									</div>
								</div>
							</div>
							<div class="form-group form-group-default">
								<label for="inputCity">Jam Masuk</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fa fa-volume-up"></i>
									</span>
									<input type="text" id="jam1" name="jam1" value="<?=$row['masuk'];?>" class="form-control"  required>
								</div>
							</div>
							<div class="form-group form-group-default">
								<label for="inputCity">Jam Pulang</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fa fa-volume-up"></i>
									</span>
									<input type="text" id="jam2" name="jam2" value="<?=$row['keluar'];?>" class="form-control"  required>
								</div>
							</div>							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan</button>
						</div>
						
