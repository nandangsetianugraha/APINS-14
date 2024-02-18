	
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Sumatif Tengah Semester</div>
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
		<div class="section full mt-2">
            <div class="section-title">Sumatif Tengah Semester</div>
            <div class="wide-block pt-2 pb-2">
                
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Mata Pelajaran</th>
											<th>Nilai</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$ab=substr($kelas,0,1);
									$sql4 = "select * from mata_pelajaran order by id_mapel asc";
									$query4 = $connect->query($sql4);
									while($mp=$query4->fetch_assoc()){
										if($ab<2 and $mp['id_mapel']==5){
											//kosongkan
										}else{
											$mpl=$mp['id_mapel'];
											$nilai = $connect->query("select * from sts where id_pd='$idku' and smt='$smt_aktif' and tapel='$tapel_aktif' and mapel='$mpl'")->fetch_assoc();
									?>
										<tr>
											<td><?=$mp['nama_mapel'];?></td>
											<td><?=$nilai['nilai'];?></td>
										</tr>
									<?php }} ?>
									</tbody>
								</table>
									
							</div>
            </div>

        </div>
		
				
				
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
	