<?php
require_once '../config/config.php';
require_once '../config/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tipe=$_GET['tipe'];
$tapel=$_GET['tapel'];
$mp=$_GET['mapel'];
$idp=$_GET['pdid'];
$ab=substr($kelas,0,1);
if($tipe==3){
	$sql1 = "select * from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' order by kd asc";
}else{
	$sql1 = "select * from nk where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' order by kd asc";
};
$query1 = $connect->query($sql1);
if(($ab>3 and $mp==4) or ($ab>3 and $mp==8) or $mp==9 or $mp==10 or $mp==11){
	$tm='Materi';
}else{
	$tm='Tema';
};
?>
<!--K13-->
							
									<?php 
									$cek = $query1->num_rows;
									if($cek>0){
									while($nn=$query1->fetch_assoc()){
										
										$idkd=$nn['kd'];
										$kds = $connect->query("select * from kd where kelas='$ab' and aspek='$tipe' and mapel='$mp' and kd='$idkd'")->fetch_assoc();
										if($tipe==3){
											if($nn['jns']=='tls') $jenis='Tulis';
											if($nn['jns']=='tgs1') $jenis='Tugas';
											if($nn['jns']=='lsn') $jenis='Lisan';
										}else{
											if($nn['jns']=='prak') $jenis='Praktek';
											if($nn['jns']=='port') $jenis='Portofolio';
											if($nn['jns']=='proy') $jenis='Proyek';
										};
									?>
									<br/>
									<div class="card product-card">
										<div class="card-body">
											<h2 class="title">KD <?=$nn['kd'];?> (<?=$tm;?> <?=$nn['tema'];?> - <?=$jenis;?>)</h2>
											<p class="text"><?=$kds['nama_kd'];?></p>
											<div class="price"><?=number_format($nn['nilai'],0);?></div>
										</div>
									</div>
									<?php } 
									}else{?>
									<br/>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<h4>Perhatian!</h4>
										Nilai Harian belum ada atau belum diinput!
									</div>
									<?php } ?>