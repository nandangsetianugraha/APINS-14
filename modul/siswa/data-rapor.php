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
<?php }else{ ?>
							<!--IKM-->
							
								
										<!-- BEGIN Nav -->
										<div class="nav nav-lines portlet-nav" id="portlet4-tab">
											<a class="nav-item nav-link active" id="portlet4-ikm-tab" data-bs-toggle="tab" href="#portlet4-ikm">Rapor Intrakurikuler</a>
											<a class="nav-item nav-link" id="portlet4-p5-tab" data-bs-toggle="tab" href="#portlet4-p5">Rapor P5</a>
										</div>
										<!-- END Nav -->
								<br/>
								
									<div class="tab-content">
										<div class="tab-pane fade show active" id="portlet4-ikm">
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
										</div>
										<div class="tab-pane fade show" id="portlet4-p5">
											<?php 
											$cekp5=$connect->query("select * from data_proyek where kelas='$kls' and tapel='$tapel' and smt='$semester'")->num_rows;
											if($cekp5>0){
												$npro=$connect->query("select * from data_proyek where kelas='$kls' and tapel='$tapel' and smt='$semester'")->fetch_assoc();
												$proyek=$npro['id_proyek'];
												$vase=$npro['fase'];
											?>
												<table class="table table-bordered mb-0">
													<tbody>
														<tr>
															<td><h2><?=$npro['nama_proyek'];?></h2>
															<p><?=$npro['deskripsi_proyek'];?></p>
															</td>
														</tr>
													</tbody>
												</table>
												<br/>
												
														<?php 
														$sql = "select * from pemetaan_proyek where proyek='$proyek' order by dimensi asc";
														$query = $connect->query($sql);
														while($s=$query->fetch_assoc()) {
															$iddimensi=$s['dimensi'];
															$ndimensi=$connect->query("select * from dimensi_proyek where id_dimensi='$iddimensi'")->fetch_assoc();
															$nomor=1;
														?>
															<b>Dimensi : <?=$ndimensi['nama_dimensi'];?></b><br>
															<table class="table table-bordered mb-0">
																<thead>
																	<tr>
																		<th rowspan="2">No</th>
																		<th rowspan="2">Dimensi dan Sub Elemen</th>
																		<th colspan="4">Asesmen</th>
																	</tr>
																	<tr>
																		<th>BB</th>
																		<th>MB</th>
																		<th>BSH</th>
																		<th>BSB</th>
																	</tr>
																</thead>
																<tbody>
																	<?php 
																	$sql1 = "select * from elemen_proyek where dimensi='$iddimensi' and fase='$vase'";
																	$query1 = $connect->query($sql1);
																	while($n=$query1->fetch_assoc()) {
																		$idel=$n['id_elemen'];
																		$ada = $connect->query("select * from penilaian_proyek where peserta_didik_id='$idptk' AND kelas='$kls' AND smt='$semester' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$iddimensi'")->num_rows;
																		if($ada>0){
																			$utt=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idptk' AND kelas='$kls' AND smt='$semester' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$iddimensi'")->fetch_assoc();
																			$ncek=$utt['nilai'];
																			if($ncek==0){
																				$stat1='&#x2713;';
																				$stat2='';
																				$stat3='';
																				$stat4='';
																			}elseif($ncek==1){
																				$stat1='';
																				$stat2='&#x2713;';
																				$stat3='';
																				$stat4='';
																			}elseif($ncek==2){
																				$stat1='';
																				$stat2='';
																				$stat3='&#x2713;';
																				$stat4='';
																			}else{
																				$stat1='';
																				$stat2='';
																				$stat3='';
																				$stat4='&#x2713;';
																			};
																		}else{
																			$stat1='';
																			$stat2='';
																			$stat3='';
																			$stat4='';
																		};
																	?>
																	<tr>
																		<td><?=$nomor;?></td>
																		<td><b><?=$n['sub_elemen'];?></b>:<br/><?=$n['capaian'];?></td>
																		<td><?=$stat1;?></td>
																		<td><?=$stat2;?></td>
																		<td><?=$stat3;?></td>
																		<td><?=$stat4;?></td>
																	</tr>
																	<?php 
																	$nomor=$nomor+1;
																	};
																	$promin=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idptk' and kelas='$kls' and tapel='$tapel' and smt='$semester' and proyek='$proyek' and dimensi='$iddimensi' ORDER BY nilai desc LIMIT 1")->fetch_assoc();
																	$promax=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idptk' and kelas='$kls' and tapel='$tapel' and smt='$semester' and proyek='$proyek' and dimensi='$iddimensi' ORDER BY nilai asc LIMIT 1")->fetch_assoc();
																	$elmin=$promin['id_elemen'];
																	$elmax=$promax['id_elemen'];
																	$nmin=$connect->query("select * from elemen_proyek where id_elemen='$elmin'")->fetch_assoc();
																	$nmax=$connect->query("select * from elemen_proyek where id_elemen='$elmax'")->fetch_assoc();
																	$siswa=$connect->query("select * from siswa where peserta_didik_id='$idptk'")->fetch_assoc();
																	if(empty($elmin) or empty($elmax)){
																		$proses="";
																	}else{
																	$proses="Ananda ".$siswa['nama']." berkembang sangat baik dalam ".$nmax['capaian'].". Namun masih butuh bimbingan dalam ".$nmin['capaian'];
																	};
																	?>
																	<tr>
																		<td colspan="6"><b>Catatan Proses :</b> <?=$proses;?></td>
																	</tr>
																</tbody>
															</table>
															<br/>
														<?php } ?>
												
												
											<?php }else{ ?>
											<div class="alert alert-outline-secondary">
												<div class="alert-icon">
													<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
												</div>
												<div class="alert-content">Rapor P5 belum tersedia</div>
											</div>
											<?php } ?>
										</div>
									</div>
								
							
							
<?php } ?>
								