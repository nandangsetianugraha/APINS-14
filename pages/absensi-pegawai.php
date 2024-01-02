<?php $data="Absensi Pegawai";?>
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
									<h3 class="portlet-title">Absensi Pegawai</h3>
									<div class="portlet-addon">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-text">
													<i class="fas fa-calendar-alt"></i>
												</span>
												<input type="text" id="tanggal" value="<?=date('Y-m-d');?>" class="form-control"  required>
											</div>
										</div>    
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nama</th>
												<th>Absen Masuk</th>
												<th>Absen Pulang</th>
												<th>Telat</th>
												<th>Early</th>
												<th></th>
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
		var tanggal=$('#tanggal').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/kepegawaian/data-absen.php?tanggal="+tanggal,
			createdRow: function(row, data, dataIndex){
			   if(data[6] === 'Hari Libur' || data[6] === 'Sakit' || data[6] === 'Ijin' || data[6] === 'Cuti'){
				  // Add COLSPAN attribute
				  $('td:eq(2)', row).attr('colspan', 5);
				  
				  // Hide required number of columns 
				  // next to the column with COLSPAN attribute
				  $('td:eq(3)', row).css('display', 'none');
				  $('td:eq(4)', row).css('display', 'none');
				  $('td:eq(5)', row).css('display', 'none');
				  $('td:eq(6)', row).css('display', 'none');
				  // Update cell data
				  $('#datatable-1').DataTable().cell($('td:eq(2)', row)).data(data[6]);
			   }        
			}
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#tanggal').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var tanggal=$('#tanggal').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/kepegawaian/data-absen.php?tanggal="+tanggal,
				createdRow: function(row, data, dataIndex){
				   if(data[6] === 'Hari Libur' || data[6] === 'Sakit' || data[6] === 'Ijin' || data[6] === 'Cuti'){
					  // Add COLSPAN attribute
					  $('td:eq(2)', row).attr('colspan', 5);
					  
					  // Hide required number of columns 
					  // next to the column with COLSPAN attribute
					  $('td:eq(3)', row).css('display', 'none');
					  $('td:eq(4)', row).css('display', 'none');
					  $('td:eq(5)', row).css('display', 'none');
					  $('td:eq(6)', row).css('display', 'none');
					  // Update cell data
					  $('#datatable-1').DataTable().cell($('td:eq(2)', row)).data(data[6]);
				   }        
				}
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
		
		$('#info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
			var tanggal=$('#tanggal').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/kepegawaian/e_absen.php',
				data :  'rowid='+ rowid+'&tanggal='+tanggal,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$('#ijinmanual').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('ids');
			var hari = $(e.relatedTarget).data('tgls');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/kepegawaian/modal_ijin.php',
				data :  'rowid='+ rowid + '&hari='+ hari,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success : function(data){
					$('#status').unblock();
					$('.fetched-data1').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#updateTemaForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
				success:function(response) {
					$("#info").modal('hide');
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						var tanggal=$('#tanggal').val();
						TabelRombel.ajax.reload(null, false);
						$("#info").modal('hide');
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for Tujuan
		
		$("#ijinmanualForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
				success:function(response) {
					$("#info").modal('hide');
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						var tanggal=$('#tanggal').val();
						TabelRombel.ajax.reload(null, false);
						$("#ijinmanual").modal('hide');
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for Tujuan
		
	});	
		
	
	
	</script>
</body>
</html>
