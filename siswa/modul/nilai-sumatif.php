<?php
require_once '../config/config.php';
require_once '../config/db_connect.php';
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$mp=$_GET['mapel'];
$idp=$_GET['pdid'];
$sql1 = "select * from sumatif where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mp' order by lm asc";
$query1 = $connect->query($sql1);
?>
<!--K13-->
							
									<?php 
									while($nn=$query1->fetch_assoc()){
										$ab=substr($nn['kelas'],0,1);
										$idlm=$nn['lm'];
										$lingkup = $connect->query("select * from lingkup_materi where kelas='$ab' and smt='$smt' and mapel='$mp' and lm='$idlm'")->fetch_assoc();
									?>
									<br/>
									<div class="card product-card">
										<div class="card-body">
											<h2 class="title"><?=$lingkup['nama_lm'];?></h2>
											<p class="text"></p>
											<div class="price"><?=number_format($nn['nilai'],0);?></div>
										</div>
									</div>
									<?php } ?>