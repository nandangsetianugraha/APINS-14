<?php
require_once '../config/config.php';
require_once '../config/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$mp=$_GET['mapel'];
$idp=$_GET['pdid'];
$ab=substr($kelas,0,1);
$sql1 = "select * from nats where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' order by kd asc";
$query1 = $connect->query($sql1);
?>
<!--K13-->
							
									<?php 
									$cek = $query1->num_rows;
									if($cek>0){
									while($nn=$query1->fetch_assoc()){
										
										$idkd=$nn['kd'];
										$kds = $connect->query("select * from kd where kelas='$ab' and aspek='$tipe' and mapel='$mp' and kd='$idkd'")->fetch_assoc();
										
									?>
									<br/>
									<div class="card product-card">
										<div class="card-body">
											<h2 class="title">KD <?=$nn['kd'];?></h2>
											<p class="text"><?=$kds['nama_kd'];?></p>
											<div class="price"><?=number_format($nn['nilai'],0);?></div>
										</div>
									</div>
									<?php } 
									}else{?>
									<br/>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<h4>Perhatian!</h4>
										Nilai PAS belum ada atau belum diinput!
									</div>
									<?php } ?>