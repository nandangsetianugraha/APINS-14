													<?php 
													require_once '../../config/config.php';
													require_once '../../config/db_connect.php'; 
													
													session_start();
													$level=$_SESSION['level'];
													$idku=$_GET['idptk'];
													$jns = isset($_GET['jns']) ? $_GET['jns'] : '0';
                                                    $hariini=date('Y-m-d H:i:s');
													$waktus = explode(' ',$hariini);
													?>
													<?php 
															if($level==11){
																$logs = $connect->query("select * from log order by logDate desc limit 5");
															}else{
																$logs = $connect->query("select * from log where ptk_id='$idku' order by logDate desc limit 5");
															};
															$jlogs=$logs->num_rows;
															
															if($jlogs>0){
																while($mlogs=$logs->fetch_assoc()){
																	$idlog=$mlogs['id'];
																	$iduser=$mlogs['ptk_id'];
																	$nama=$connect->query("select * from ptk where ptk_id='$iduser'")->fetch_assoc();
																	$waktu = explode(' ',$mlogs['logDate']);
														?>
														<div class="rich-list-item">
															<div class="rich-list-prepend">
																<!-- BEGIN Avatar -->
																<div class="avatar avatar-label-info">
																	<div class="avatar-display">
																		<img alt="AI" src="images/ptk/<?=$nama['gambar'];?>" class=" img-fluid">
																	</div>
																</div>
																<!-- END Avatar -->
															</div>
															<div class="rich-list-content">
																<h4 class="rich-list-title"><?=$nama['nama'];?></h4>
																<span class="rich-list-subtitle"><?=namahari($waktu[0]);?>, <?=TanggalIndo($waktu[0]);?> <?=$waktu[1];?> - <?=$mlogs['activity'];?></span>
															</div>
															<?php if($level==11){ ?>
															<div class="rich-list-append">
																<button onclick="removeAktivitas(<?=$idlog;?>)" class="btn btn-text-secondary btn-icon">
																	<i class="fa fa-trash"></i>
																</button>
															</div>
															<?php } ?>
														</div>
														<?php }}else{ 
                                                        $hariini=date('Y-m-d H:i:s');
													    $waktus = explode(' ',$hariini);    
                                                        ?>
														<div class="rich-list-item">
															<div class="rich-list-prepend">
																<!-- BEGIN Avatar -->
																<div class="avatar avatar-label-info">
																	<div class="avatar-display">
																		<img alt="AI" src="assets/<?=$cfgs['image_login'];?>" class=" img-fluid">
																	</div>
																</div>
																<!-- END Avatar -->
															</div>
															<div class="rich-list-content">
																<h4 class="rich-list-title">Belum Ada Aktivitas</h4>
																<span class="rich-list-subtitle"><?=namahari($waktus[0]);?>, <?=TanggalIndo($waktus[0]);?> <?=$waktus[1];?></span>
															</div>
														</div>
														<?php } ?>
