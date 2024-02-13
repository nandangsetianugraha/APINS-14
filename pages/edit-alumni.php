<?php $data="Edit Alumni";?>
<?php include "layout/head.php"; 
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="<?=base_url();?>assets/css/croppie.css" />
<style>
#mapWrap {
    width: 100%;
    height: 400px; 
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
							<?php if($level<>11){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Hanya Admin!!</div>
							</div>
							<?php }else{ ?>
							<?php if($tipe==''){ ?>
							<?php }else{ 
							$idsis=$tipe;
							$cek = $connect->query("select * from siswa where peserta_didik_id='$idsis'")->num_rows;
							if($cek>0){
								$pn = $connect->query("select * from siswa where peserta_didik_id='$idsis'")->fetch_assoc();
							?>
							<div class="portlet" id="tampilan">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title"><?=$pn['nama'];?></h3>
									<div class="portlet-addon">
										<a href="<?=base_url();?>daftar-alumni" class="btn btn-danger">Kembali</a>
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div id="dip">
										<div id="image_demo" style="width:350px; margin-top:30px"></div>
										<button class="btn btn-success crop_image">Crop & Upload Image</button>
									</div>
									<div class="row" id="dip2">
										<div class="col-md-3">
											<b id="uploaded_image"><img src="<?=base_url();?>images/siswa/<?=$pn['avatar'];?>" width="100%" alt="avatar" id="blah"></b>
											<div class="profileupload">
												<input type="file" accept="image/*" name="upload_image" id="upload_image">
											</div><br/>
											<?php 
											$regis = $connect->query("select * from data_register where peserta_didik_id='$idsis'")->fetch_assoc();
											if(!empty($regis['lintang']) or !empty($regis['bujur'])){
												$lintang=$regis['lintang'];
												$bujur=$regis['bujur']
											?>
											
											<?php } ?>
											<input type="hidden" class="form-control" name="bujur" id="bujur" value="<?=$regis['bujur'];?>" required>
											<input type="hidden" class="form-control" name="lintang" id="lintang" value="<?=$regis['lintang'];?>" required>
											<div id="mapWrap"></div>
										</div>
										<div class="col-md-9">
											<div class="portlet" id="portlet1-profile">
												<div class="portlet-header portlet-header-bordered">
													<div class="portlet-addon">
														<!-- BEGIN Nav -->
														<div class="nav nav-lines portlet-nav" id="portlet4-tab">
															<a class="nav-item nav-link <?php if($act=='' or $act=='biodata'){ echo "active";} ?>" href="<?=base_url();?>edit-alumni/<?=$tipe;?>/biodata">Biodata</a>
															<input type="hidden" class="form-control" name="ptkid" id="idpt" value="<?=$pn['peserta_didik_id'];?>" required>
															<a class="nav-item nav-link <?php if($act=='register'){ echo "active";} ?>" href="<?=base_url();?>edit-alumni/<?=$tipe;?>/register">Data Registrasi</a>
															<a class="nav-item nav-link <?php if($act=='lulusan'){ echo "active";} ?>" href="<?=base_url();?>edit-alumni/<?=$tipe;?>/lulusan">Data Lulusan</a>
															<a class="nav-item nav-link <?php if($act=='kemenkes'){ echo "active";} ?>" href="<?=base_url();?>edit-alumni/<?=$tipe;?>/kemenkes">Data Kemenkes</a>
														</div>
														<!-- END Nav -->
													</div>
												</div>
												<div class="portlet-body">
													<div class="tab-content">
														<?php if($act=='' or $act=='biodata'){ ?>
															<form class="row g-3" action="<?=base_url();?>modul/siswa/update-siswa.php" autocomplete="off" method="POST" id="ubahForm">
															
																<div class="form-group col-md-4">
																	<label for="inputCity">Nama Lengkap</label>
																	<input type="text" class="form-control" name="nama"  value="<?=$pn['nama'];?>" required>
																	<input type="hidden" class="form-control" name="ptkid" id="idpt" value="<?=$pn['peserta_didik_id'];?>" required>
																</div>
																<div class="form-group col-md-4">
																	<label for="inputzip">Nama Panggil</label>
																	<input type="text" class="form-control" name="nama_panggil"  value="<?=$pn['nama_panggil'];?>" required>
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputZip">NIK</label>
																	<input type="text" class="form-control" name="nik" value="<?=$pn['nik'];?>">
																</div>
															
																<div class="form-group col-md-4">
																	<label for="inputZip">Tempat Lahir</label>
																	<input type="text" class="form-control" name="tempat" value="<?=$pn['tempat'];?>" required>
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputZip">Tanggal Lahir</label>
																	<div class="input-group">
																		<span class="input-group-text">
																			<i class="fas fa-calendar-alt"></i>
																		</span>
																		<input type="text" id="tanggal" name="tanggal" class="form-control" value="<?=$pn['tanggal'];?>" required>
																	</div>
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputCity">Jenis Kelamin</label>
																	<select name="jeniskelamin" class="form-select">
																		<option value="L" <?php if($pn['jk']=='L') echo 'selected';?>>Laki-laki</option>
																		<option value="P" <?php if($pn['jk']=='P') echo 'selected';?>>Perempuan</option>
																	</select>
																</div>
															
																<div class="form-group col-md-4">
																	<label for="inputCity">NIS</label>
																	<input type="text" class="form-control" name="nis" value="<?=$pn['nis'];?>">
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputZip">NISN</label>
																	<input type="text" class="form-control" name="nisn" value="<?=$pn['nisn'];?>">
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputZip">Agama</label>
																	<select class="form-select" name="agama" id="agama">
																		<?php 
																		$sql2 = "select * from agama";
																		$query2 = $connect->query($sql2);
																		while($nk=$query2->fetch_assoc()){
																		?>
																		<option value="<?=$nk['id_agama'];?>" ><?=$nk['nama_agama'];?></option>
																		<?php };?>
																	</select>
																</div>
															
																<div class="form-group col-12">
																	<label for="inputAddress">Alamat</label>
																	<input type="text" class="form-control" name="alamat" value="<?=$pn['alamat'];?>">
																</div>
															
																<div class="form-group col-12">
																	<label for="inputAddress">Pendidikan Sebelumnya</label>
																	<input type="text" class="form-control" name="pend_seb" value="<?=$pn['pend_sebelum'];?>">
																</div>
															
																<div class="form-group col-md-6">
																	<label for="inputCity">Nama Ayah</label>
																	<input type="text" class="form-control" name="ayah" value="<?=$pn['nama_ayah'];?>">
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputZip">Nama Ibu</label>
																	<input type="text" class="form-control" name="ibu" value="<?=$pn['nama_ibu'];?>">
																</div>
															
															<?php 
															//$jns_ptk = $connect->query("select * from jenis_ptk where jenis_ptk_id='$level'")->fetch_assoc();
															//$status_ptk = $connect->query("select * from status_kepegawaian where status_kepegawaian_id='$status'")->fetch_assoc();
															?>
																<div class="form-group col-md-6">
																	<label for="inputCity">Pekerjaan Ayah</label>
																	<select class="form-select" name="pek_ayah">
																		<?php 
																		$sql21 = "select * from pekerjaan";
																		$query21 = $connect->query($sql21);
																		while($po1=$query21->fetch_assoc()){
																		?>
																		<option value="<?=$po1['id_pekerjaan'];?>" <?php if($pn['pek_ayah']==$po1['id_pekerjaan']) echo 'selected'; ?>><?=$po1['nama_pekerjaan'];?></option>
																		<?php } ?>
																	</select>
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputZip">Pekerjaan Ibu</label>
																	<select class="form-select" name="pek_ibu">
																		<?php 
																		$sql21 = "select * from pekerjaan";
																		$query21 = $connect->query($sql21);
																		while($po1=$query21->fetch_assoc()){
																		?>
																		<option value="<?=$po1['id_pekerjaan'];?>" <?php if($pn['pek_ibu']==$po1['id_pekerjaan']) echo 'selected'; ?>><?=$po1['nama_pekerjaan'];?></option>
																		<?php } ?>
																	</select>
																</div>
																<div class="form-group col-4">
																	<label for="inputAddress">Nomor HP/Whatsapp</label>
																	<input type="text" name="no_wa" class="form-control" id="inputmask-2" value="<?=$pn['no_wa'];?>">
																</div>
																<div class="form-group col-8">
																	<label for="inputAddress">Alamat Orang Tua</label>
																	<input type="text" class="form-control" name="jalan" value="<?=$pn['jalan'];?>">
																</div>
																<div class="form-group col-md-6">
																	<label for="inputCity">Desa/Kelurahan</label>
																	<select class="form-select" name="kelurahan" id="kelurahan">
																		<option>Pilih Desa/kelurahan</option>
																		<?php 
																			$id_desa=$pn['kelurahan'];
																			$id_kec=$pn['kecamatan'];
																			$id_kab=$pn['kabupaten'];
																			$id_prov=$pn['provinsi'];
																		
																			// Kabupaten
																			// persiapkan curl
																			$ds = curl_init(); 
																			// set url 
																			curl_setopt($ds, CURLOPT_URL, "https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/villages/".$id_kec.".json");
																			// return the transfer as a string 
																			curl_setopt($ds, CURLOPT_RETURNTRANSFER, 1); 
																			// $output contains the output string 
																			$desass = curl_exec($ds); 
																			// menampilkan hasil curl
																			$des = json_decode($desass,true);
																			foreach ($des as $d) {
																			?>
                                                                                <option data-nilai="<?=$d['name'];?>" value="<?=$d['id'];?>" <?php if($id_desa==$d['id']) echo "selected"; ?>><?=$d['name'];?></option>';
																			<?php 
                                                                            }	
																			// tutup curl 
																			curl_close($ds); 
                                                                        ?>
																		
																	</select>
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputZip">Kecamatan</label>
																	<select class="form-select" name="kecamatan" id="kecamatan">
																		<option>Pilih Kecamatan</option>
																		<?php 
																			// Kabupaten
																			// persiapkan curl
																			$kc = curl_init(); 
																			// set url 
																			curl_setopt($kc, CURLOPT_URL, "https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/districts/".$id_kab.".json");
																			// return the transfer as a string 
																			curl_setopt($kc, CURLOPT_RETURNTRANSFER, 1); 
																			// $output contains the output string 
																			$kecss = curl_exec($kc); 
																			// menampilkan hasil curl
																			$kec = json_decode($kecss,true);
																			foreach ($kec as $d) {
																			?>
                                                                                <option data-nilai="<?=$d['name'];?>" value="<?=$d['id'];?>" <?php if($id_kec==$d['id']) echo "selected"; ?>><?=$d['name'];?></option>';
																			<?php 
                                                                            }	
																			// tutup curl 
																			curl_close($kc); 
                                                                        ?>
																		
																	</select>
																</div>
																<div class="form-group col-md-6">
																	<label for="inputCity">Kabupaten</label>
																	<select class="form-select" name="kabupaten" id="kabupaten">
																		<option>Pilih Kabupaten</option>
																		<?php 
																			// Kabupaten
																			// persiapkan curl
																			$kb = curl_init(); 
																			// set url 
																			curl_setopt($kb, CURLOPT_URL, "https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/regencies/".$id_prov.".json");
																			// return the transfer as a string 
																			curl_setopt($kb, CURLOPT_RETURNTRANSFER, 1); 
																			// $output contains the output string 
																			$kabss = curl_exec($kb); 
																			// menampilkan hasil curl
																			$kab = json_decode($kabss,true);
																			foreach ($kab as $d) {
																			?>
                                                                                <option data-nilai="<?=$d['name'];?>" value="<?=$d['id'];?>" <?php if($id_kab==$d['id']) echo "selected"; ?>><?=$d['name'];?></option>';
																			<?php 
                                                                            }	
																			// tutup curl 
																			curl_close($kb); 
                                                                        ?>
																		
																	</select>
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputZip">Provinsi</label>
																	<select class="form-select" name="provinsi" id="provinsi">
																		<option>Pilih Provinsi</option>
																		<?php 
																			// Kabupaten
																			// persiapkan curl
																			$pv = curl_init(); 
																			// set url 
																			curl_setopt($pv, CURLOPT_URL, "https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/provinces.json");
																			// return the transfer as a string 
																			curl_setopt($pv, CURLOPT_RETURNTRANSFER, 1); 
																			// $output contains the output string 
																			$prv = curl_exec($pv); 
																			// menampilkan hasil curl
																			$prvs = json_decode($prv,true);
																			foreach ($prvs as $d) {
																			?>
                                                                                <option data-nilai="<?=$d['name'];?>" value="<?=$d['id'];?>" <?php if($id_prov==$d['id']) echo "selected"; ?>><?=$d['name'];?></option>';
																			<?php 
                                                                            }	
																			// tutup curl 
																			curl_close($pv); 
                                                                        ?>
																		
																	</select>
																</div>
																<div class="col-md-12 text-end mt-3">
																	<button type="submit" class="btn btn-primary">Simpan</button>
																</div>
															</form>
														<?php } ?>
														<?php if($act=='register'){ ?>
															<?php 
															$cekreg = $connect->query("select * from data_register where peserta_didik_id='$idsis'")->num_rows;
															
															if($cekreg>0){}else{
															?>
															<div class="alert alert-outline-secondary" id="regist">
																<div class="alert-icon">
																	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
																</div>
																<div class="alert-content">Siswa belum memiliki Data Registrasi</div>
															</div>
															<?php } ?>
															<form class="row g-3" action="<?=base_url();?>modul/siswa/update-registrasi.php" autocomplete="off" method="POST" id="ubahRegister">
																<div class="form-group col-md-4">
																	<label for="inputCity">Jenis Pendaftaran</label>
																	<select class="form-select" name="jns" id="jns">
																		<?php 
																		$sql2 = "select * from jns_daftar";
																		$query2 = $connect->query($sql2);
																		while($nk=$query2->fetch_assoc()){
																		?>
																		<option value="<?=$nk['id_jns_daftar'];?>" <?php if($regis['jns_daftar']==$nk['id_jns_daftar']) echo 'selected';?>><?=$nk['nama_jns_daftar'];?></option>
																		<?php };?>
																	</select>
																	<input type="hidden" class="form-control" name="ptkid" id="idpt" value="<?=$pn['peserta_didik_id'];?>" required>
																</div>
																<div class="form-group col-md-4">
																	<label for="inputZip">Status</label>
																	<select class="form-select" name="statuss" id="statuss">
																		<?php 
																		$sql2 = "select * from jns_mutasi";
																		$query2 = $connect->query($sql2);
																		while($nk=$query2->fetch_assoc()){
																		?>
																		<option value="<?=$nk['id_mutasi'];?>" <?php if($pn['status']==$nk['id_mutasi']) echo 'selected';?>><?=$nk['nama_mutasi'];?></option>
																		<?php };?>
																	</select>
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputZip">Tanggal Masuk</label>
																	<div class="input-group">
																		<span class="input-group-text">
																			<i class="fas fa-calendar-alt"></i>
																		</span>
																		<input type="text" id="tanggalmasuk" name="tanggalmasuk" class="form-control" value="<?=$regis['tgl_masuk'];?>">
																	</div>
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputCity">Nomor Registrasi Akta Lahir</label>
																	<input type="text" class="form-control" name="noakta" value="<?=$regis['noakta'];?>">
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputCity">Nomor Kartu Keluarga</label>
																	<input type="text" class="form-control" name="nokk" value="<?=$regis['nokk'];?>">
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputCity">Lintang</label>
																	<input type="text" class="form-control" name="lintang" value="<?=$regis['lintang'];?>">
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputCity">Bujur</label>
																	<input type="text" class="form-control" name="bujur" value="<?=$regis['bujur'];?>">
																</div>
																<div class="col-md-12 text-end mt-3">
																	<button type="submit" class="btn btn-primary">Simpan</button>
																</div>
															</form>
														<?php } ?>
														<?php if($act=='lulusan'){ ?>
															<?php 
															if($pn['status']=='1'){
															?>
															<div class="alert alert-outline-secondary" id="itung">
                                                                <div class="alert-icon">
                                                                    <i class="fa fa-lightbulb"></i>
                                                                </div>
                                                                <div class="alert-content"> 
																	Siswa ini masih terdaftar AKTIF
                                                                </div>
                                                            </div>
															<?php }elseif($pn['status']=='7'){ ?>
															<form class="row g-3" enctype="multipart/form-data" autocomplete="off" method="POST" id="ubahlulusan">
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputZip">Tanggal Mutasi</label>
																	<div class="input-group">
																		<span class="input-group-text">
																			<i class="fas fa-calendar-alt"></i>
																		</span>
																		<input type="text" id="tanggalmutasi" name="tanggalmutasi" class="form-control" value="<?=$regis['tgl_mutasi'];?>">
																		<input type="hidden" class="form-control" name="ptkid" id="idpt" value="<?=$pn['peserta_didik_id'];?>" required>
																	</div>
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputCity">Alasan Mutasi</label>
																	<input type="text" class="form-control" name="alasan" value="<?=$regis['alasan'];?>">
																</div>
																<div class="form-group col-md-4 border-top-0 pt-0">
																	<label for="inputCity">Sekolah Mutasi/Melanjutkan</label>
																	<input type="text" class="form-control" name="sekolah_mutasi" value="<?=$regis['sekolah_mutasi'];?>">
																</div>
																
																<div class="form-group col-md-6">
																	<label for="inputCity">Nomor Peserta US</label>
																	<input type="text" class="form-control" name="nopes" value="<?=$regis['nopes'];?>">
																</div>
																<div class="form-group col-md-6">
																	<label for="inputCity">Nomor Ijazah</label>
																	<input type="text" class="form-control" name="ijazah" value="<?=$regis['ijazah'];?>">
																</div>
																<div class="form-group col-md-6 border-top-0 pt-0">
																	<label for="inputZip">File Ijazah</label>
																	<?php 
                                                                    if(empty($regis['file_ijazah']) or $regis['file_ijazah']==''){
                                                                    ?>
                                                                    <div class="alert alert-outline-secondary" id="itung">
                                                                        <div class="alert-icon">
                                                                            <i class="fa fa-lightbulb"></i>
                                                                        </div>
                                                                        <div class="alert-content"> 
                                                                        Belum ada file ijazah
                                                                        </div>
                                                                    </div>
																	
                                                                    <?php 
                                                                    }else{
                                                                    ?>
                                                                    
                                                                    <?php 
                                                                    }
                                                                    ?>
																	<input type="file" class="form-control" id="file" name="files[]" multiple />
																</div>
																
																<div class="col-md-12 text-end mt-3">
																	<button type="submit" class="btn btn-primary submitBtn">Simpan</button>
																</div>
															</form>
															<canvas id="pdfViewer"></canvas>
															<br/>
															<?php 
                                                                    if(empty($regis['file_ijazah']) or $regis['file_ijazah']==''){
                                                                    ?>
                                                                    
                                                                    <?php 
                                                                    }else{
                                                                    ?>
                                                                    <div class="alert alert-outline-secondary" id="itung">
                                                                        <div class="alert-content"> 
                                                                        <button class="btn btn-sm btn-outline-info" data-doc="<?=$pn['peserta_didik_id'];?>" data-bs-toggle="modal" data-bs-target="#info">
																			<i class="fa-solid fa-magnifying-glass"></i> <?=$regis['file_ijazah'];?>
																		</button>
                                                                        </div>
                                                                    </div>
																	<div id="canvassss"></div>
                                                                    <?php 
                                                                    }
                                                                    ?>
															<?php }else{ ?>
															<div class="alert alert-outline-secondary" id="itung">
                                                                <div class="alert-icon">
                                                                    <i class="fa fa-lightbulb"></i>
                                                                </div>
                                                                <div class="alert-content"> 
																	Siswa ini bukan Lulusan sekolah ini
                                                                </div>
                                                            </div>
															<?php } ?>
														<?php } ?>
														<?php if($act=='kemenkes'){ ?>
															<button class="btn btn-effect-ripple btn-xs btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahkemenkes"><i class="fa fa-plus"></i> Kemenkes</button>
															<table id="kes-1" class="table table-bordered table-striped table-hover">
																<thead>
																	<tr>
																		<th>JENIS LAYANAN</th>
																		<th>TANGGAL PELAKSANAAN</th>
																		<th>TEMPAT PELAKSANAAN</th>
																		<th>TIPE VAKSINASI</th>
																		<th>DOSIS</th>
																		<th></th>
																	</tr>
																</thead>
															</table>
														<?php } ?>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }else{ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-info"></i>
								</div>
								<div class="alert-content">Tidak ditemukan siswa!</div>
							</div>
							<?php }}} ?>
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
	<div class="modal fade" id="uploadimageModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Upload & Crop Image</h4>
				</div>
				<div class="modal-body">
					<div id="image_demo" style="width:350px; margin-top:30px"></div>
					
				</div>
				<div class="modal-footer">
					<button class="btn btn-success crop_image">Crop & Upload Image</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="info">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content fetched-data">
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambah-pengguna">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="<?=base_url();?>modul/kepegawaian/add-user.php" autocomplete="off" method="POST" id="adduser">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambahkemenkes">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="tambahkemenkesform" method="POST" action="<?=base_url();?>modul/siswa/tambah-kemenkes.php" class="form" autocomplete="off">
				<div class="fetched-data2"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script src="<?=base_url();?>assets/js/croppie.js"></script>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/pdf.min.js"></script>
	<script>
	// Define latitude, longitude and zoom level
	const latitude = $('#lintang').val();
	const longitude = $('#bujur').val();
	const zoom = 14;

	// Set DIV element to embed map
	var mymap = L.map('mapWrap');

	// Add initial marker & popup window
	var mmr = L.marker([0,0]);
	mmr.bindPopup('0,0');
	mmr.addTo(mymap);

	// Add copyright attribution
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
		foo: 'bar',
		attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'}
	).addTo(mymap);

	// Set lat lng position and zoom level of map 
	mmr.setLatLng(L.latLng(latitude, longitude));
	mymap.setView([latitude, longitude], zoom);

	// Set popup window content
	mmr.setPopupContent('Latitude: '+latitude+' <br /> Longitude: '+longitude).openPopup();

	// Set marker onclick event
	mmr.on('click', openPopupWindow);

	// Marker click event handler
	function openPopupWindow(e) {
		mmr.setPopupContent('Latitude: '+e.latlng.lat+' <br /> Longitude: '+e.latlng.lng).openPopup();
	}
	</script>
	<script>
	var TabelRombel;
	var TabelKes;
	$("#pdfViewer").hide();
	$('#tanggal').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$('#tanggalmasuk').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$('#tanggalmutasi').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$("#inputmask-2").inputmask({ mask: "999999999999" });
	$("#dip").hide(); 
	$("#dip2").show(); 
	var idptk = $('#idpt').val();
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
	
	var pdfjsLib = window['pdfjs-dist/build/pdf'];
	pdfjsLib.GlobalWorkerOptions.workerSrc = '<?=base_url();?>assets/js/pdf.worker.min.js';
	
	<?php if(empty($regis['file_ijazah']) or $regis['file_ijazah']==''){}else{ ?>
		var url = '<?=base_url();?>ijazah/sd/<?=$regis['file_ijazah'];?>';
		var pdfjsLib = window['pdfjs-dist/build/pdf'];
		pdfjsLib.GlobalWorkerOptions.workerSrc = '<?=base_url();?>assets/js/pdf.worker.min.js';
		var pdfDoc = null,
			pageNum = 1,
			pageRendering = false,
			pageNumPending = null,
			canvas = document.getElementById('canvassss'),
			scale = 1.3;

		function renderPage(num, canvas) {
		  var ctx = canvas.getContext('2d');
		  pageRendering = true;
		  // Using promise to fetch the page
		  pdfDoc.getPage(num).then(function(page) {
			//var viewport = page.getViewport({scale: scale});
			//var viewport = page.getViewport(canvas.width / page.getViewport(1.0).width);
			var viewport = page.getViewport({scale: scale});
			canvas.height = viewport.height;
			canvas.width = viewport.width;

			// Render PDF page into canvas context
			var renderContext = {
			  canvasContext: ctx,
			  viewport: viewport
			};
			var renderTask = page.render(renderContext);

			// Wait for rendering to finish
			renderTask.promise.then(function() {
			  pageRendering = false;
			  if (pageNumPending !== null) {
				// New page rendering is pending
				renderPage(pageNumPending);
				pageNumPending = null;
			  }
			});
		  });
		}

		pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
		  pdfDoc = pdfDoc_;

		  const pages = parseInt(pdfDoc.numPages);

		  var canvasHtml = '';
		  for (var i = 0; i < pages; i++) {
			canvasHtml += '<canvas id="canvas_' + i + '"></canvas>';
		  }

		  document.getElementById('canvassss').innerHTML = canvasHtml;

		  for (var i = 0; i < pages; i++) {
			var canvas = document.getElementById('canvas_' + i);
			renderPage(i+1, canvas);
		  }
		});		
	<?php } ?>

	$("#file").on("change", function(e){
		$("#pdfViewer").show();
		var file = e.target.files[0]
		if(file.type == "application/pdf"){
			var fileReader = new FileReader();  
			fileReader.onload = function() {
				var pdfData = new Uint8Array(this.result);
				// Using DocumentInitParameters object to load binary data.
				var loadingTask = pdfjsLib.getDocument({data: pdfData});
				loadingTask.promise.then(function(pdf) {
				  console.log('PDF loaded');
				  
				  // Fetch the first page
				  var pageNumber = 1;
				  pdf.getPage(pageNumber).then(function(page) {
					console.log('Page loaded');
					
					var scale = 1.3;
					var viewport = page.getViewport({scale: scale});

					// Prepare canvas using PDF page dimensions
					var canvas = $("#pdfViewer")[0];
					var context = canvas.getContext('2d');
					canvas.height = viewport.height;
					canvas.width = viewport.width;

					// Render PDF page into canvas context
					var renderContext = {
					  canvasContext: context,
					  viewport: viewport
					};
					var renderTask = page.render(renderContext);
					renderTask.promise.then(function () {
					  console.log('Page rendered');
					});
				  });
				}, function (reason) {
				  // PDF loading error
				  console.error(reason);
				});
			};
			fileReader.readAsArrayBuffer(file);
		}
	});
	
	$image_crop = $('#image_demo').croppie({
		enableExif: true,
		viewport: {
		  width:200,
		  height:200,
		  type:'square' //circle
		},
		boundary:{
		  width:300,
		  height:300
		}
	});
	TabelKes = $("#kes-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "<?=base_url();?>modul/siswa/daftar-kemenkes.php?idptk="+idptk
		});
	$('#upload_image').on('change', function(){
		var reader = new FileReader();
		reader.onload = function (event) {
		  $image_crop.croppie('bind', {
			url: event.target.result
		  }).then(function(){
			console.log('jQuery bind complete');
		  });
		}
		reader.readAsDataURL(this.files[0]);
		$("#dip").show(); 
		$("#dip2").hide(); 
	  });

	  $('.crop_image').click(function(event){
		$image_crop.croppie('result', {
		  type: 'canvas',
		  size: 'viewport'
		}).then(function(response){
		  $.ajax({
			url:"<?=base_url();?>images/uploadfoto-siswa.php?idp="+idptk,
			type: "POST",
			data:{"image": response},
			success:function(data)
			{
			  $("#dip").hide(); 
			  $("#dip2").show(); 
			  $('#uploaded_image').html(data);
			  toastr.success("Sukses");
			}
		  });
		})
	  });
	$('#provinsi').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();
			$.ajax({
				type : 'GET',
				url : 'https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/regencies/'+prov+'.json',
				dataType : 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					
					//var kecs = $.parseJSON(data);
					var sampleName = '<option value="0">Pilih Kabupaten</option>';
					$.each(data, function () {
						sampleName += "<option value='"+this['id']+"'>"+this['name']+"</option>";
					});
					$("#kabupaten").html(sampleName);
					$("#kecamatan").html('<option>Pilih Kecamatan</option>');
					$("#kelurahan").html('<option>Pilih Desa</option>');
					$('#status').unblock();
				}
			});
			/**
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/kabupaten.php',
				data :  'prov_id=' + prov,
                dataType : 'HTML',
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabupaten").html(data);
				}
			});
			**/
	});
	
	$('#kabupaten').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kab = $('#kabupaten').val();
			$.ajax({
				type : 'GET',
				url : 'https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/districts/'+kab+'.json',
				dataType : 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					var sampleName = '<option value="0">Pilih Kecamatan</option>';
					$.each(data, function () {
						sampleName += "<option value='"+this['id']+"'>"+this['name']+"</option>";
					});
					$("#kecamatan").html(sampleName);
					$("#kelurahan").html('<option>Pilih Desa</option>');
					$('#status').unblock();
				}
			});
			/**
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/kecamatan.php',
				data :  'id_kabupaten=' + kab,
                dataType : 'HTML',
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kecamatan").html(data);
				}
			});
			**/
	});

	$('#kecamatan').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var desa = $('#kecamatan').val();
			$.ajax({
				type : 'GET',
				url : 'https://nandangsetianugraha.github.io/api-wilayah-indonesia/api/villages/'+desa+'.json',
				dataType : 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					var sampleName = '<option value="0">Pilih Desa</option>';
					$.each(data, function () {
						sampleName += "<option value='"+this['id']+"'>"+this['name']+"</option>";
					});
					$("#kelurahan").html(sampleName);
					$('#status').unblock();
				}
			});
			/**
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>pages/desa.php',
				data :  'id_kecamatan=' + desa,
                dataType : 'HTML',
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kelurahan").html(data);
					// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
				}
			});
			**/
	});
	$("#ubahForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#tampilan').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#tampilan').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						//setTimeout(function () {window.open("./","_self");},1000)
						//setTimeout(function () {window.open("./","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$("#ubahRegister").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#tampilan').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#tampilan').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						$("#regist").hide(); 
					} else {
						toastr.error(response.messages);
					}  // /else
					//setTimeout(function () {location.reload();},500);
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$('#info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('doc');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '<?=base_url();?>modul/siswa/info-ijazah.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
				{	
					$('.fetched-data').html('<div class="modal-header"><button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="fa fa-times"></i></button></div><div class="modal-body"><div class="portlet"><div class="portlet-body"><i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...</div></div></div>');
                  	
				},
                success : function(data){
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
					
                }
            });
        });
		$("#ubahlulusan").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?=base_url();?>ijazah/update-lulusan.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('.submitBtn').attr("disabled","disabled");
					//$('#fupForm').css("opacity",".5");
					//$('.statusmsg').html('<div class="portlet"><div class="portlet-body"><div class="spinner-grow text-success"></div> Loading ...</div></div>');
					$('#tampilan').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function(response){
					$('#tampilan').unblock();
					
					if(response.success == true){
						//$('#fupForm')[0].reset();
						toastr.success(response.messages);
						
						//$('.statusmsg').html('<div class="portlet"><div class="portlet-body"><div class="spinner-grow text-success"></div> Loading ...</div></div>');
					}else{
						toastr.error(response.messages);
					   // $('.statusmsg').html('<div class="portlet"><div class="portlet-body">'+response.message+'</div></div>');
					}
					//$('#fupForm').css("opacity","");
					$(".submitBtn").removeAttr("disabled");
					//setTimeout(function () {window.open("<?=base_url();?>upload-dokumen","_self");},1000);
					setTimeout(function () {location.reload();},500);					
				}
			});
		});
		
		$('#tambahkemenkes').on('show.bs.modal', function (e) {
            var idptk = $('#idpt').val();
			$('#tanggal_kes').datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true
			});
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : '<?=base_url();?>modul/siswa/m_kemenkes.php',
				data :  'idptk='+ idptk,
				beforeSend: function()
				{	
					$('#kes-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#kes-1').unblock();
					$('.fetched-data2').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#tambahkemenkesform").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#kes-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#kes-1').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						$("#tambahkemenkes").modal('hide');
						TabelKes.ajax.reload(null, false);
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
	</script>
</body>
</html>
