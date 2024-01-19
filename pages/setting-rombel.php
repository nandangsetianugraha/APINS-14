<?php $data="Setting Rombel";?>
<?php include "layout/head.php"; 

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
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Setting Rombel</h3>
									<div class="portlet-addon">
										<div class="row g-3">
										<div class="col-md-4">
										<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
										<select class="form-select" id="ptapel" name="ptapel">
											<option>Pilih Tahun Ajaran</option>
											<?php 
											$sql4 = "select * from tapel order by nama_tapel asc";
											$query4 = $connect->query($sql4);
											$ak=0;
											while($nk=$query4->fetch_assoc()){
												if($tapel==$nk['nama_tapel']){
													$stt="selected";
												}else{
													$stt='';
												};
												echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
											}	
											?>
										</select>
										</div>
										<div class="col-md-5">
										<select class="form-select" id="psmt" name="psmt">
											<option value="1" <?php if($smt=='1') echo "selected"; ?>>Semester 1</option>
											<option value="2" <?php if($smt=='2') echo "selected"; ?>>Semester 2</option>
										</select>
										</div>
										<div class="col-md-3">
										<button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#addrombel">
											<i class="fa fa-plus me-2"></i> Rombel 
										</button>
										</div>
										</div>
									</div>
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Rombel</th>
												<th>Kurikulum</th>
												<th>Wali Kelas</th>
												<th>Pendamping</th>
												<th>Guru PAI</th>
												<th>Guru PJOK</th>
												<th>Guru B Ing</th>
												<th></th>
											</tr>
										</thead>
										<tbody>     
										</tbody>
									</table>   
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
	<div class="modal fade" id="addrombel">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/tambah-rombel.php" autocomplete="off" method="POST" id="tambahrombel">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-rombel">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/setting/update-rombel.php" autocomplete="off" method="POST" id="updaterombel">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="anggota-rombel">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="fetched-data2"></div>
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
		var tapel = $('#ptapel').val();
		var smt = $('#psmt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/setting/daftar-rombel.php?tapel="+tapel+"&smt="+smt
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#ptapel').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var tapel = $('#ptapel').val();
			var smt = $('#psmt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/setting/daftar-rombel.php?tapel="+tapel+"&smt="+smt
			});
		});
		$('#psmt').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var tapel = $('#ptapel').val();
			var smt = $('#psmt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/setting/daftar-rombel.php?tapel="+tapel+"&smt="+smt
			});
		});
		$('#anggota-rombel').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modul/setting/anggota_rombel.php',
				data :  'rowid='+ rowid,
				beforeSend: function()
				{	
					$('.fetched-data2').html('<div class="modal-header"><button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="fa fa-times"></i></button></div><div class="modal-body"><div class="portlet"><div class="portlet-body"><i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...</div></div></div>');
				},
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
				
                }
            });
         });
		 $('#edit-rombel').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('tema');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modul/setting/e_rombel.php',
				data :  'rowid='+ rowid,
				beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
                success : function(data){
                $('.fetched-data1').html(data);//menampilkan data ke dalam modal
				$('#status').unblock();
                }
            });
         });
		 $('#addrombel').on('show.bs.modal', function (e) {
            var tapel = $('#ptapel').val();
			var smt = $('#psmt').val();
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modul/setting/m_rombel.php',
                data :  'tapel='+tapel+"&smt="+smt,
				beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
				$('#status').unblock();
                }
            });
         });
		$("#updaterombel").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						toastr.success(response.messages);
						TabelRombel.ajax.reload(null, false);
						$("#edit-rombel").modal('hide');
					} else {
						toastr.error(response.messages);
					}
				} // /success
			}); // /ajax
			return false;
		});
		$("#tambahrombel").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						toastr.success(response.messages);
						TabelRombel.ajax.reload(null, false);
						$("#addrombel").modal('hide');
					} else {
						toastr.error(response.messages);
					}
				} // /success
			}); // /ajax
			return false;
		});
	});
	function removeRombel(id = null) {
		if(id) {
			// click on remove button
			
			Swal.fire({
			  title: 'Yakin dihapus?',
			  text: "Apakah anda yakin menghapus Rombel ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
			  if (result.isConfirmed) {
				$.ajax({
						url: 'modul/setting/hapus-rombel.php',
						type: 'post',
						data: {member_id : id},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								// refresh the table
								var tapel = $('#tapel').val();
								toastr.success(response.messages);
								TabelRombel.ajax.reload(null, false);
								$("#info").modal('hide');
							} else {
								toastr.error(response.messages);
							}
						}
					});
			  }
			})
			
		} else {
			Swal.fire("Kesalahan","Error Sistem","error");
		}
	}
	</script>
</body>
</html>
