
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Profil</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
	
	<!-- App Capsule -->
    <div id="appCapsule">

        <!-- konten -->
		<div class="section mt-2">
			<?php 
			$jlak=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel_aktif' and penempatan.smt='$smt_aktif'")->num_rows;
			$jper=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel_aktif' and penempatan.smt='$smt_aktif'")->num_rows;
			$jtot=$jlak+$jper;
			?>
            <div class="profile-head">
                <div class="avatar">
                    <img src="<?=base_url();?>images/siswa/<?=$avatar;?>" alt="avatar" class="imaged w64 rounded">
                </div>
                <div class="in">
                    <h3 class="name"><?=$bioku['nama'];?></h3>
                    <h5 class="subtext"><?=$bioku['nis'];?> / <?=$bioku['nisn'];?></h5>
                </div>
            </div>
        </div>

      

        <div class="section full mt-2">
            <div class="wide-block transparent p-0">
                <ul class="nav nav-tabs lined iconed" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#feed" role="tab">
                            <ion-icon name="grid-outline"></ion-icon> Biodata
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#friends" role="tab">
                            <ion-icon name="people-outline"></ion-icon> Orang Tua
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- tab content -->
        <div class="section full mr-2 ml-2 mb-2">
            <div class="tab-content">

                <!-- feed -->
                <div class="tab-pane fade show active" id="feed" role="tabpanel">
                    <ul class="listview image-listview no-line no-space flush">
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="email6">Nama Lengkap</label>
                                            <input type="text" class="form-control" value="<?=$bioku['nama'];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
						<li>
							<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="bookmarks-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">Tempat Tanggal Lahir</label>
													<input type="text" class="form-control" value="<?=$bioku['tempat'];?>, <?=TanggalIndo($bioku['tanggal']);?>" readonly>
												</div>
											</div>
										</div>
									</div>
						</li>
						<li>
							
									<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="man-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">Jenis Kelamin</label>
													<input type="text" class="form-control" value="<?php if($bioku['jk']=='L'){echo "Laki-laki";}else{echo "Perempuan";} ?>" readonly>
												</div>
											</div>
										</div>
									</div>
                        </li>
						<li>
									<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="browsers-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">NIK</label>
													<input type="text" class="form-control" value="<?=$bioku['nik'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
						</li>
						<li>
									<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="calendar-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">NIS</label>
													<input type="text" class="form-control" value="<?=$bioku['nis'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
						</li>
						<li>
									<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="book-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">NISN</label>
													<input type="text" class="form-control" value="<?=$bioku['nisn'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
                        </li>
                    </ul>
                </div>
                <!-- * feed -->

                <!-- * friends -->
                <div class="tab-pane fade" id="friends" role="tabpanel">
                    <ul class="listview image-listview no-line no-space flush">
                        <li>
							<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="bookmarks-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">Ayah Kandung</label>
													<input type="text" class="form-control" value="<?=$bioku['nama_ayah'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
						</li>
						<li>
							<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="bookmarks-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">Ibu Kandung</label>
													<input type="text" class="form-control" value="<?=$bioku['nama_ibu'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
						</li>
						<li>
									<div class="item">
										<div class="icon-box bg-primary">
											<ion-icon name="book-outline"></ion-icon>
										</div>
										<div class="in">
											<div class="form-group basic">
												<div class="input-wrapper">
													<label class="label" for="email6">Alamat</label>
													<input type="text" class="form-control" value="<?=$bioku['alamat'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
                        </li>
                    </ul>
                </div>
                <!-- * friends -->

                
            </div>
        </div>
        <!-- * tab content -->
		<!-- konten -->
		
		


        <!-- app footer -->
        
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <?php include "layout/app-bottom.php";?>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <?php include "layout/app-sidebar.php";?>
	<!-- * App Sidebar -->

    <!-- welcome notification  -->
    
    <!-- * welcome notification -->

    <!-- ///////////// Js Files ////////////////////  -->
    <?php include "layout/javascript.php";?>


    