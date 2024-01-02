<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idptk=$_POST['idptk'];
$cek="SELECT * FROM ptk WHERE ptk_id='$idptk'";
$hasil=$connect->query($cek);
$utt=$hasil->fetch_assoc();
?>

						<div class="modal-body">
							<div class="form-group form-group-default mb-2">
								<label>Jenjang</label>
								<input type="hidden" id="idptk" name="idptk" class="form-control" value="<?php echo $idptk;?>">
								<select id="jenjang" class="form-select" name="jenjang">
									<option value="0">Pilih Jenjang</option>
									<?php 
									$sql4 = "select * from jenjang_pendidikan order by id_jenjang asc";
									$query4 = $connect->query($sql4);
									while($nk=mysqli_fetch_array($query4)){
									?>
									<option value="<?php echo $nk['id_jenjang']; ?>"><?=$nk['nama_jenjang']; ?></option>
									<?php };?>
								</select>															
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Nama Satuan Pendidikan</label>
								<input id="satuan" type="text" name="satuan" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Fakultas/Jurusan</label>
								<input id="fakultas" type="text" name="fakultas" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Tahun Masuk</label>
								<input id="masuk" type="text" name="masuk" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Tahun Keluar</label>
								<input id="keluar" type="text" name="keluar" autocomplete=off class="form-control">
							</div>
						</div>
						<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan
																</button>
															</div>