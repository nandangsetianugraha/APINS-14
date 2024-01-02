<?php $data="File Manager";?>
<?php include "layout/head.php"; 
date_default_timezone_set('Asia/Jakarta');
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$lvl=$_SESSION['level'];
$cat = $tipe;
?>
<style>
// Countdown
#countdown{
	width: 465px;
	height: 112px;
	text-align: center;
	background: #222;
	background-image: -webkit-linear-gradient(top, #222, #333, #333, #222); 
	background-image:    -moz-linear-gradient(top, #222, #333, #333, #222);
	background-image:     -ms-linear-gradient(top, #222, #333, #333, #222);
	background-image:      -o-linear-gradient(top, #222, #333, #333, #222);
	border: 1px solid #111;
	border-radius: 5px;
	box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.6);
	margin: auto;
	padding: 24px 0;
	position: absolute;
  top: 0; bottom: 0; left: 0; right: 0;
}

#countdown:before{
	content:"";
	width: 8px;
	height: 65px;
	background: #444;
	background-image: -webkit-linear-gradient(top, #555, #444, #444, #555); 
	background-image:    -moz-linear-gradient(top, #555, #444, #444, #555);
	background-image:     -ms-linear-gradient(top, #555, #444, #444, #555);
	background-image:      -o-linear-gradient(top, #555, #444, #444, #555);
	border: 1px solid #111;
	border-top-left-radius: 6px;
	border-bottom-left-radius: 6px;
	display: block;
	position: absolute;
	top: 48px; left: -10px;
}

#countdown:after{
	content:"";
	width: 8px;
	height: 65px;
	background: #444;
	background-image: -webkit-linear-gradient(top, #555, #444, #444, #555); 
	background-image:    -moz-linear-gradient(top, #555, #444, #444, #555);
	background-image:     -ms-linear-gradient(top, #555, #444, #444, #555);
	background-image:      -o-linear-gradient(top, #555, #444, #444, #555);
	border: 1px solid #111;
	border-top-right-radius: 6px;
	border-bottom-right-radius: 6px;
	display: block;
	position: absolute;
	top: 48px; right: -10px;
}

#countdown #tiles{
	position: relative;
	z-index: 1;
}

#countdown #tiles > span{
	width: 92px;
	max-width: 92px;
	font: bold 48px 'Droid Sans', Arial, sans-serif;
	text-align: center;
	color: #111;
	background-color: #ddd;
	background-image: -webkit-linear-gradient(top, #bbb, #eee); 
	background-image:    -moz-linear-gradient(top, #bbb, #eee);
	background-image:     -ms-linear-gradient(top, #bbb, #eee);
	background-image:      -o-linear-gradient(top, #bbb, #eee);
	border-top: 1px solid #fff;
	border-radius: 3px;
	box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.7);
	margin: 0 7px;
	padding: 18px 0;
	display: inline-block;
	position: relative;
}

#countdown #tiles > span:before{
	content:"";
	width: 100%;
	height: 13px;
	background: #111;
	display: block;
	padding: 0 3px;
	position: absolute;
	top: 41%; left: -3px;
	z-index: -1;
}

#countdown #tiles > span:after{
	content:"";
	width: 100%;
	height: 1px;
	background: #eee;
	border-top: 1px solid #333;
	display: block;
	position: absolute;
	top: 48%; left: 0;
}

#countdown .labels{
	width: 100%;
	height: 25px;
	text-align: center;
	position: absolute;
	bottom: 8px;
}

#countdown .labels li{
	width: 102px;
	font: bold 15px 'Droid Sans', Arial, sans-serif;
	color: #f47321;
	text-shadow: 1px 1px 0px #000;
	text-align: center;
	text-transform: uppercase;
	display: inline-block;
}
</style>

</head>
<?php  
$sql = "SELECT * FROM setting_dokumen";
$querys = $connect->query($sql);
$rowp = $querys->fetch_assoc();
?>
<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<?php include "layout/aside.php"; ?>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<?php include "layout/header.php";?>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
							<div class="portlet">
                              <?php 
                              $idp=$_SESSION['userid'];
                              $jumfile = $connect->query("select * from form_data where hapus='0'")->num_rows;
                              if($lvl==11){
                              	$sql = "SELECT * FROM form_data where hapus='0' order by submitted_on desc";
                              }else{
                                $sql = "SELECT * FROM form_data where ptk_id='$idp' and hapus='0' order by submitted_on desc";
                              }
                              $querys = $connect->query($sql);
                              $ukuran = 0;
                              $stats=$connect->query("select sum(download) as diunduh, sum(view) as dilihat from form_data")->fetch_assoc();
                              while ($row = $querys->fetch_assoc()) {
                                $filed = $_SERVER['DOCUMENT_ROOT'].'/dokumen/uploads/'.$row['file_names'];
                                if(file_exists($filed)){
                                    $ukuran = $ukuran + fm_get_size($filed);
                                    //$filesize = fm_get_filesize($filesize_raw);
                                }else{
                                    $ukuran=$ukuran;
                                };
                              }
                              ?>
                              <div class="widget10 widget10-vertical-md">
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$jumfile;?></h2>
											<span class="widget10-subtitle">Dokumen</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-info avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa-solid fa-folder-open"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=fm_get_filesize($ukuran);?></h2>
											<span class="widget10-subtitle">Ukuran</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-primary avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa-solid fa-file-circle-question"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$stats['diunduh'];?></h2>
											<span class="widget10-subtitle">Diunduh <?=$rowp['tutup'];?></span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-success avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa-solid fa-cloud-arrow-down fa-fade"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
									<div class="widget10-item">
										<div class="widget10-content">
											<h2 class="widget10-title"><?=$stats['dilihat'];?></h2>
											<span class="widget10-subtitle">Dilihat</span>
										</div>
										<div class="widget10-addon">
											<!-- BEGIN Avatar -->
											<div class="avatar avatar-label-danger avatar-circle widget10-avatar">
												<div class="avatar-display">
													<i class="fa-solid fa-magnifying-glass"></i>
												</div>
											</div>
											<!-- END Avatar -->
										</div>
									</div>
								</div>
                  			</div>
                                

                            <?php if ($rowp['tutup']==='1') { ?>
							<div class="alert alert-outline-secondary" id="itung">
                                <div class="alert-icon">
                                    <i class="fa fa-lightbulb"></i>
                                </div>
                                <div class="alert-content"> 
                                   UPLOAD DOKUMEN AKAN DITUTUP : <h2 id="demo"></h2>
                                </div>
                            </div>
                            <?php } ?>
                                    <div class="portlet" id="infos">
										<div class="portlet-header portlet-header-bordered">
											<div class="portlet-icon">
												<i class="fa-solid fa-folder-open"></i>
											</div>
											<h3 class="portlet-title">File Manager</h3>
											<div class="portlet-addon">
												
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-dokumen"><i class="fa fa-plus"></i> Unggah</button>
												<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
												<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
												<input type="hidden" name="ptkid" id="ptkid" class="form-control" value="<?=$idku;?>" placeholder="Username">
											</div>
										</div>
										<div class="portlet-body">
                                            <ul class="nav nav-tabs mb-2">
                                                <?php $stats=$connect->query("select count(kategori) as banyak from form_data where hapus='0'")->fetch_assoc(); ?>
												<li class="nav-item">
													<a class="nav-link <?php if($tipe==''){ echo "active";} ?>" href="<?=base_url();?>upload-dokumen">Semua (<?=$stats['banyak'];?>)</a>
												</li>
                                                <?php 
												$sql = "SELECT * FROM kategori order by id asc";
												$querys = $connect->query($sql);
												while ($row = $querys->fetch_assoc()) {
													$idk=$row['id'];
													$stats=$connect->query("select count(kategori) as banyak from form_data where kategori='$idk' and hapus='0'")->fetch_assoc();
												?>
												<li class="nav-item">
													<a class="nav-link <?php if($tipe==$row['id']){ echo "active";} ?>" href="<?=base_url();?>upload-dokumen/<?=$row['id'];?>"><?=$row['kategori'];?> (<?=$stats['banyak'];?>)</a>
												</li>
                                                <?php } ?>												
											</ul>
											<!-- BEGIN Datatable -->
											<table id="datatable-1" class="table table-bordered table-striped table-hover mt-2">
												<thead>
													<tr>
														<th>Dokumen</th>
														<th>Modified</th>
														<th>Owner</th>
														<th></th>
													</tr>
												</thead>
											</table>
											<!-- END Datatable -->
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
	<div class="modal fade" id="info">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content fetched-data">
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="tambah-dokumen" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Unggah Dokumen</h5>
					<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<form id="fupForm" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
					<div class="form-group mb-2">
                        <label for="judul">Deskripsi Dokumen</label>
                        <input type="hidden" class="form-control" id="idptk" name="idptk" value="<?=$idku;?>" required />
                        <input type="hidden" class="form-control" id="tapel" name="tapel" value="<?=$tapel;?>" required />
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Deskripsi Dokumen" required />
                    </div>
					<div class="form-group mb-2">
                        <label for="file">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori">
                           	<?php 
							$sql3 = "select * from kategori order by id asc";
							$query3 = $connect->query($sql3);
							while($nk=$query3->fetch_assoc()){
							?>
							<option value="<?=$nk['id'];?>"><?=$nk['kategori'];?></option>
							<?php };?>
						</select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="file">Dokumen</label>
                        <input type="file" class="form-control" id="file" name="files[]" multiple />
                    </div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	var TabelRombel;
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

$(document).ready(function(){



		var ptkid = $('#ptkid').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
          	"order": [[1, 'desc']],
          	"stateSave": true,
			<?php if($tipe==''){ ?>
			"ajax": "<?=base_url();?>modul/dokumen/daftar-dokumen.php?ptkid="+ptkid+"&kategori=0"
			<?php }else{ ?>
			"ajax": "<?=base_url();?>modul/dokumen/daftar-dokumen.php?ptkid="+ptkid+"&kategori="+<?=$tipe;?>
			<?php } ?>
		});
		
  	setInterval(function() {
          TabelRombel.ajax.reload(null, false);
		}, 20000);
	
		$('#info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('doc');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '<?=base_url();?>modul/dokumen/info-dokumen.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
				{	
					$('.fetched-data').html('<div class="modal-header"><button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="fa fa-times"></i></button></div><div class="modal-body"><div class="portlet"><div class="portlet-body"><i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...</div></div></div>');
                  	
				},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
				TabelRombel.ajax.reload(null, false);
                }
            });
        });
		
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?=base_url();?>dokumen/upload_dokumen.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                //$('#fupForm').css("opacity",".5");
              	//$('.statusmsg').html('<div class="portlet"><div class="portlet-body"><div class="spinner-grow text-success"></div> Loading ...</div></div>');
				$('#fupForm').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
            },
            success: function(response){
                $('#fupForm').unblock();
				
                if(response.status == 1){
                    $('#fupForm')[0].reset();
                  	toastr.success(response.message);
                  	
                    //$('.statusmsg').html('<div class="portlet"><div class="portlet-body"><div class="spinner-grow text-success"></div> Loading ...</div></div>');
                }else{
                  	toastr.error(response.message);
                   // $('.statusmsg').html('<div class="portlet"><div class="portlet-body">'+response.message+'</div></div>');
                }
                //$('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
				//setTimeout(function () {window.open("<?=base_url();?>upload-dokumen","_self");},1000);
                TabelRombel.ajax.reload(null, false);
				$("#tambah-dokumen").modal('hide');
            }
        });
    });
	
    // File type validation
    var match = ['audio/mpeg','video/mp4', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]) || (fileType == match[6]) || (fileType == match[7]))){
                toastr.error('Sorry, only PDF, DOC, DOCX, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    });
});
		function removeDokumen(id = null) {
			if(id) {
				// click on remove button
				
				Swal.fire({
				  title: 'Yakin dihapus?',
				  text: "Apakah anda yakin menghapus Dokumen ini?",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, Hapus!'
				}).then((result) => {
				  if (result.isConfirmed) {
					$.ajax({
							url: '<?=base_url();?>modul/dokumen/hapus-dokumen.php',
							type: 'post',
							data: {member_id : id},
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {						
									// refresh the table
									toastr.success(response.messages);
									TabelRombel.ajax.reload(null, false);
								} else {
									toastr.error(response.messages);
								}
							}
						});
				  }
				})
				
			} else {
				toastr.error("Kesalahan sistem");
			}
		}
		
		function unduhDokumen(id = null) {
			if(id) {
				// click on remove button
				
				Swal.fire({
				  title: 'Unduh',
				  text: "Unduh Dokumen ini?",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, Unduh!'
				}).then((result) => {
				  if (result.isConfirmed) {
					$.ajax({
							url: '<?=base_url();?>modul/dokumen/unduh-dokumen.php',
							type: 'post',
							data: {member_id : id},
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {						
									// refresh the table
									toastr.success(response.messages);
									download(response.nama);
									TabelRombel.ajax.reload(null, false);
								} else {
									toastr.error(response.messages);
								}
							}
						});
				  }
				})
				
			} else {
				toastr.error("Kesalahan sistem");
			}
		}
		function download(filename){
			window.location.href="<?=base_url();?>dokumen/uploads/"+filename;
		}
</script>

<?php if($rowp['tutup']==='1'){ ?>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?=$rowp['tanggal'];?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  if(days>9){}else{days="0"+days};
  if(hours>9){}else{hours="0"+hours};
  if(minutes>9){}else{minutes="0"+minutes};
  if(seconds>9){}else{seconds="0"+seconds};
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
  + minutes + " Menit " + seconds + " Detik";
  <?php if($level==11){}else{ ?>
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    $("#infos").show();
	$("#itung").hide();
    document.getElementById("infos").innerHTML = '<div class="alert alert-outline-secondary"><div class="alert-icon"><i class="fa fa-lightbulb"></i></div><div class="alert-content">Batas Waktu Upload Dokumen Sudah Habis!!<br/>Hubungi Operator untuk mengupload dokumen</div></div>';
  }
  <?php } ?>
}, 1000);

</script>
<?php } ?>
</body>
</html>
