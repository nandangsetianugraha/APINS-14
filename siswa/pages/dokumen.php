	
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Dokumen</div>
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
						<a href="akte" class="item">
							<div class="icon-box bg-primary">
								<ion-icon name="card-outline"></ion-icon>
							</div>
							<div class="in">
								Akte Lahir
							</div>
						</a>
					</li>
					<li>
						<a href="kip" class="item">
							<div class="icon-box bg-primary">
								<ion-icon name="card-outline"></ion-icon>
							</div>
							<div class="in">
								Kartu Indonesia Pintar (KIP)
							</div>
						</a>
					</li>
					<li>
						<a href="javascript;;" data-idp="<?=$bioku['peserta_didik_id'];?>" data-toggle="modal" data-target="#KIS" class="item">
							<div class="icon-box bg-primary">
								<ion-icon name="card-outline"></ion-icon>
							</div>
							<div class="in">
								Kartu Identitas Siswa (KIS)
							</div>
						</a>
					</li>
                  	<li>
						<a href="ijazah-SD" class="item">
							<div class="icon-box bg-primary">
								<ion-icon name="card-outline"></ion-icon>
							</div>
							<div class="in">
								Ijazah SD
							</div>
						</a>
					</li>
                  	<li>
						<a href="ijazah-DTA" class="item">
							<div class="icon-box bg-primary">
								<ion-icon name="card-outline"></ion-icon>
							</div>
							<div class="in">
								Ijazah DTA
							</div>
						</a>
					</li>
				</ul>
		<!-- konten -->
    </div>
	<!--Modal-->
		
		<div class="modal fade dialogbox" id="KIS" data-backdrop="static" tabindex="-1" role="dialog">
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
		  $('#KIS').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('idp');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'get',
					url : 'cetak/kis.php',
					data :  'idp='+ rowid,
					beforeSend: function()
							{	
								$(".tema-datas").html('<p class="text-center"><span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span> Loading...</p>');
							},
					success : function(data){
						window.open('kis',"_self");
						//$('.tema-datas').html('<iframe src = "mobile/?id='+rowid+'" width="100%" height="800" allowfullscreen webkitallowfullscreen></iframe>');//menampilkan data ke dalam modal												
					}
				});
			});
		 
	  });
	</script>
	