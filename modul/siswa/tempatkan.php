<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$ids=$_GET['idsw'];
$idp=$_GET['siswa'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
$rombel=$connect->query("SELECT * FROM penempatan where peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
//hahahaha
?>
<div class="modal-body">
									<section class="card card-group">
										<header class="card-header bg-primary w-100">

											<div class="widget-profile-info">
												<div class="profile-picture">
													<img src="https://sdi-aljannah.web.id/apins/images/siswa/<?=$siswa['avatar'];?>" height="100px">
												</div>
												<div class="profile-info">
													<h4 class="name font-weight-semibold"><?=$siswa['nama'];?></h4>
													<h5 class="role"><?=$siswa['nis'];?> / <?=$siswa['nisn'];?></h5>
													<div class="profile-footer">
														<input type="hidden" class="form-control" name="siswa" value="<?=$idp;?>"/>
																<input type="hidden" class="form-control" name="tapel" value="<?=$tapel;?>"/>
																<input type="hidden" class="form-control" name="smt" value="<?=$smt;?>"/>
																<?php 
																$sql = "select * from rombel where tapel='$tapel' and smt='$smt'";
																$query = $connect->query($sql);
																?>
																<select name="kelas" data-control="select2" data-dropdown-parent="#tempatkan" data-placeholder="Pilih Kelas..." class="form-select form-select-solid">
																	<?php while ($row = $query->fetch_assoc()) { ?>
																	<option value="<?=$row['nama_rombel'];?>">Kelas <?=$row['nama_rombel'];?></option>
																	<?php } ?>
																</select>
													</div>
												</div>
											</div>

										</header>
									</section>
									
</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan
																</button>
															</div>
								
								

