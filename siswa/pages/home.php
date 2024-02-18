
	<!-- App Header -->
    <?php include "layout/app-header.php";?>
    <!-- * App Header -->

    <!-- Search Component -->
    <?php include "layout/app-search.php";?>
    <!-- * Search Component -->
	
	<!-- App Capsule -->
    <div id="appCapsule">

        <!-- konten -->
		<div class="section mt-2">
			<?php 
			$spp = $connect->query("select * from tarif_spp where peserta_didik_id='$idku'")->fetch_assoc();
			$sppbln = $connect->query("select * from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='1' and bulan='$blnspp'")->num_rows;
			$rincian = $connect->query("select * from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='1' and bulan='$blnspp'")->fetch_assoc();
			$jlak=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel_aktif' and penempatan.smt='$smt_aktif'")->num_rows;
			$jper=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel_aktif' and penempatan.smt='$smt_aktif'")->num_rows;
			$jtot=$jlak+$jper;
			?>
            <div class="profile-head">
                <div class="avatar">
                    <img src="<?=home_url();?>images/siswa/<?=$avatar;?>" alt="avatar" class="imaged w64 rounded">
                </div>
                <div class="in">
                    <h3 class="name"><?=$bioku['nama'];?></h3>
                    <h5 class="subtext"><?=$bioku['nis'];?> / <?=$bioku['nisn'];?></h5>
                </div>
            </div>
        </div>
		<div class="section full mt-2">
            <ul class="listview image-listview">
					<li>
						<a href="<?=base_url();?>wali-kelas" class="item">
							<img src="<?=home_url();?>images/ptk/<?=$wali['gambar'];?>" alt="image" class="image">
							<div class="in">
								<div>
									<?=$wali['nama'];?>
									<footer>Wali Kelas</footer>
								</div>
								<span class="text-muted">Info</span>
							</div>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>guru-pendamping" class="item">
							<img src="<?=home_url();?>images/ptk/<?=$pendamping['gambar'];?>" alt="image" class="image">
							<div class="in">
								<div>
									<?=$pendamping['nama'];?>
									<footer>Pendamping</footer>
								</div>
								<span class="text-muted">Info</span>
							</div>
						</a>
					</li>
				</ul>
        </div>

        

					<?php if($sppbln>0){ ?>
					<div class="alert alert-primary alert-dismissible fade show mt-2 ml-2 mr-2" role="alert">
						<h4>Terima Kasih</h4>
						Anda sudah melakukan pembayaran Infaq Bulanan Bulan <?=$blns[$bln-1];?><br/>
						No. Invoice : <?=$rincian['id_invoice'];?> Tanggal : <?=TanggalIndo($rincian['tanggal']);?>
					</div>
					<?php }else{ ?>
					<div class="alert alert-success alert-dismissible fade show mt-2 ml-2 mr-2" role="alert">
						<h4>Perhatian!</h4>
						<strong>Infaq Bulanan</strong> Bulan <?=$blns[$bln-1];?> Belum dibayar.
					</div>
					<?php } ?>

       
		<div class="row ml-2 mr-2 mt-2">
            <div class="col-4">
				<center>
                <a href="<?=base_url();?>nilai" class="btn btn-lg btn-block btn-icon btn-primary">
					<ion-icon name="document-text-outline"></ion-icon>
                </a><br/>
				Nilai
				</center>
			</div>
			<div class="col-4">
				<center>
                <a href="<?=base_url();?>rapor" class="btn btn-lg btn-block btn-icon btn-primary">
					<ion-icon name="receipt-outline"></ion-icon>
                </a><br/>
				Rapor
				</center>
			</div>
			<div class="col-4">
				<center>
                <a href="<?=base_url();?>tunggakan" class="btn btn-lg btn-block btn-icon btn-primary">
					<ion-icon name="library-outline"></ion-icon>
                </a><br/>
				Tunggakan
				</center>
			</div>
		</div>
		<div class="row ml-2 mr-2 mt-2">
			<div class="col-4">
				<center>
                <a href="<?=base_url();?>tabungan" class="btn btn-lg btn-block btn-icon btn-primary">
					<ion-icon name="reader-outline"></ion-icon>
                </a><br/>
				Tabungan
				</center>
			</div>
			<div class="col-4">
				<center>
                <a href="<?=base_url();?>dokumen" class="btn btn-lg btn-block btn-icon btn-primary">
					<ion-icon name="card-outline"></ion-icon>
                </a><br/>
				Dokumen
				</center>
			</div>
			<div class="col-4">
				<center>
                <a href="javascript:;" data-toggle="modal" data-target="#DialogIconedButtonInline" class="btn btn-lg btn-block btn-icon btn-primary">
					<ion-icon name="log-out-outline"></ion-icon>
                </a><br/>
				Keluar
				</center>
			</div>
		</div>
		<!--
		<div class="section full mt-3 mb-3">
            <div class="carousel-multiple owl-carousel owl-theme">

                <div class="item">
                    <div class="card">
                        <img src="assets/img/sample/photo/d1.jpg" class="card-img-top" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">Progressive web app ready</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <img src="assets/img/sample/photo/d2.jpg" class="card-img-top" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">Reusable components</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <img src="assets/img/sample/photo/d3.jpg" class="card-img-top" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">Great for phones & tablets</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <img src="assets/img/sample/photo/d4.jpg" class="card-img-top" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">Change the styles in one file</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <img src="assets/img/sample/photo/d6.jpg" class="card-img-top" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">Sketch source file included</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <img src="assets/img/sample/photo/d5.jpg" class="card-img-top" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">Written with a code structure</h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>
		-->
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
    <div id="notification-welcome" class="notification-box">
        <div class="notification-dialog android-style">
            <div class="notification-header">
                <div class="in">
                    <img src="assets/img/icon/72x72.png" alt="image" class="imaged w24">
                    <strong>APINS</strong>
                    <span><?=TanggalIndo(date('Y-m-d'));?></span>
                </div>
                <a href="#" class="close-button">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="notification-content">
                <div class="in">
                    <h3 class="subtitle">Selamat Datang</h3>
                    <div class="text">
                        <?=$bioku['nama'];?><br/>
                        Selamat Datang di APINS.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * welcome notification -->

    <!-- ///////////// Js Files ////////////////////  -->
    <?php include "layout/javascript.php";?>


