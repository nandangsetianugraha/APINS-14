													<?php 
													require_once '../../config/config.php';
													require_once '../../config/db_connect.php'; 
													session_start();
													$idku=$_GET['id'];
													$level=$_SESSION['level'];
													?>
													<?php 
													$sql22 = "select * from pengumuman order by waktu desc limit 1";
													$query22 = $connect->query($sql22);
													$cek=$query22->num_rows;
													if($cek>0){
													while($jpesan=$query22->fetch_assoc()){
													?>
													<div class="rich-list-item flex-column align-items-stretch">
														<!-- BEGIN Rich List -->
														
														<div class="rich-list-item p-0 mb-2">
															<div class="rich-list-prepend">
																<!-- BEGIN Avatar -->
																<div class="avatar">
																	<div class="avatar-display" id="uploaded_image2">
																		<img src="assets/<?=$cfgs['image_login'];?>" alt="Avatar image">
																	</div>
																</div>
																<!-- END Avatar -->
															</div>
															<div class="rich-list-content">
																<h4 class="rich-list-title"><?=$jpesan['judul'];?></h4>
																<span class="rich-list-subtitle"><?=TanggalIndo($jpesan['waktu']);?></span>
															</div>
															<div class="rich-list-append">
																<?php if($level==11){ ?>
																<div class="row g-3">
																	<div class="col-md-6">
																		<a href="edit-pengumuman/<?=$jpesan['id'];?>" class="btn btn-sm btn-icon btn-primary"><i class="fa-solid fa-pencil"></i></a>
																	</div>
																	<div class="col-md-6">
																		<button class="btn btn-icon btn-sm btn-danger" onclick="removePengumuman('<?=$jpesan['id'];?>')"> <i class="fa fa-trash"></i></button>
																	</div>
																</div>
																
																
																<?php } ?>
																
															</div>
														</div>
														<p class="text-justify mb-0"><?=$jpesan['berita'];?></p>
														<!-- END Rich List -->
													</div>
													<?php }}else{ ?>
													<div class="rich-list-item flex-column align-items-stretch">
														<!-- BEGIN Rich List -->
														
														<div class="rich-list-item p-0 mb-2">
															<div class="rich-list-prepend">
																<!-- BEGIN Avatar -->
																<div class="avatar">
																	<div class="avatar-display" id="uploaded_image2">
																		<img src="assets/<?=$cfgs['image_login'];?>" alt="Avatar image">
																	</div>
																</div>
																<!-- END Avatar -->
															</div>
															<div class="rich-list-content">
																<h4 class="rich-list-title">Admin</h4>
																<span class="rich-list-subtitle"><?=TanggalIndo(date('Y-m-d'));?></span>
															</div>
															<div class="rich-list-append">
																
															</div>
														</div>
														<p class="text-justify mb-0">Belum ada Pengumuman</p>
														<!-- END Rich List -->
													</div>
													<?php } ?>
