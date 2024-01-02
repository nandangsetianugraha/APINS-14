<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idr=$_POST['rowid'];
?>
						<div class="modal-header">
							<h5 class="modal-title">Tambah Pengguna</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<div class="form-group form-group-default">
								<label>PTK</label>
								<select class="form-select" name="idptk">
									<?php 
									$sql3 = "select * from ptk where status_keaktifan_id=1";
									$query3 = $connect->query($sql3);
									while($pto=$query3->fetch_assoc()){
									?>
									<option value="<?=$pto['ptk_id'];?>"><?=$pto['nama'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group form-group-default">
								<label>Level</label>
								<select class="form-select" name="jenispegawai">
									<?php 
									$sql2 = "select * from jenis_ptk";
									$query2 = $connect->query($sql2);
									while($po=$query2->fetch_assoc()){
									?>
									<option value="<?=$po['jenis_ptk_id'];?>"><?=$po['jenis_ptk'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group form-group-default">
								<label>Username</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fas fa-user-alt"></i>
									</span>
									<input type="text" class="form-control" name="pengguna" required>
								</div>
							</div>
							<div class="form-group form-group-default">
								<label>Password</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fas fa-lock"></i>
									</span>
									<input type="password" class="form-control" name="password" required>
								</div>
							</div>
							
						</div>
						<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan
																</button>
															</div>
<script>
	$('#hari').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$("#inputmask-3").inputmask({ mask: "99:99", placeholder: "" });
</script>
