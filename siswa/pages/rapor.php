	
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Rapor</div>
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
		<div class="section mt-1 mb-2">
            <div class="profile-info">
                <form>
					<div class="row">
						<div class="col-6">
							<div class="form-group boxed">
								<div class="input-wrapper">
									<label class="label" for="city5">Tahun Ajaran</label>
									<select class="form-control custom-select" id="tapel" name="tapel">
										<?php
										$sql21 = "select * from penempatan where peserta_didik_id='$idku' group by tapel";
										$query21 = $connect->query($sql21);
										while($nk=$query21->fetch_assoc()){
										?>
										<option value="<?=$nk['tapel'];?>" <?php if($nk['tapel']==$tapel_aktif) echo 'selected'; ?>><?=$nk['tapel'];?></option>
										<?php } ?>
									</select>
									<input type="hidden" id="pdid" value="<?=$idku;?>">
                                  	<input type="hidden" id="kelas" value="<?=$kelas;?>">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group boxed">
								<div class="input-wrapper">
									<label class="label" for="city5">Semester</label>
									<select class="form-control custom-select" id="smt" name="smt">
										<option value="1">1</option>
										<option value="2">2</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="form-group boxed">
								<div class="input-wrapper">
									<label class="label" for="city5">.</label>
									<button type="button" class="btn btn-primary" id="getLaporan">
										<ion-icon name="search-outline"></ion-icon>
									</button>
								</div>
							</div>							
						</div>
					</div>
				</form>
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
		<div class="modal fade dialogbox" id="rapork13" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content tema-data">
                    
                </div>
            </div>
        </div>
		
		<div class="modal fade dialogbox" id="raporikm" data-backdrop="static" tabindex="-1" role="dialog">
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
				
				var tapel=$('#tapel').val();
            	var smt=$('#smt').val();
				var pdid=$('#pdid').val();
					$.ajax({
						type : 'GET',
						url : 'modul/rapor.php',
						data :  'tapel=' + tapel+'&pdid='+pdid+'&smt='+smt,
						beforeSend: function()
						{	
							$("#tabel-laporan").html('<p class="text-center"><span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span> Loading...</p>');
							$('#getLaporan').addClass('disabled');
							$("#getLaporan").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
						},
						success: function (data) {

							//jika data berhasil didapatkan, tampilkan ke dalam option select kd
							$("#tabel-laporan").html(data);
							$('#getLaporan').removeClass('disabled');
							$('#getLaporan').html('<ion-icon name="search-outline"></ion-icon>');
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
								$(".tema-data").html('<p class="text-center"><span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span> Loading...</p>');
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
								$(".tema-datas").html('<p class="text-center"><span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span> Loading...</p>');
							},
					success : function(data){
					$('.tema-datas').html(data);//menampilkan data ke dalam modal
					}
				});
			});
			$('#rapork13').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('idp');
				var tapel = $(e.relatedTarget).data('tapel');
				var smt = $(e.relatedTarget).data('smt');
				var kelas = $(e.relatedTarget).data('kelas');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'GET',
					url : '../cetak/preview.php',
					data :  'idp='+ rowid+'&tapel='+tapel+'&kelas='+kelas+'&smt='+smt,
					beforeSend: function()
							{	
								$(".tema-data").html('<p class="text-center"><span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span> Loading...</p>');
							},
					success : function(data){
						window.open('./preview',"_self");
						//$('.tema-data').html('<iframe src = "./ViewerJS/#../cetak/'+rowid+'.pdf" width="100%" height="800" allowfullscreen webkitallowfullscreen></iframe>');//menampilkan data ke dalam modal	
					}
				});
			});
			$('#raporikm').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('idp');
				var tapel = $(e.relatedTarget).data('tapel');
				var smt = $(e.relatedTarget).data('smt');
				var kelas = $(e.relatedTarget).data('kelas');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'GET',
					url : '../cetak/previews.php',
					data :  'idp='+ rowid+'&tapel='+tapel+'&kelas='+kelas+'&smt='+smt,
                  	beforeSend: function()
							{	
								$(".tema-datas").html('<p class="text-center"><span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span> Loading...</p>');
							},
					success : function(data){
						window.open('./preview',"_self");
						//$('.tema-datas').html('<iframe src = "mobile/?id='+rowid+'" width="100%" height="800" allowfullscreen webkitallowfullscreen></iframe>');//menampilkan data ke dalam modal												
					}
				});
			});
	  });
	</script>
   