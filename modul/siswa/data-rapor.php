<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$semester=$_POST['semester'];
$tapel=$_POST['tapel'];
$idptk=$_POST['rowid'];
$kelas = $connect->query("select * from penempatan where peserta_didik_id='$idptk' and tapel='$tapel' and smt='$semester'")->fetch_assoc();
$kls=$kelas['rombel'];
$kurikulum = $connect->query("select * from rombel where nama_rombel='$kls' and tapel='$tapel'")->fetch_assoc();
if($kurikulum['kurikulum']=='Kurikulum 2013'){
?>
<!--K13-->
<?php 
$ck1 = $connect->query("SELECT * FROM deskripsi_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and jns='k1'")->num_rows;
$ck2 = $connect->query("SELECT * FROM deskripsi_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and jns='k2'")->num_rows;
?>
							<div class="table-responsive">
								<table class="table table-bordered mb-0">
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
							</div>
							<br/>
							<div class="table-responsive">
								<table class="table table-bordered mb-0">
									<thead>
										<tr>
											<th rowspan="2">No</th>
											<th rowspan="2">Mapel</th>
											<th colspan="2">Pengetahuan</th>
											<th colspan="2">Ketrampilan</th>
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
											$pn13 = $connect->query($sqlp13)->fetch_assoc();
											//KI4 Smt 1
											$sqlp14 = "SELECT * FROM raport_k13 WHERE id_pd='$idptk' and smt='$semester' and tapel='$tapel' and mapel='$idm' and jns='k4'";
											$pn14 = $connect->query($sqlp14)->fetch_assoc();
										?>
										<tr>
											<td><?=$row['id_mapel'];?></td>
											<td><?=$row['nama_mapel'];?></td>
											<td><?=$pn13['nilai'];?></td>
											<td><?=$pn13['predikat'];?></td>
											<td><?=$pn14['nilai'];?></td>
											<td><?=$pn14['predikat'];?></td>
										</tr>
										<?php } ?>									
									</tbody>
								</table>
							</div>
<?php }else{ ?>
							<!--IKM-->
							<div class="table-responsive">
								<table class="table table-bordered mb-0">
									<thead>
										<tr>
											<th>No</th>
											<th>Mata Pelajaran</th>
											<th>Nilai</th>
											<th>Deskripsi</th>
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
										$pn13 = $connect->query($sqlp13)->fetch_assoc();
									?>
										<tr>
											<td><?=$row['id_mapel'];?></td>
											<td><?=$row['nama_mapel'];?></td>
											<td><?=$pn13['nilai'];?></td>
											<td><?=$pn13['deskripsi'];?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
<?php } ?>
								<br/><h4>Ekstrakurikuler</h4>
								<!--Ekskul-->
								<div class="table-responsive">
								<table class="table table-bordered mb-0">
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
											$sqlp13 = "SELECT * FROM data_ekskul WHERE peserta_didik_id='$idptk' and smt='1' and tapel='$tapel' and id_ekskul='$idek'";
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
								</div>
								
								<br/><h4>Data Kesehatan</h4>
								<!--Kesehatan-->
								<div class="table-responsive">
								<table class="table table-bordered mb-0">
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
								</div>
								
								<br/><h4>Data Prestasi</h4>
								<!--Prestasi-->
								<div class="table-responsive">
								<table class="table table-bordered mb-0">
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
								</div>
								
								<br/><h4>Data Absensi</h4>
								<!--Absensi-->
								<div class="table-responsive">
								<table class="table table-bordered mb-0">
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
								</div>
								
								