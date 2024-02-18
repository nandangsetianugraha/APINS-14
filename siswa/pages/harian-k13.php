	
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Harian</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
	
	<!-- App Capsule -->
    <div id="appCapsule">
        <!-- konten -->
		<div class="section mt-2">
            <div class="profile-head">
                <div class="avatar">
                    <img src="<?=home_url();?>images/siswa/<?=$avatar;?>" alt="avatar" class="imaged w64 rounded">
                </div>
                <div class="in">
                    <h3 class="name"><?=$bioku['nama'];?></h3>
                    <h5 class="subtext">Kelas <?=$kelas;?></h5>
                </div>
            </div>
        </div>
				
				<ul class="listview image-listview flush transparent mt-3 mb-2">
					<li>
						<a href="<?=base_url();?>harian-pengetahuan" class="item">
							<div class="icon-box bg-primary">
								<ion-icon name="document-text-outline"></ion-icon>
							</div>
							<div class="in">
								Pengetahuan
							</div>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>harian-ketrampilan" class="item">
							<div class="icon-box bg-info">
								<ion-icon name="document-text-outline"></ion-icon>
							</div>
							<div class="in">
								Ketrampilan
							</div>
						</a>
					</li>
				</ul>
		<!-- konten -->
    </div>
	<!--Modal-->
		<div class="modal fade dialogbox" id="deskp" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content tema-data">
                    
                </div>
            </div>
        </div>
		<div class="modal fade dialogbox" id="deskk" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content tema-datas">
                    
                </div>
            </div>
        </div>
    <!-- * App Capsule -->
    <!-- App Bottom Menu -->
    <?php include "layout/app-bottom.php";?>
    <!-- * App Bottom Menu -->
    <!-- App Sidebar -->
    <?php include "layout/app-sidebar.php";?>
	<!-- * App Sidebar -->
    
	<!-- ///////////// Js Files ////////////////////  -->
    <?php include "layout/javascript.php";?>
	