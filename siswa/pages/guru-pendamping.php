
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Guru Pendamping</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
	
	<!-- App Capsule -->
    <div id="appCapsule">

        <!-- konten -->
		<div class="section mt-2">
            <div class="profile-head">
                <div class="avatar">
                    <img src="<?=home_url();?>images/ptk/<?=$pendamping['gambar'];?>" alt="avatar" class="imaged w64 rounded">
                </div>
                <div class="in">
                    <h3 class="name"><?=$pendamping['nama'];?></h3>
                    <h5 class="subtext">Guru Pendamping <?=$kelas;?></h5>
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
                            <ion-icon name="people-outline"></ion-icon> Kontak
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
                                            <input type="text" class="form-control" value="<?=$pendamping['nama'];?>" readonly>
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
													<input type="text" class="form-control" value="<?=$pendamping['tempat_lahir'];?>, <?=TanggalIndo($pendamping['tanggal_lahir']);?>" readonly>
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
													<input type="text" class="form-control" value="<?php if($pendamping['jenis_kelamin']=='L'){echo "Laki-laki";}else{echo "Perempuan";} ?>" readonly>
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
													<label class="label" for="email6">NIY/NIGK</label>
													<input type="text" class="form-control" value="<?=$pendamping['niy_nigk'];?>" readonly>
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
													<label class="label" for="email6">NUPTK</label>
													<input type="text" class="form-control" value="<?=$pendamping['nuptk'];?>" readonly>
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
													<input type="text" class="form-control" value="<?=$pendamping['alamat_jalan'];?>" readonly>
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
													<label class="label" for="email6">Nomor Kontak</label>
													<input type="text" class="form-control" value="<?=$pendamping['no_hp'];?>" readonly>
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
													<label class="label" for="email6">E-mail</label>
													<input type="text" class="form-control" value="<?=$pendamping['email'];?>" readonly>
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


    