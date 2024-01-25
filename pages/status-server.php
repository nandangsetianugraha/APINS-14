<?php $data="Status Server";?>
<?php include "layout/head.php"; ?>
<style>
		#errorMs {
			color: #a00;
		}
		.gallery img{
            width: 300px;
		}
	</style>
</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<?php include "layout/aside.php";?>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<?php include "layout/header.php";?>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							
                                            <div class="portlet mb-0">
												<div class="portlet-body">
													<nav class="mb-3">
														<!-- BEGIN Nav -->
														<div class="nav nav-tabs" id="nav3-tab">
															<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
															<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
															<a class="nav-item nav-link active" id="nav3-home-tab" data-bs-toggle="tab" href="#nav3-home">Server</a>
															<a class="nav-item nav-link" id="nav3-home-tab" data-bs-toggle="tab" href="#nav3-titimangsa">Titimangsa Rapor</a>
															<a class="nav-item nav-link" id="nav3-profile-tab" data-bs-toggle="tab" href="#nav3-profile">Konfigurasi Lainnya</a>
															<a class="nav-item nav-link" id="nav3-contact-tab" data-bs-toggle="tab" href="#nav3-contact">Identitas Sekolah</a>
															<a class="nav-item nav-link" id="nav3-logo-tab" data-bs-toggle="tab" href="#nav3-logo">Logo Sekolah</a>
														</div>
														<!-- END Nav -->
													</nav>
													<!-- BEGIN Tab -->
													<div class="tab-content" id="nav3-tabContent">
														<div class="tab-pane fade show active" id="nav3-home">
															<form class="d-grid gap-3" action="modul/setting/update-server.php" autocomplete="off" method="POST" id="ubahForm" autocomplete="off">
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="ptapel" name="ptapel">
                                                                            <?php 
                                                                            $sql4 = "select * from tapel order by nama_tapel asc";
                                                                            $query4 = $connect->query($sql4);
                                                                            $ak=0;
                                                                            while($nk=$query4->fetch_assoc()){
                                                                                if($tapel==$nk['nama_tapel']){
                                                                                    $stt="selected";
                                                                                }else{
                                                                                    $stt='';
                                                                                };
                                                                                echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahTema"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusTapel"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Semester</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="psmt" name="psmt">
                                                                            <option value="0">Pilih Semester</option>
                                                                            <option value="1" <?php if($smt==1) echo "selected"; ?>>Semester 1</option>
                                                                            <option value="2" <?php if($smt==2) echo "selected"; ?>>Semester 2</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Perawatan</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="pstatus" name="pstatus">
                                                                            <option>Pilih Perawatan</option>
                                                                            <option value="0" <?php if($maintenis==0) echo "selected"; ?>>Tidak</option>
                                                                            <option value="1" <?php if($maintenis==1) echo "selected"; ?>>Ya</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12 text-end mt-3">
                                                                        <button type="submit" class="btn btn-primary modal-confirm">Simpan</button>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </form>
														</div>
														<div class="tab-pane fade show" id="nav3-titimangsa">
															<?php
															$ntitimangsa = $connect->query("select * from titimangsa WHERE smt='$smt' and tapel='$tapel'")->fetch_assoc();
															?>
															<form class="d-grid gap-3" action="modul/setting/update-titimangsa.php" autocomplete="off" method="POST" id="ubahTitimangsa" autocomplete="off">
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" class="form-control" name="smt" value="<?=$smt;?>"  required>
																		<input type="hidden" class="form-control" name="tapel" value="<?=$tapel;?>"  required>
																		<input type="text" class="form-control" name="tempat" value="<?=$ntitimangsa['tempat'];?>"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas 1 - 5</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?=$ntitimangsa['tanggal'];?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas 6</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" id="tanggal2" name="tanggal2" class="form-control" value="<?=$ntitimangsa['tanggal2'];?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 text-end mt-3">
                                                                        <button type="submit" class="btn btn-primary modal-confirm">Simpan</button>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </form>
														</div>
														<div class="tab-pane fade" id="nav3-profile">
															<form class="d-grid gap-3" autocomplete="off">
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Provinsi</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="prov" name="prov">
																			<option>Pilih Provinsi</option>
                                                                            <?php 
                                                                            $sql5 = "select * from provinsi order by id_prov asc";
                                                                            $query5 = $connect->query($sql5);
                                                                            while($nks=$query5->fetch_assoc()){
                                                                                echo '<option data-nilai="'.$nks['nama'].'" value="'.$nks['id_prov'].'">'.$nks['nama'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahProv"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusProv"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kabupaten</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="kabu" name="kabu">
                                                                            <option>Pilih Kabupaten</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahKab"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusKab"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kecamatan</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="keca" name="keca">
                                                                            <option>Pilih Kecamatan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahKec"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusKec"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Desa</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="desa" name="desa">
                                                                            <option>Pilih Desa</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahDesa"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusDesa"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mata Pelajaran K-13</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="mapelk13" name="mapelk13">
                                                                            <?php 
                                                                            $sql44 = "select * from mapel order by id_mapel asc";
                                                                            $query44 = $connect->query($sql44);
                                                                            while($nk4=$query44->fetch_assoc()){
                                                                                echo '<option data-nilai="'.$nk4['nama_mapel'].'" value="'.$nk4['id_mapel'].'" >'.$nk4['nama_mapel'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahMapelk13"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusMapelk13"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mata Pelajaran KurMer</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="mapelkm" name="mapelkm">
                                                                            <?php 
                                                                            $sql45 = "select * from mata_pelajaran order by id_mapel asc";
                                                                            $query45 = $connect->query($sql45);
                                                                            while($nk5=$query45->fetch_assoc()){
                                                                                echo '<option data-nilai="'.$nk5['nama_mapel'].'" value="'.$nk5['id_mapel'].'" >'.$nk5['nama_mapel'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahMapelkm"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusMapelkm"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ekstrakurikuler</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="ekskul" name="ekskul">
                                                                            <?php 
                                                                            $sql46 = "select * from ekskul order by id_ekskul asc";
                                                                            $query46 = $connect->query($sql46);
                                                                            while($nk6=$query46->fetch_assoc()){
                                                                                echo '<option data-nilai="'.$nk6['nama_ekskul'].'" value="'.$nk6['id_ekskul'].'" >'.$nk6['nama_ekskul'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahEkskul"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusEkskul"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-select" id="pekj" name="pekj">
                                                                            <?php 
                                                                            $sql47 = "select * from pekerjaan order by id_pekerjaan asc";
                                                                            $query47 = $connect->query($sql47);
                                                                            while($nk7=$query47->fetch_assoc()){
                                                                                echo '<option data-nilai="'.$nk7['nama_pekerjaan'].'" value="'.$nk7['id_pekerjaan'].'" >'.$nk7['nama_pekerjaan'].'</option>';
                                                                            }	
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahPekerjaan"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-danger" type="button" id="hapusPekerjaan"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </form>
														</div>
														<div class="tab-pane fade" id="nav3-contact">
															<?php
															$nsekd = $connect->query("select * from sekolah where sekolah_id='20162e13-2cf5-e011-91d5-a9ab0de328a2'")->fetch_assoc();
															?>
															<form class="d-grid gap-3" action="modul/setting/update-sekolah.php" autocomplete="off" method="POST" id="ubahSekolah" autocomplete="off">
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Sekolah</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?=$nsekd['nama'];?>">
																		<input type="hidden" class="form-control" id="idsek" name="idsek" value="20162e13-2cf5-e011-91d5-a9ab0de328a2" required>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Statistik Sekolah (NSS)</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" id="nss" name="nss" value="<?=$nsekd['nss'];?>">
																	</div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Pokok Sekolah Nasional (NPSN)</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" id="npsn" name="npsn" value="<?=$nsekd['npsn'];?>">
																	</div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat Jalan</label>
                                                                    <div class="col-sm-4">
                                                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?=$nsekd['alamat_jalan'];?></textarea>
                                                                    </div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">RT</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" class="form-control" id="rt" name="rt" value="<?=$nsekd['rt'];?>">
																	</div>
																	<label for="inputEmail3" class="col-sm-2 col-form-label">RW</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" class="form-control" id="rw" name="rw" value="<?=$nsekd['rw'];?>">
																	</div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Desa</label>
                                                                    <div class="col-sm-2">
                                                                        <select class="form-select" id="desas" name="desas">
                                                                            <?php 
                                                                            $sql15 = "select * from desa order by id asc";
                                                                            $query15 = $connect->query($sql15);
                                                                            while($nks1=$query15->fetch_assoc()){
																			?>
                                                                                <option data-nilai="<?=$nks1['nama'];?>" value="<?=$nks1['id'];?>" <?php if($nsekd['desa']==$nks1['id']) echo "selected"; ?>><?=$nks1['nama'];?></option>';
																			<?php 
                                                                            }	
                                                                            ?>
                                                                        </select>
																	</div>
																	<label for="inputEmail3" class="col-sm-2 col-form-label">Kecamatan</label>
                                                                    <div class="col-sm-2">
                                                                        <select class="form-select" id="kecs" name="kecs">
                                                                            <?php 
                                                                            $sql15 = "select * from kecamatan order by id asc";
                                                                            $query15 = $connect->query($sql15);
                                                                            while($nks1=$query15->fetch_assoc()){
																			?>
                                                                                <option data-nilai="<?=$nks1['nama'];?>" value="<?=$nks1['id'];?>" <?php if($nsekd['kecamatan']==$nks1['id']) echo "selected"; ?>><?=$nks1['nama'];?></option>';
																			<?php 
                                                                            }	
                                                                            ?>
                                                                        </select>
																	</div>
                                                                </div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kabupaten</label>
                                                                    <div class="col-sm-2">
                                                                        <select class="form-select" id="kabs" name="kabs">
                                                                            <?php 
                                                                            $sql15 = "select * from kabupaten order by id asc";
                                                                            $query15 = $connect->query($sql15);
                                                                            while($nks1=$query15->fetch_assoc()){
																			?>
                                                                                <option data-nilai="<?=$nks1['nama'];?>" value="<?=$nks1['id'];?>" <?php if($nsekd['kabupaten']==$nks1['id']) echo "selected"; ?>><?=$nks1['nama'];?></option>';
																			<?php 
                                                                            }	
                                                                            ?>
                                                                        </select>
																	</div>
																	<label for="inputEmail3" class="col-sm-2 col-form-label">Provinsi</label>
																	<div class="col-sm-2">
                                                                        <select class="form-select" id="provs" name="provs">
																			<?php 
                                                                            $sql15 = "select * from provinsi order by id_prov asc";
                                                                            $query15 = $connect->query($sql15);
                                                                            while($nks1=$query15->fetch_assoc()){
																			?>
                                                                                <option data-nilai="<?=$nks1['nama'];?>" value="<?=$nks1['id_prov'];?>" <?php if($nsekd['provinsi']==$nks1['id_prov']) echo "selected"; ?>><?=$nks1['nama'];?></option>';
																			<?php 
                                                                            }	
                                                                            ?>  
                                                                        </select>
																	</div>
																</div>
																<div class="row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kodepos</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?=$nsekd['kode_pos'];?>">
																	</div>
																	<label for="inputEmail3" class="col-sm-2 col-form-label">Lintang</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" class="form-control" id="lintang" name="lintang" value="<?=$nsekd['lintang'];?>">
																	</div>
																	<label for="inputEmail3" class="col-sm-2 col-form-label">Bujur</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" class="form-control" id="bujur" name="bujur" value="<?=$nsekd['bujur'];?>">
																	</div>
                                                                </div>
																<div class="row">
                                                                    <div class="col-md-12 text-end mt-3">
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
														</div>
														<div class="tab-pane fade" id="nav3-logo">
															<?php
															$nsek = $connect->query("select * from konfigurasi where id_conf=1")->fetch_assoc();
															?>
															<div class="gallery">
																<img src="<?=base_url();?>assets/<?=$nsek['image_login'];?>" id="preImg">
															</div>	
															<p id="errorMs"></p>
															<form action="<?=base_url();?>assets/upload.php"
																  id="form" 
																  method="post"
																  enctype="multipart/form-data">

																<input type="file"
																	   id="myImage">

																<input type="submit" 
																	   id="submit" 
																	   value="Simpan">
															</form>														
														</div>
													</div>
													<!-- END Tab -->
												</div>
											</div>

							
							<!-- END Portlet -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			<?php include "layout/footer.php";?>
			<!-- END Footer -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Modal -->
	<div class="modal fade" id="tambahTema">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tahun Ajaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="createTemaForm" method="POST" action="modul/setting/tambahtapel.php" class="form">
				<div class="modal-body">
					<div class="form-group form-group-default">
					<label>Tahun Ajaran</label>
						<input type="text" name="nama_tapel" autocomplete=off class="form-control" placeholder="Tahun Ajaran">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahMapelk13">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-mapel.php" autocomplete="off" method="POST" id="buatmapelk13">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahMapelkm">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-mapel.php" autocomplete="off" method="POST" id="buatmapelkm">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="tambahEkskul">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-ekskul.php" autocomplete="off" method="POST" id="buatekskul">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahProv">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-prov.php" autocomplete="off" method="POST" id="buatprov">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahKab">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-kab.php" autocomplete="off" method="POST" id="buatkab">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahKec">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-kec.php" autocomplete="off" method="POST" id="buatkec">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahDesa">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-desa.php" autocomplete="off" method="POST" id="buatdesa">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahPekerjaan">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-pekerjaan.php" autocomplete="off" method="POST" id="buatpekerjaan">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	toastr.options = {
			"closeButton": false,
			"debug": true,
			"newestOnTop": true,
			"progressBar": false,
			"positionClass": "toast-top-full-width",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": 300,
			"hideDuration": 1000,
			"timeOut": 2000,
			"extendedTimeOut": 500,
			"showEasing": "swing",
			"hideEasing": "swing",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
	$('#tanggal').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$('#tanggal2').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$(document).ready(function(){
      
      $("#submit").click(function(e){
      	e.preventDefault();

      	let form_data = new FormData();
      	let img = $("#myImage")[0].files;
 
        // Check image selected or not
        if(img.length > 0){
        	form_data.append('my_image', img[0]);

        	$.ajax({
        		url: 'assets/upload.php',
        		type: 'post',
        		data: form_data,
        		contentType: false,
                processData: false,
                success: function(res){
                	const data = JSON.parse(res);

                	if (data.error != 1) {
                       let path = "assets/"+data.src;
                       $("#preImg").attr("src", path);
                       $("#preImg").fadeOut(1).fadeIn(1000);
                       $("#myImage").val('');
					   location.reload();
                	}else {
                		$("#errorMs").text(data.em);
                	}
                }

        	});
         
        }else {
           $("#errorMs").text("Please select an image.");
        }
      });
	  $("#ubahSekolah").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	  }); // /submit form for create member
	  $("#ubahTitimangsa").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	  }); // /submit form for create member
        
    
	
	
	var isRtl = $("html").attr("dir") === "rtl";
	var direction = isRtl ? "right" : "left";
	$("#tanggal").datepicker({ 
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: direction, 
		todayHighlight: true 
	});
	
	$('#tambahProv').on('show.bs.modal', function (e) {
            var prov = $('#prov').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_prov.php',
				data :  'prov_id=' + prov,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatprov").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahProv").modal('hide');
					var tapel=$('#tapel').val();
					$.ajax({
						type : 'get',
						url : 'modul/setting/daftar-provinsi.php',
						data :  'tapel='+ tapel,
						success : function(data){
							$("#prov").html(data);
						}
					});
					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	
	$('#prov').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#prov').val();
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/kabupaten.php',
				data :  'prov_id=' + prov,
                dataType : 'HTML',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabu").html(data);
					$('#status').unblock();
				}
			});
	});
	$('#provs').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provs').val();
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/kabupaten.php',
				data :  'prov_id=' + prov,
                dataType : 'HTML',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabs").html(data);
					$('#status').unblock();
				}
			});
	});
	
	$('#tambahKab').on('show.bs.modal', function (e) {
            var prov = $('#prov').val();
			var kab = $('#kabu').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_kab.php',
				data :  'prov_id=' + prov+'&kab_id='+kab,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatkab").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahKab").modal('hide');
					var prov = $('#prov').val();
					$.ajax({
						type : 'GET',
						url : '<?=base_url();?>pages/kabupaten.php',
						data :  'prov_id=' + prov,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							$('#status').unblock();
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#kabu").html(data);
						}
					});
					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	$('#kabu').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kab = $('#kabu').val();
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/kecamatan.php',
				data :  'id_kabupaten=' + kab,
                dataType : 'HTML',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#keca").html(data);
					$('#status').unblock();
				}
			});
	});
	$('#kabs').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kab = $('#kabs').val();
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/kecamatan.php',
				data :  'id_kabupaten=' + kab,
                dataType : 'HTML',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kecs").html(data);
					$('#status').unblock();
				}
			});
	});
	
	$('#tambahKec').on('show.bs.modal', function (e) {
            var prov = $('#prov').val();
			var kab = $('#kabu').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_kec.php',
				data :  'prov_id=' + prov+'&kab_id='+kab,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatkec").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahKec").modal('hide');
					var kab = $('#kabu').val();
					$.ajax({
						type : 'GET',
						url : '<?=base_url();?>pages/kecamatan.php',
						data :  'id_kabupaten=' + kab,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							$('#status').unblock();
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#keca").html(data);
						}
					});

					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member

	$('#keca').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var desa = $('#keca').val();
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/desa.php',
				data :  'id_kecamatan=' + desa,
                dataType : 'HTML',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#desa").html(data);
					$('#status').unblock();
					// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
				}
			});
	});
	$('#kecs').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var desa = $('#kecs').val();
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/desa.php',
				data :  'id_kecamatan=' + desa,
                dataType : 'HTML',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#desas").html(data);
					$('#status').unblock();
					// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
				}
			});
	});
	
	$('#tambahDesa').on('show.bs.modal', function (e) {
            var prov = $('#prov').val();
			var kab = $('#kabu').val();
			var kec = $('#keca').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_desa.php',
				data :  'prov_id=' + prov+'&kab_id='+kab+'&kec_id='+kec,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatdesa").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahDesa").modal('hide');
					var desa = $('#keca').val();
					$.ajax({
						type : 'GET',
						url : '<?=base_url();?>pages/desa.php',
						data :  'id_kecamatan=' + desa,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#desa").html(data);
							$('#status').unblock();
							// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
						}
					});

					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	$('#tambahPekerjaan').on('show.bs.modal', function (e) {
            var pekj = $('#pekj').val();
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_pekerjaan.php',
				data :  'jns=' + pekj,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatpekerjaan").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahPekerjaan").modal('hide');
					var pekj = $('#pekj').val();
					$.ajax({
						type : 'GET',
						url : 'modul/setting/daftar-pekerjaan.php',
						data :  'jns=' + pekj,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							$("#pekj").html(data);
							$('#status').unblock();
						}
					});
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	});
	
	$('#tambahMapelk13').on('show.bs.modal', function (e) {
            const kur = 'k13';
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_mapel.php',
				data :  'jns=' + kur,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatmapelk13").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahMapelk13").modal('hide');
					const jns = 'k13';
					$.ajax({
						type : 'GET',
						url : 'modul/setting/daftar-mapel.php',
						data :  'jns=' + jns,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#mapelk13").html(data);
							$('#status').unblock();
							// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
						}
					});

					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	$('#tambahMapelkm').on('show.bs.modal', function (e) {
            const kur = 'km';
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_mapel.php',
				data :  'jns=' + kur,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatmapelkm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahMapelkm").modal('hide');
					const jns = 'km';
					$.ajax({
						type : 'GET',
						url : 'modul/setting/daftar-mapel.php',
						data :  'jns=' + jns,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#mapelkm").html(data);
							$('#status').unblock();
							// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
						}
					});

					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	
	$('#tambahEkskul').on('show.bs.modal', function (e) {
            //menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/setting/m_ekskul.php',
				data :  'jns=1',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
	$("#buatekskul").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahEkskul").modal('hide');
					const jns = 'dta';
					$.ajax({
						type : 'GET',
						url : 'modul/setting/daftar-ekskul.php',
						data :  'jns=' + jns,
						dataType : 'HTML',
						beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
						success: function (data) {
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#ekskul").html(data);
							$('#status').unblock();
							// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
						}
					});

					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	
	$("#ubahForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	
	$("#createTemaForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#tambahTema").modal('hide');
					var tapel=$('#tapel').val();
					$.ajax({
						type : 'get',
						url : 'modul/setting/daftar-tapel.php',
						data :  'tapel='+ tapel,
						success : function(data){
							$("#ptapel").html(data);
						}
					});
					$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	$("#createTapelForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		//submi the form to server
		$.ajax({
			url : form.attr('action'),
			type : form.attr('method'),
			data : form.serialize(),
			dataType : 'json',
			success:function(response) {
				if(response.success == true) {
					toastr.success(response.messages);
					$("#hapusTema").modal('hide');
					var tapel=$('#tapel').val();
					$.ajax({
						type : 'get',
						url : 'modul/setting/daftar-tapel.php',
						data :  'tapel='+ tapel,
						success : function(data){
							$("#ptapel").html(data);
							$("#stapel").html(data);
						}
					});
					//$("#createTemaForm")[0].reset();
				} else {
					toastr.error(response.messages);
				}  // /else
			} // success  
		}); // ajax subit 				
		return false;
	}); // /submit form for create member
	
		$( "#hapusProv" ).click(function() {
			var prov = $('#prov').val();
			if(prov == 0){
				Swal.fire("Kesalahan",'Pilih Provinsi Dahulu',"error");
				//swal('Pilih Kelas Dahulu', {buttons: false,timer: 1000,});
			}else{
				removeProvinsi(prov);
				//window.open('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt,' _blank');
			}
		});
		$( "#hapusKab" ).click(function() {
			var kab = $('#kabu').val();
			if(kab == 0){
				Swal.fire("Kesalahan",'Pilih Kabupaten Dahulu',"error");
				//swal('Pilih Kelas Dahulu', {buttons: false,timer: 1000,});
			}else{
				removeKabupaten(kab);
				//window.open('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt,' _blank');
			}
		});
		$( "#hapusKec" ).click(function() {
			var kec = $('#keca').val();
			if(kec == 0){
				Swal.fire("Kesalahan",'Pilih Kecamatan Dahulu',"error");
				//swal('Pilih Kelas Dahulu', {buttons: false,timer: 1000,});
			}else{
				removeKecamatan(kec);
				//window.open('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt,' _blank');
			}
		});
		$( "#hapusDesa" ).click(function() {
			var desa = $('#desa').val();
			if(desa == 0){
				Swal.fire("Kesalahan",'Pilih Desa Dahulu',"error");
				//swal('Pilih Kelas Dahulu', {buttons: false,timer: 1000,});
			}else{
				removeDesa(desa);
				//window.open('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt,' _blank');
			}
		});
		$( "#hapusTapel" ).click(function() {
			var tapel = $('#ptapel').val();
			if(tapel == 0){
				Swal.fire("Kesalahan",'Pilih Tapel Dahulu',"error");
				//swal('Pilih Kelas Dahulu', {buttons: false,timer: 1000,});
			}else{
				removeTapel(tapel);
				//window.open('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt,' _blank');
			}
		});		
		$( "#hapusMapelk13" ).click(function() {
			var mapel = $('#mapelk13').val();
			if(mapel == 0){
				Swal.fire("Kesalahan",'Pilih Mapel Dahulu',"error");
			}else{
				removeMapelk13(mapel);
			}
		});
		$( "#hapusMapelkm" ).click(function() {
			var mapel = $('#mapelkm').val();
			if(mapel == 0){
				Swal.fire("Kesalahan",'Pilih Mapel Dahulu',"error");
			}else{
				removeMapelkm(mapel);
			}
		});
		
		$( "#hapusEkskul" ).click(function() {
			var ekskul = $('#ekskul').val();
			if(ekskul == 0){
				Swal.fire("Kesalahan",'Pilih Ekskul Dahulu',"error");
			}else{
				removeEkskul(ekskul);
			}
		});
		$( "#hapusPekerjaan" ).click(function() {
			var pekj = $('#pekj').val();
			if(pekj == 0){
				Swal.fire("Kesalahan",'Pilih Pekerjaan Dahulu',"error");
			}else{
				removePekerjaan(pekj);
			}
		});
	});
	function removePekerjaan(id = null) {
		if(id) {
			// click on remove button
			const pekj = $('#pekj option:selected').data('nilai');
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Pekerjaan "+pekj+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-pekerjaan.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								$.ajax({
									type : 'GET',
									url : 'modul/setting/daftar-pekerjaan.php',
									data :  'jns=' + pekj,
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										$("#pekj").html(data);
										$('#status').unblock();
										// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeMapelk13(id = null) {
		if(id) {
			// click on remove button
			const mapel = $('#mapelk13 option:selected').data('nilai');
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Mata Pelajaran "+mapel+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-mapel.php',
						type: 'post',
						data: {member_id : id, jns : 'k13'},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								const jns = 'k13';
								$.ajax({
									type : 'GET',
									url : 'modul/setting/daftar-mapel.php',
									data :  'jns=' + jns,
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										$("#mapelk13").html(data);
										$('#status').unblock();
										// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeMapelkm(id = null) {
		if(id) {
			// click on remove button
			const mapel = $('#mapelkm option:selected').data('nilai');
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Mata Pelajaran "+mapel+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-mapel.php',
						type: 'post',
						data: {member_id : id, jns : 'km'},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								const jns = 'km';
								$.ajax({
									type : 'GET',
									url : 'modul/setting/daftar-mapel.php',
									data :  'jns=' + jns,
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										$("#mapelkm").html(data);
										$('#status').unblock();
										// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeEkskul(id = null) {
		if(id) {
			// click on remove button
			const ekskul = $('#ekskul option:selected').data('nilai');
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Ekstrakurikuler "+ekskul+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-ekskul.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								toastr.success(response.messages);
								$.ajax({
									type : 'GET',
									url : 'modul/setting/daftar-ekskul.php',
									data :  'jns=1',
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										//Swal.fire("Sukses",data.messages,"success");
										$("#ekskul").html(data);
										$('#status').unblock();
										
										// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeTapel(id = null) {
		if(id) {
			// click on remove button
			var tapel=$('#tapel').val();
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Tahun Ajaran "+tapel+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-tapel.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var tapel=$('#tapel').val();
								$.ajax({
									type : 'get',
									url : 'modul/setting/daftar-tapel.php',
									data :  'tapel='+ tapel,
									success : function(data){
										$("#ptapel").html(data);
										$("#stapel").html(data);
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeProvinsi(id = null) {
		if(id) {
			// click on remove button
			const prov = $('#prov option:selected').data('nilai');
			//var prov = $('#prov').val();
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Provinsi "+prov+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-provinsi.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var tapel=$('#tapel').val();
								$.ajax({
									type : 'get',
									url : 'modul/setting/daftar-provinsi.php',
									data :  'tapel='+ tapel,
									success : function(data){
										$("#prov").html(data);
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeKabupaten(id = null) {
		if(id) {
			// click on remove button
			const kab = $('#kabu option:selected').data('nilai');
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Kabupaten "+kab+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-kabupaten.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var prov = $('#prov').val();
								$.ajax({
									type : 'GET',
									url : '<?=base_url();?>pages/kabupaten.php',
									data :  'prov_id=' + prov,
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										$("#kabu").html(data);
										$('#status').unblock();
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeKecamatan(id = null) {
		if(id) {
			// click on remove button
			const kec = $('#keca option:selected').data('nilai');
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Kecamatan "+keca+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-kecamatan.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var kab = $('#kabu').val();
								$.ajax({
									type : 'GET',
									url : '<?=base_url();?>pages/kecamatan.php',
									data :  'id_kabupaten=' + kab,
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										$("#keca").html(data);
										$('#status').unblock();
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function removeDesa(id = null) {
		if(id) {
			// click on remove button
			const desa = $('#desa option:selected').data('nilai');
			//$('#selected').text(selectedPackage);
			//var desa = $('#desa').val();
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Desa "+desa+"?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-desa.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var desa = $('#keca').val();
								$.ajax({
									type : 'GET',
									url : '<?=base_url();?>pages/desa.php',
									data :  'id_kecamatan=' + desa,
									dataType : 'HTML',
									beforeSend: function()
									{	
										$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
									},
									success: function (data) {
										//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
										$("#desa").html(data);
										$('#status').unblock();
										// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
									}
								});
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	
	</script>
</body>
</html>
