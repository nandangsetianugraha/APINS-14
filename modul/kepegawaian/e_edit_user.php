<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idr=$_POST['rowid'];
$cek="SELECT * FROM pengguna WHERE id='$idr'";
$hasil=$connect->query($cek);
$utt=$hasil->fetch_assoc();
$ptkid=$utt['ptk_id'];
$namapeg=$connect->query("select * from ptk where ptk_id='$ptkid'")->fetch_assoc();
?>
						<div class="modal-header">
							<h5 class="modal-title">Pengguna <?=$namapeg['nama'];?></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<div class="form-group form-group-default">
								<label>Username</label>
								<input type="hidden" id="id_peg" name="idpeg" class="form-control" value="<?php echo $idr;?>">
								<input type="text" class="form-control" name="username" value="<?=$utt['username'];?>">
							</div>
							<div class="form-group form-group-default">
								<label>Password</label>
								<input type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Ubah
																</button>
															</div>

