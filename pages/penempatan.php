<?php $data="Penempatan Siswa";?>
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
									<h3 class="portlet-title">Penempatan Siswa</h3>
									<div class="portlet-addon">
										<div class="form-group">
											<?php if($smt==2){ ?>
											<div class="btn-group">
											<button type="button" class="btn btn-default" data-tapel="<?=$tapel;?>" data-smt="<?=$smt;?>" id="lanjutkan"><i class="fas fa-sync"></i> Lanjutan Semester</button>
											</div>
											<?php } ?>
											<?php if($level==11){ 
											if($smt==1){?>
											<div class="btn-group">
											<button type="button" class="btn btn-default" data-tapel="<?=$tapel;?>" data-smt="<?=$smt;?>" id="luluskan"><i class="fas fa-sync"></i> Luluskan</button>
											</div>
											<?php }} ?>
										</div>
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
									<?php if($level==11){ ?>
									<input type="hidden" name="kelas" id="kelas" class="form-control" value="0">
									<?php }else{ ?>
									<input type="hidden" name="kelas" id="kelas" class="form-control" value="<?=$kelas;?>">
									<?php } ?>
								</div>
								<div class="portlet-body">
									
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>NIK</th>
												<th>NIS</th>
												<th>TTL</th>
												<th>Kelas Sebelumnya</th>
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
	<div class="modal fade" id="tempatkan">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="penempatanForm" method="POST" action="modul/siswa/add-rombel.php" class="form">
				<div class="tempatkan-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mutasikan">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="mutasiForm" method="POST" action="modul/siswa/mutasi.php" class="form">
				<div class="mutasikan-data"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	var TabelRombel;
	$(document).ready(function(){
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
		var kelas = $('#kelas').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			destroy:true,
			responsive: true, 
			"ajax": "modul/siswa/siswakosong.php?smt="+smt+"&tapel="+tapel
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#mutasikan').on('show.bs.modal', function (e) {
			var siswa = $(e.relatedTarget).data('siswa');
			var smt = $(e.relatedTarget).data('smt');
			var tapel = $(e.relatedTarget).data('tapel');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'get',
				url : 'modul/siswa/mutasikan.php',
				data :  'siswa='+siswa+'&smt='+smt+'&tapel='+tapel,
				beforeSend: function()
				{	
					$(".mutasikan-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
				},
				success : function(data){
					$('.mutasikan-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#mutasiForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function()
				{	
					$("#loading").show();
					$(".loader").show();
				},
				success:function(response) {
					$("#loading").hide();
					$(".loader").hide();
					if(response.success == true) {
						const Toast = Swal.mixin({
						  toast: true,
						  position: 'top-right',
						  iconColor: 'white',
						  customClass: {
							popup: 'colored-toast'
						  },
						  showConfirmButton: false,
						  timer: 1500,
						  timerProgressBar: true
						})
						Toast.fire({
						  icon: 'success',
						  title: response.messages
						})
						$("#mutasikan").modal('hide');
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						TabelRombel.ajax.reload(null, false);
						$("#mutasiForm")[0].reset();
					} else {
						const Toast = Swal.mixin({
						  toast: true,
						  position: 'top-right',
						  iconColor: 'white',
						  customClass: {
							popup: 'colored-toast'
						  },
						  showConfirmButton: false,
						  timer: 1500,
						  timerProgressBar: true
						})
						Toast.fire({
						  icon: 'success',
						  title: response.messages
						})
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$('#tempatkan').on('show.bs.modal', function (e) {
			var siswa = $(e.relatedTarget).data('siswa');
			var smt = $(e.relatedTarget).data('smt');
			var tapel = $(e.relatedTarget).data('tapel');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'get',
				url : 'modul/siswa/tempatkan.php',
				data :  'siswa='+siswa+'&smt='+smt+'&tapel='+tapel,
				beforeSend: function()
				{	
					$(".tempatkan-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
				},
				success : function(data){
					$('.tempatkan-data').html(data);//menampilkan data ke dalam modal
				}
			});
		});
		$("#penempatanForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function()
				{	
					$("#loading").show();
					$(".loader").show();
				},
				success:function(response) {
					$("#loading").hide();
					$(".loader").hide();
					if(response.success == true) {
						const Toast = Swal.mixin({
						  toast: true,
						  position: 'top-right',
						  iconColor: 'white',
						  customClass: {
							popup: 'colored-toast'
						  },
						  showConfirmButton: false,
						  timer: 1500,
						  timerProgressBar: true
						})
						Toast.fire({
						  icon: 'success',
						  title: response.messages
						})
						$("#tempatkan").modal('hide');
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						TabelRombel.ajax.reload(null, false);
						$("#penempatanForm")[0].reset();
					} else {
						const Toast = Swal.mixin({
						  toast: true,
						  position: 'top-right',
						  iconColor: 'white',
						  customClass: {
							popup: 'colored-toast'
						  },
						  showConfirmButton: false,
						  timer: 1500,
						  timerProgressBar: true
						})
						Toast.fire({
						  icon: 'success',
						  title: response.messages
						})
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$('#info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('siswa');
			var tapel=$('#tapel').val();
			var smt=$('#smt').val();
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modul/siswa/info-siswa.php',
                data :  'rowid='+ rowid +'&tapel='+tapel+'&smt='+smt,
				beforeSend: function()
				{	
					$('.fetched-data').html('<div class="modal-header"></div><div class="modal-body"><div class="portlet"><div class="portlet-body"><i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...</div></div></div>');
                  	$('#datatable-1').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
				$('#datatable-1').unblock();
                }
            });
         });
	});	
	</script>
</body>
</html>
