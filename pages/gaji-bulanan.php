<?php $data="Gaji Bulanan";?>
<?php include "layout/head.php"; 
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<?php include "layout/aside.php";?>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<?php include "layout/header.php";?>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							<?php if($level<>11){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Hanya Admin!!</div>
							</div>
							<?php }else{ ?>
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Gaji Bulanan</h3>
									<div class="portlet-addon">
										<div class="row">
										<div class="col-6">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-text">
													<i class="fas fa-calendar-alt"></i>
												</span>
												<select class="form-select" name="bln" id="bulan">
													<option value="07" <?php if($bln==="08"){echo "selected";}; ?>>Juli</option>
													<option value="08" <?php if($bln==="09"){echo "selected";}; ?>>Agustus</option>
													<option value="09" <?php if($bln==="10"){echo "selected";}; ?>>September</option>
													<option value="10" <?php if($bln==="11"){echo "selected";}; ?>>Oktober</option>
													<option value="11" <?php if($bln==="12"){echo "selected";}; ?>>November</option>
													<option value="12" <?php if($bln==="01"){echo "selected";}; ?>>Desember</option>
													<option value="01" <?php if($bln==="02"){echo "selected";}; ?>>Januari</option>
													<option value="02" <?php if($bln==="03"){echo "selected";}; ?>>Februari</option>
													<option value="03" <?php if($bln==="04"){echo "selected";}; ?>>Maret</option>
													<option value="04" <?php if($bln==="05"){echo "selected";}; ?>>April</option>
													<option value="05" <?php if($bln==="06"){echo "selected";}; ?>>Mei</option>
													<option value="06" <?php if($bln==="07"){echo "selected";}; ?>>Juni</option>
												</select>
											</div>
										</div> 
										</div>
										<div class="col-6">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-text">
													<i class="fas fa-calendar-alt"></i>
												</span>
												<select class="form-select" name="thn" id="tahun">
													<?php
													$now=date('Y');
													for ($a=2012;$a<=$now;$a++){
													?>
														<option value="<?=$a;?>" <?php if(($thn)==$a){echo "selected";}; ?>><?=$a;?> </option>
													<?php 
													}
													?>
												</select>
											</div>
										</div>
										</div>
										</div>
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<form class="row g-3">
										<div class="col-md-3">
											<button class="btn btn-primary" id="cetakRekapGaji"><i class="fas fa-print"></i> Rekap Gaji</button>
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary" id="cetakSlipGaji"><i class="fas fa-print"></i> Slip Gaji</button>
										</div>
									</form>
									<hr>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nama</th>
												<th>Hari Kerja</th>
												<th>Absen Kerja</th>
												<th>Absen Ekskul</th>
												<th>Late</th>
												<th>Early</th>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
								</div>
							</div>
							<?php } ?>
							<!-- END Portlet -->
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
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="updateTemaForm" method="POST" action="modul/kepegawaian/absenmanual.php" class="form">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ijinmanual">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/kepegawaian/ijinmanual.php" autocomplete="off" method="POST" id="ijinmanualForm">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	var TabelRombel;
	$('#tanggal').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
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
	//$('#waktu').timepicker({ timeFormat: 'HH:mm' });
	$(document).ready(function(){
		var bulan=$('#bulan').val();
		var tahun=$('#tahun').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/kepegawaian/bulanan.php?bln="+bulan+"&thn="+tahun
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#bulan').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var bulan=$('#bulan').val();
			var tahun=$('#tahun').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/kepegawaian/bulanan.php?bln="+bulan+"&thn="+tahun
			});
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mp.php',
				data :  'kelas=0',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
				}
			});
		});
		$('#tahun').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var bulan=$('#bulan').val();
			var tahun=$('#tahun').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/kepegawaian/bulanan.php?bln="+bulan+"&thn="+tahun
			});
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mp.php',
				data :  'kelas=0',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
				}
			});
		});
		
		$(document).on('click', '#cetakRekapGaji', function(e){
			e.preventDefault();
			var bulan=$('#bulan').val();
			var tahun=$('#tahun').val();
			PopupCenter('cetak/rekapgaji.php?bln='+bulan+'&thn='+tahun, 'Cetak Invoice',800,800);
		});
		$(document).on('click', '#cetakSlipGaji', function(e){
			e.preventDefault();
			var bulan=$('#bulan').val();
			var tahun=$('#tahun').val();
			PopupCenter('cetak/slipgaji.php?bln='+bulan+'&thn='+tahun, 'Cetak Invoice',800,800);
		});
		
	});	
	
	function PopupCenter(pageURL, title,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	};

	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function simpankes(editableObj,column,id,bln,thn) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "modul/kepegawaian/saveBul.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&bln='+bln+'&thn='+thn,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FFF url(checkup.png) no-repeat right");				
			}          
	   });
	}
		
	
	
	</script>
</body>
</html>
