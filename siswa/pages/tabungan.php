
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Tabungan</div>
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
                    <h5 class="subtext"><?=$bioku['nis'];?> / <?=$bioku['nisn'];?></h5>
                </div>
            </div>
        </div>

        <div class="section full mt-2">
            
        </div>

        <div class="section mt-1 mb-2">
            <div class="profile-info">
                <div class=" bio">
                    
                </div>
            </div>
        </div>

        <div class="section full">
            <div class="wide-block transparent p-0">
                <ul class="nav nav-tabs lined iconed" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#feed" role="tab">
                            <ion-icon name="grid-outline"></ion-icon> Saldo
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#trans" role="tab">
                            <ion-icon name="grid-outline"></ion-icon> Transaksi
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- tab content -->
        <div class="section full mb-2">
            <div class="tab-content">

                <!-- feed -->
                <div class="tab-pane fade show active" id="feed" role="tabpanel">
                    <ul class="listview image-listview flush transparent pt-1">
                        <li>
							<div class="item">
                                <div class="icon-box bg-primary">
									<ion-icon name="image-outline"></ion-icon>
								</div>
                                <div class="in">
                                    <div>
                                        Saldo Tabungan
                                        <div class="text-muted"><?=rupiah($saldo);?></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- * feed -->
				<div class="tab-pane fade" id="trans" role="tabpanel">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Tanggal</th>
									<th scope="col">Transaksi</th>
									<th scope="col">Saldo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$sql = "select * from tabungan where nasabah_id='$idnasabah' order by tanggal asc";
								$query = $connect->query($sql);
								$cek = $query->num_rows;
								if($cek>0){
									$total=0;
								while($s=$query->fetch_assoc()) {
									$masuk=$s['masuk'];
									$keluar=$s['keluar'];
									if($s['kode']==1) { 
										$posisi=rupiah($masuk);
									}else{
										$posisi='-'.rupiah($keluar);
									};
									$total=$total+$masuk-$keluar;
								?>
								<tr>
									<td><?=$s['tanggal'];?></td>
									<td><?=$posisi;?></td>
									<td><?=rupiah($total);?></td>
								</tr>
								<?php 
								} 
								}else{ ?>
								<tr>
									<td colspan="3">Tidak ada Data Setoran</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
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


    