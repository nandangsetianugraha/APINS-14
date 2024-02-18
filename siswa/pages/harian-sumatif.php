	
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Harian Sumatif</div>
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
            <div class="section-title">Harian Sumatif</div>
            <div class="wide-block pt-2 pb-2">
                <div class="row">
					<div class="col-12">
						<div class="form-group boxed">
							<div class="input-wrapper">
								<label class="label" for="city5">Mata Pelajaran</label>
								<select class="form-control custom-select" id="mapel" name="mapel">
									<?php 
									$ab=substr($kelas,0,1);
									$sql4 = "select * from mata_pelajaran order by id_mapel asc";
									$query4 = $connect->query($sql4);
									while($mp=$query4->fetch_assoc()){
										if($ab<2 and $mp['id_mapel']==5){
											//kosongkan
										}else{
									?>
									<option value="<?=$mp['id_mapel'];?>"><?=$mp['nama_mapel'];?></option>
										<?php } ?>
									<?php } ?>
								</select>
								<input type="hidden" id="pdid" value="<?=$idku;?>">
								<input type="hidden" id="tapel" value="<?=$tapel_aktif;?>">
								<input type="hidden" id="smt" value="<?=$smt_aktif;?>">
							</div>
						</div>
					</div>
					<!--
					<div class="col-12">
						<div class="form-group boxed">
							<div class="input-wrapper">
								<label class="label" for="city5">Materi</label>
								<select class="form-control custom-select" id="materi" name="materi">
									
								</select>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group boxed">
							<div class="input-wrapper">
								<label class="label" for="city5">Tujuan Pembelajaran</label>
								<select class="form-control custom-select" id="tujuan" name="tujuan">
									
								</select>
							</div>
						</div>
					</div>
					-->
					<div class="col-12">
						<button type="button" class="btn btn-primary btn-block" id="getLaporan"><ion-icon name="search-outline"></ion-icon> Lihat</button>
					</div>
				</div>
				<div id="tabel-laporan"></div>
				
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
	<script>
	  $(document).ready(function() {
		  $(document).on('click', '#getLaporan', function(e){
			
				e.preventDefault();
				var mapel=$('#mapel').val();
				var tapel=$('#tapel').val();
            	var smt=$('#smt').val();
				var pdid=$('#pdid').val();
					$.ajax({
						type : 'GET',
						url : 'modul/nilai-sumatif.php',
						data :  'tapel=' + tapel+'&pdid='+pdid+'&smt='+smt+'&mapel='+mapel,
						beforeSend: function()
						{	
							$("#tabel-laporan").html('<p class="text-center"><img src="loader.gif"></p>');
							$('#getLaporan').addClass('disabled');
							$("#getLaporan").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading');
						},
						success: function (data) {

							//jika data berhasil didapatkan, tampilkan ke dalam option select kd
							$("#tabel-laporan").html(data);
							$('#getLaporan').removeClass('disabled');
							$('#getLaporan').html('<ion-icon name="search-outline"></ion-icon> Lihat');
						}
					});
				
				
			});
			$('#deskp').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('tema');
				var jns = $(e.relatedTarget).data('jns');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'post',
					url : 'modul/deskripsi.php',
					data :  'rowid='+ rowid+'&jns='+jns,
					beforeSend: function()
							{	
								$(".tema-data").html('<p class="text-center"><img src="loader.gif"></p>');
							},
					success : function(data){
					$('.tema-data').html(data);//menampilkan data ke dalam modal
					}
				});
			});
			$('#deskk').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('tema');
				//var jns = $(e.relatedTarget).data('jns');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'post',
					url : 'modul/deskripsis.php',
					data :  'rowid='+ rowid,
					beforeSend: function()
							{	
								$(".tema-datas").html('<p class="text-center"><img src="loader.gif"></p>');
							},
					success : function(data){
					$('.tema-datas').html(data);//menampilkan data ke dalam modal
					}
				});
			});
	  });
	</script>
   