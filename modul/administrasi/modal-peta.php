<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$peta=$_POST['rowid'];
$smt=$_POST['smt'];
$mpid=$_POST['mp'];
$kelas=$_POST['kelas'];
$ab=substr($kelas,0,1);
if($kelas==0 or $mpid==0){
?>
						<div class="modal-body">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Error!</strong> Kelas atau Mapel tidak boleh kosong!
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
						</div>
<?php }else{ ?>

						<div class="modal-header">
									<h5 class="modal-title">Pemetaan KD <?php if($peta==3) echo "Pengetahuan"; else echo "Ketrampilan"; ?></h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
						<div class="modal-body">
							<div class="form-group form-group-default">
								<label>Mapel</label>
								<input type="hidden" id="aspek" name="aspek" class="form-control" value="<?php echo $peta;?>">
								<input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $smt;?>">
								<input type="hidden" id="mapel" name="mapel" class="form-control" value="<?php echo $mpid;?>">
								<input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $kelas;?>">
								<?php $nmp=$connect->query("select * from mapel where id_mapel='$mpid'")->fetch_assoc();?>
								<input type="text" class="form-control" placeholder="Name" value="<?php echo $nmp['nama_mapel'];?>">
							</div>
							<?php if($mpid==1 or ($mpid==4 and $ab>3) or ($mpid==8 and $ab>3) or $mpid==9 or $mpid==10 or $mpid==11 or $mpid==12){ ?>
							<?php 
							$cekd1=$connect->query("select * from kd where kelas='$ab' and aspek='$peta' and mapel='$mpid'")->num_rows;
							if($cekd1>0){
							?>
							<div class="form-group form-group-default">
								<label>Pembelajaran</label>
								<input type="text" name="temaku" autocomplete=off class="form-control">
							</div>
							<?php }; ?>
							<?php }else{ ?>
							<div class="form-group form-group-default">
								<label>Tema</label>
								<select class="form-select" name="temaku">
									<?php 
									$sql2 = "select * from tema where kelas='$ab' and smt='$smt' order by tema asc";
									$qu3 = $connect->query($sql2);
									while($tma=$qu3->fetch_assoc()){
									?>
									<option value="<?=$tma['tema'];?>"><?=$tma['tema'];?>. <?=$tma['nama_tema'];?></option>
									<?php } ?>
								</select>
							</div>
							<?php }; ?>
							<div class="form-group form-group-default">
								<label>Kompetensi Dasar</label>
								<?php 
								  $cekd=$connect->query("select * from kd where kelas='$ab' and aspek='$peta' and mapel='$mpid'")->num_rows;
								  if($cekd>0){
								  ?>
									<select class="form-select" name="kd">
									<?php 
									$sql2 = "select * from kd where kelas='$ab' and aspek='$peta' and mapel='$mpid'";
									$qu3 = $connect->query($sql2);
									while($apk=$qu3->fetch_assoc()){ 
									?>
									<option value="<?=$apk['kd'];?>"><?=$apk['kd'];?></option>
									<?php }; ?>
									</select>
								  <?php }else{ ?>
									<p class="form-control-static">Belum ada Kompetensi Dasar</p>
								  <?php }; ?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan</button>
						</div>
<?php } ?>