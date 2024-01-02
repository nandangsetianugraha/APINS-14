<?php $data="Absensi Siswa";?>
<?php include "layout/head.php"; ?>
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
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Absensi Siswa</h3>
									<div class="portlet-addon">
										<select id="kelas" name="kelas" class="form-select">
                                            <?php if($level==11){ ?>
											<?php
											$sql3 = "select * from rombel where tapel='$tapel' and smt='$smt' order by nama_rombel asc";
											$query3 = $connect->query($sql3);
											while($nk=$query3->fetch_assoc()){
											?>
															
											<option value="<?=$nk['nama_rombel'];?>">Kelas <?=$nk['nama_rombel'];?></option>
											<?php 
											}
											?>
											<?php }else{ ?>
											<option value="<?=$kelas;?>">Kelas <?=$kelas;?></option>
											<?php } ?>
                                        </select>
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-4">
											<input type="text" class="form-control" id="tglabsen" value="<?=date('Y-m-d');?>">
										</div>
									</div>
									<hr>
									<div class="portlet">
										<!-- BEGIN Widget -->
										<div class="widget10 widget10-vertical-md">
											<div class="widget10-item">
												<div class="widget10-content">
													<h2 class="widget10-title"><div id="sakit">0</div></h2>
													<span class="widget10-subtitle">Sakit</span>
												</div>
												<div class="widget10-addon">
													<!-- BEGIN Avatar -->
													<div class="avatar avatar-label-info avatar-circle widget10-avatar">
														<div class="avatar-display">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<!-- END Avatar -->
												</div>
											</div>
											<div class="widget10-item">
												<div class="widget10-content">
													<h2 class="widget10-title"><div id="ijin">0</div></h2>
													<span class="widget10-subtitle">Ijin</span>
												</div>
												<div class="widget10-addon">
													<!-- BEGIN Avatar -->
													<div class="avatar avatar-label-primary avatar-circle widget10-avatar">
														<div class="avatar-display">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<!-- END Avatar -->
												</div>
											</div>
											<div class="widget10-item">
												<div class="widget10-content">
													<h2 class="widget10-title"><div id="alfa">0</div></h2>
													<span class="widget10-subtitle">Alfa</span>
												</div>
												<div class="widget10-addon">
													<!-- BEGIN Avatar -->
													<div class="avatar avatar-label-success avatar-circle widget10-avatar">
														<div class="avatar-display">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<!-- END Avatar -->
												</div>
											</div>
										</div>
										<!-- END Widget -->
									</div>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Absensi</th>
												<th></th>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
								</div>
							</div>
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
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="fetched-data"></div>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<!--<script type="text/javascript" src="<?=base_url();?>assets/app/pages/form/datepicker.js"></script>-->
	<script>
	var TabelRombel;
	$(document).ready(function(){
		var isRtl = $("html").attr("dir") === "rtl";
		var direction = isRtl ? "right" : "left";
		$("#tglabsen").datepicker({ 
			format: "yyyy-mm-dd",
			autoclose: true,
			orientation: direction, 
			todayHighlight: true 
		});
		var tabsen=$('#tglabsen').val();
		var kelas = $('#kelas').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		$.ajax({
			type : 'get',
			url : 'modul/siswa/cek_absen.php',
			data :  'kelas='+kelas+'&tapel='+tapel+'&tgl='+tabsen+'&smt='+smt,
			dataType : 'json',
			success : function(data){
				$('#sakit').html(data.sakit);
				$('#ijin').html(data.ijin);
				$('#alfa').html(data.alfa);
			}
		});
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/siswa/absensiku.php?kelas="+kelas+"&tapel="+tapel+"&tgl="+tabsen+"&smt="+smt
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var tabsen=$('#tglabsen').val();
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			//TabelRombel.ajax.reload(null, false);
			$.ajax({
				type : 'get',
				url : 'modul/siswa/cek_absen.php',
				data :  'kelas='+kelas+'&tapel='+tapel+'&tgl='+tabsen+'&smt='+smt,
				dataType : 'json',
				success : function(data){
					$('#sakit').html(data.sakit);
					$('#ijin').html(data.ijin);
					$('#alfa').html(data.alfa);
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/siswa/absensiku.php?kelas="+kelas+"&tapel="+tapel+"&tgl="+tabsen+"&smt="+smt
			});
		});
		$('#tglabsen').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var tabsen=$('#tglabsen').val();
			var smt=$('#smt').val();
			var tapel=$('#tapel').val();
			var kelas=$('#kelas').val();
			$.ajax({
				type : 'get',
				url : 'modul/siswa/cek_absen.php',
				data :  'kelas='+kelas+'&tapel='+tapel+'&tgl='+tabsen+'&smt='+smt,
				dataType : 'json',
				beforeSend: function()
				{	
					$("#loading").show();
					$(".loader").show();
				},
				success : function(data){
					$("#loading").hide();
					$(".loader").hide();
					$('#sakit').html(data.sakit);
					$('#ijin').html(data.ijin);
					$('#alfa').html(data.alfa);
				}
			});
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/siswa/absensiku.php?kelas="+kelas+"&tapel="+tapel+"&tgl="+tabsen+"&smt="+smt
			});
		});
	});	
	function removeAbsen(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus absensi ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/siswa/hapus-absen.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var tabsen=$('#tglabsen').val();
								var smt=$('#smt').val();
								var tapel=$('#tapel').val();
								var kelas=$('#kelas').val();
								$.ajax({
									type : 'get',
									url : 'modul/siswa/cek_absen.php',
									data :  'kelas='+kelas+'&tapel='+tapel+'&tgl='+tabsen+'&smt='+smt,
									dataType : 'json',
									success : function(data){
										$('#sakit').html(data.sakit);
										$('#ijin').html(data.ijin);
										$('#alfa').html(data.alfa);
									}
								});
								TabelRombel.ajax.reload(null, false);
							} else {
								Swal.fire("Kesalahan",response.messages,"error");
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	function saveAbsen(tanggal,siswa,tapel,smt,kelas,absensi) {
		// no change change made then return false
		// send ajax to update value
		$.ajax({
			url: "modul/siswa/saveAbsen.php",
			cache: false,
			data:'tgl='+tanggal+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel+'&id='+siswa+'&absensi='+absensi,
			success: function(response)  {
				console.log(response);
				var tabsen=$('#tglabsen').val();
				var smt=$('#smt').val();
				var tapel=$('#tapel').val();
				var kelas=$('#kelas').val();
				$.ajax({
					type : 'get',
					url : 'modul/siswa/cek_absen.php',
					data :  'kelas='+kelas+'&tapel='+tapel+'&tgl='+tabsen+'&smt='+smt,
					dataType : 'json',
					success : function(data){
						$('#sakit').html(data.sakit);
						$('#ijin').html(data.ijin);
						$('#alfa').html(data.alfa);
					}
				});
				TabelRombel.ajax.reload(null, false);
				// set updated value as old value
					
				
			}          
	   });
	}
	</script>
</body>
</html>
