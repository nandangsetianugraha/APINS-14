<?php
require_once '../config/config.php';
require_once '../config/db_connect.php';
$semester=$_GET['smt'];
$tapel=$_GET['tapel'];
$idptk=$_GET['pdid'];
$kelas = $connect->query("select * from penempatan where peserta_didik_id='$idptk' and tapel='$tapel' and smt='$semester'")->fetch_assoc();
$kls=$kelas['rombel'];
$kurikulum = $connect->query("select * from rombel where nama_rombel='$kls' and tapel='$tapel'")->fetch_assoc();
if($kurikulum['kurikulum']=='Kurikulum 2013'){
?>
<!--K13-->
							<div class="table-responsive">
								<?php 
								$cekd=$connect->query("SELECT * FROM deskripsi_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cekd>0){
								?>
								<h4>Spiritual dan Sosial</h4>
								<table class="table">
									<thead>
										<tr>
											<th>Kompetensi</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$dk1 = $connect->query("SELECT * FROM deskripsi_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and jns='k1'")->fetch_assoc();
									$dk2 = $connect->query("SELECT * FROM deskripsi_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and jns='k2'")->fetch_assoc();
									?>
										<tr>
											<td>Spiritual</td>
											<td><?=$dk1['deskripsi'];?></td>
										</tr>
										<tr>
											<td>Sosial</td>
											<td><?=$dk2['deskripsi'];?></td>
										</tr>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
							</div>
							<br/>
							<div class="table-responsive">
								<?php
								$sql1 = "SELECT * FROM raport_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel'";
								$query1 = $connect->query($sql1);
								$cekr=$query1->num_rows;
								if($cekr>0){
								?>
								<h4>Pengetahuan dan Ketrampilan</h4>
								<table class="table">
									<thead>
										<tr>
											<th rowspan="2">No</th>
											<th rowspan="2">Mapel</th>
											<th colspan="2">KI3</th>
											<th colspan="2">KI4</th>
										</tr>
										<tr>
											<th>N</th>
											<th>P</th>
											<th>N</th>
											<th>P</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sql = "select * from mapel ORDER BY id_mapel ASC";
										$query = $connect->query($sql);
										while ($row = $query->fetch_assoc()) {
											$idm=$row['id_mapel'];
											//KI3 Smt 1
											$sqlp13 = "SELECT * FROM raport_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and mapel='$idm' and jns='k3'";
											$cekp=$connect->query($sqlp13)->num_rows;
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
											//KI4 Smt 1
											$sqlp14 = "SELECT * FROM raport_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and mapel='$idm' and jns='k4'";
											$cekk=$connect->query($sqlp14)->num_rows;
											$pn14 = $connect->query($sqlp14)->fetch_assoc();
										?>
										<tr>
											<td><?=$row['id_mapel'];?></td>
											<td><?=$row['kd_mapel'];?></td>
											<td>
											<?php if($cekp>0){ echo number_format($pn13['nilai'],0);}?>
											</td>
											<td><?=$pn13['predikat'];?> <?php if($cekp>0){ ?><span class="iconedbox" data-jns="k3" data-tema="<?=$pn13['id_raport'];?>" data-toggle="modal" data-target="#deskp">
												<ion-icon name="help-circle-outline"></ion-icon>
											</span><?php } ?>
											</td>
											<td>
											<?php if($cekk>0){ echo number_format($pn14['nilai'],0);}?>
											</td>
											<td><?=$pn14['predikat'];?> <?php if($cekk>0){ ?><span class="iconedbox" data-jns="k4" data-tema="<?=$pn14['id_raport'];?>" data-toggle="modal" data-target="#deskp">
												<ion-icon name="help-circle-outline"></ion-icon>
											</span><?php } ?>
											</td>
										</tr>
										<?php } ?>									
									</tbody>
								</table>
								
								<?php }else{ ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<h4>Perhatian!</h4>
									<strong>Rapor Semester <?=$semester;?> Tahun Ajaran <?=$tapel;?></strong> Belum ada!
								</div>
								<?php } ?>
							</div>
							<br/>
								<!--Ekskul-->
								<div class="table-responsive">
								<?php 
								$cek1=$connect->query("SELECT * FROM data_ekskul WHERE peserta_didik_id='$idptk' and tapel='$tapel' and smt='$semester'")->num_rows;
								if($cek1>0){
								?>
								<h4>Ekstrakurikuler</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Ekstrakurikuler</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sql = "select * from ekskul ORDER BY id_ekskul ASC";
										$query = $connect->query($sql);
										while ($row = $query->fetch_assoc()) {
											$idek=$row['id_ekskul'];
											//Smt 1
											$sqlp13 = "SELECT * FROM data_ekskul WHERE peserta_didik_id='$idptk' and tapel='$tapel' and smt='$semester' and id_ekskul='$idek'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$row['id_ekskul'];?></td>
											<td><?=$row['nama_ekskul'];?></td>
											<td><?=$pn13['keterangan'];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								
								<br/>
								<!--Kesehatan-->
								<div class="table-responsive">
								<?php 
								$cek2=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cek2>0){
								?>
								<h4>Data Kesehatan</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Aspek Kesehatan</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sikap=array('Tinggi Badan','Berat Badan','Pendengaran','Penglihatan','Gigi','Lainnya');
										$aspek=array('tinggi','berat','pendengaran','penglihatan','gigi','lainnya');
										for ($x = 1; $x <= 6; $x++) {
											$sqlp13 = "SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$x;?></td>
											<td><?=$sikap[$x-1];?></td>
											<td><?=$pn13[$aspek[$x-1]];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								
								<br/>
								<!--Prestasi-->
								<div class="table-responsive">
								<?php 
								$cek3=$connect->query("SELECT * FROM data_prestasi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cek3>0){
								?>
								<h4>Data Prestasi</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Prestasi</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sikap=array('Kesenian','Olahraga','Akademik');
										$aspek=array('kesenian','olahraga','akademik');
										for ($x = 1; $x <= 3; $x++) {
											$sqlp13 = "SELECT * FROM data_prestasi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$x;?></td>
											<td><?=$sikap[$x-1];?></td>
											<td><?=$pn13[$aspek[$x-1]];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								
								<br/>
								<!--Absensi-->
								<div class="table-responsive">
								<?php 
								$cek4=$connect->query("SELECT * FROM data_absensi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cek4>0){
								?>
								<h4>Data Absensi</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Absensi</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sikap=array('Sakit','Ijin','Tanpa Keterangan');
										$aspek=array('sakit','ijin','alfa');
										for ($x = 1; $x <= 3; $x++) {
											$sqlp13 = "SELECT * FROM data_absensi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$x;?></td>
											<td><?=$sikap[$x-1];?></td>
											<td><?=$pn13[$aspek[$x-1]];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								<?php if($cekr>0){ ?>
								<a href="javascript;;" data-idp="<?=$idptk;?>" data-tapel="<?=$tapel;?>" data-smt="<?=$semester;?>" data-kelas="<?=$kls;?>" data-toggle="modal" data-target="#rapork13" class="btn btn-sm btn-primary btn-block">Cetak</a>
								<?php } ?>
<?php }else{ ?>
							<!--IKM-->
							<div class="table-responsive">
								<?php
								$sql1 = "SELECT * FROM raport_ikm WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel'";
								$query1 = $connect->query($sql1);
								$cekr=$query1->num_rows;
								if($cekr>0){
								?>
								<h4>Data Rapor</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Mapel</th>
											<th>Nilai</th>
											<th>Desk</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$sql = "select * from mata_pelajaran ORDER BY id_mapel ASC";
									$query = $connect->query($sql);
									while ($row = $query->fetch_assoc()) {
										$idm=$row['id_mapel'];
										//KI3 Smt 1
										$sqlp13 = "SELECT * FROM raport_ikm WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and mapel='$idm'";
										$ceks=$connect->query($sqlp13)->num_rows;
										$pn13 = $connect->query($sqlp13)->fetch_assoc();
									?>
										<tr>
											<td><?=$row['id_mapel'];?></td>
											<td><?=$row['kd_mapel'];?></td>
											<td><?=number_format($pn13['nilai'],0);?></td>
											<td><?php if($ceks>0){ ?>
											<span class="iconedbox" data-tema="<?=$pn13['id_raport'];?>" data-toggle="modal" data-target="#deskk">
												<ion-icon name="help-circle-outline"></ion-icon>
											</span>
											<?php } ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<h4>Perhatian!</h4>
									Rapor Semester <?=$semester;?> Tahun Ajaran <?=$tapel;?> Belum ada!
								</div>
								<?php } ?>
							</div>
							<br/>
								<!--Ekskul-->
								<div class="table-responsive">
								<?php 
								$cek1=$connect->query("SELECT * FROM data_ekskul WHERE peserta_didik_id='$idptk' and tapel='$tapel' and smt='$semester'")->num_rows;
								if($cek1>0){
								?>
								<h4>Ekstrakurikuler</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Ekstrakurikuler</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sql = "select * from ekskul ORDER BY id_ekskul ASC";
										$query = $connect->query($sql);
										while ($row = $query->fetch_assoc()) {
											$idek=$row['id_ekskul'];
											//Smt 1
											$sqlp13 = "SELECT * FROM data_ekskul WHERE peserta_didik_id='$idptk' and tapel='$tapel' and smt='$semester' and id_ekskul='$idek'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$row['id_ekskul'];?></td>
											<td><?=$row['nama_ekskul'];?></td>
											<td><?=$pn13['keterangan'];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								
								<br/>
								<!--Kesehatan-->
								<div class="table-responsive">
								<?php 
								$cek2=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cek2>0){
								?>
								<h4>Data Kesehatan</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Aspek Kesehatan</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sikap=array('Tinggi Badan','Berat Badan','Pendengaran','Penglihatan','Gigi','Lainnya');
										$aspek=array('tinggi','berat','pendengaran','penglihatan','gigi','lainnya');
										for ($x = 1; $x <= 6; $x++) {
											$sqlp13 = "SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$x;?></td>
											<td><?=$sikap[$x-1];?></td>
											<td><?=$pn13[$aspek[$x-1]];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								
								<br/>
								<!--Prestasi-->
								<div class="table-responsive">
								<?php 
								$cek3=$connect->query("SELECT * FROM data_prestasi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cek3>0){
								?>
								<h4>Data Prestasi</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Prestasi</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sikap=array('Kesenian','Olahraga','Akademik');
										$aspek=array('kesenian','olahraga','akademik');
										for ($x = 1; $x <= 3; $x++) {
											$sqlp13 = "SELECT * FROM data_prestasi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$x;?></td>
											<td><?=$sikap[$x-1];?></td>
											<td><?=$pn13[$aspek[$x-1]];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								
								<br/>
								<!--Absensi-->
								<div class="table-responsive">
								<?php 
								$cek4=$connect->query("SELECT * FROM data_absensi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'")->num_rows;
								if($cek4>0){
								?>
								<h4>Data Absensi</h4>
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Absensi</th>
											<th>Deskripsi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sikap=array('Sakit','Ijin','Tanpa Keterangan');
										$aspek=array('sakit','ijin','alfa');
										for ($x = 1; $x <= 3; $x++) {
											$sqlp13 = "SELECT * FROM data_absensi WHERE peserta_didik_id='$idptk' and smt='$semester' and tapel='$tapel'";
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
										?>
										<tr>
											<td><?=$x;?></td>
											<td><?=$sikap[$x-1];?></td>
											<td><?=$pn13[$aspek[$x-1]];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
								<?php } ?>
								</div>
								<?php if($cekr>0){ ?>
								<button data-idp="<?=$idptk;?>" data-tapel="<?=$tapel;?>" data-smt="<?=$semester;?>" data-kelas="<?=$kls;?>" data-toggle="modal" data-target="#raporikm" class="btn btn-sm btn-primary btn-block">Cetak</button>
								<?php } ?>
<?php } ?>
								