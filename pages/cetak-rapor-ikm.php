<?php $data="Cetak Rapor";?>
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
							<?php if($kurikulum=='Kurikulum 2013'){ ?>
							<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Khusus Kurikulum Merdeka!!</div>
							</div>
							<?php }else{ ?>
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<h3 class="portlet-title">Cetak Rapor</h3>
									<div class="portlet-addon">
										    
											<?php if($level==11 || $level==93){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<?php 
												$sql4 = "select * from rombel where tapel='$tapel' and smt='$smt' and kurikulum='Kurikulum Merdeka' order by nama_rombel asc";
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
													echo '<option value="'.$nk['nama_rombel'].'">Kelas '.$nk['nama_rombel'].'</option>';
												}	
												?>
											</select>
											<?php }elseif($level==98 or $level==97){ ?>
											<select id="kelas" name="kelas" class="form-select">
												<option value="0">Pilih Rombel</option>
												<option value="<?=$kelas;?>">Kelas <?=$kelas;?></option>
											</select>
											<?php }else{}; ?>
                                    </div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<div class="alert alert-outline-secondary">
										<div class="alert-icon">
											<i class="fa fa-lightbulb"></i>
										</div>
										<div class="alert-content">Menu Cetak akan muncul jika masih ada Mata Pelajaran yang belum digenerate Rapor nya. <button class="btn btn-primary" id="cetakT">Cetak Penyerahan Rapor</button></div>
									</div>
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Status</th>
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
				<form class="form-horizontal" action="modul/proyek/tambahproyek.php" autocomplete="off" method="POST" id="buatproyek">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/proyek/ubahproyek.php" autocomplete="off" method="POST" id="ubahproyek">
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
	$(document).ready(function(){
		var kelas = $('#kelas').val();
		var tapel = $('#tapel').val();
		var smt = $('#smt').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/rapor/data-rapor.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#kelas').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kelas = $('#kelas').val();
			var tapel = $('#tapel').val();
			var smt = $('#smt').val();
			TabelRombel = $("#datatable-1").DataTable({ 
				"destroy":true,
				"searching": true,
				"paging":true,
				"responsive":true,
				"ajax": "modul/rapor/data-rapor.php?kelas="+kelas+"&tapel="+tapel+"&smt="+smt
			});
			$.ajax({
				type : 'GET',
				url : 'modul/administrasi/mp.php',
				data :  'kelas='+kelas,
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success: function (data) {
					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$('#status').unblock();
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mapel</div>');
				}
			});
		});
		
		$('#info').on('show.bs.modal', function (e) {
            var kelas = $('#kelas').val();
			var mapel = $('#mp').val();
			var smt = $('#smt').val();
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/proyek/m_proyek.php',
                data :  'kelas='+ kelas+"&smt="+smt+"&tapel="+tapel,
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
		$('#edit-info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('proyek');
			//menggunakan fungsi ajax untuk pengambilan data
			$.ajax({
				type : 'post',
				url : 'modul/proyek/e_proyek.php',
                data :  'rowid='+ rowid,
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
		$("#buatproyek").unbind('submit').bind('submit', function() {
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
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						$('#datatable-1').DataTable().ajax.reload();
						//$("#createKDFormk")[0].reset();
						// this function is built in function of datatables;
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
		}); // /submit form for Tujuan
		
		$("#ubahproyek").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					$("#edit-info").modal('hide');
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
						var kelas = $('#kelas').val();
						var tapel = $('#tapel').val();
						var smt = $('#smt').val();
						var mp = $('#mp').val();
						TabelRombel.ajax.reload(null, false);
					} else {
						Swal.fire("Kesalahan","Masih ada TP yang terdaftar pada LM ini!","error");
					}
				} // /success
			}); // /ajax
			return false;
		});
		$(document).on('click', '#previewR', function(e){
			e.preventDefault();
			var rowid = $(this).data('id');
			var kelas = $(this).data('kelas');
			var tapel = $(this).data('tapel');
			var smt = $(this).data('smt');
			PopupCenter('cetak/cetak-rapor.php?idp='+rowid+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel, 'Cetak Rapor',800,800);
			
		});
        $(document).on('click', '#previewB', function(e){
			e.preventDefault();
			var rowid = $(this).data('id');
			var kelas = $(this).data('kelas');
			var tapel = $(this).data('tapel');
			var smt = $(this).data('smt');
			PopupCenter('cetak/cetak-nilai.php?idp='+rowid+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel, 'Cetak Nilai',800,800);
			
		});
		$(document).on('click', '#previewS', function(e){
			e.preventDefault();
			var rowid = $(this).data('id');
			var kelas = $(this).data('kelas');
			var tapel = $(this).data('tapel');
			var smt = $(this).data('smt');
			PopupCenter('cetak/cetak-sampul-rapor.php?idp='+rowid+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel, 'Cetak Sampul Rapor',800,800);
			
		});
		$(document).on('click', '#previewI', function(e){
			e.preventDefault();
			var rowid = $(this).data('id');
			var kelas = $(this).data('kelas');
			var tapel = $(this).data('tapel');
			var smt = $(this).data('smt');
			PopupCenter('cetak/cetak-identitas-rapor.php?idp='+rowid+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel, 'Cetak Identitas Rapor',800,800);
			
		});
		$(document).on('click', '#previewA', function(e){
			e.preventDefault();
			var rowid = $(this).data('id');
			var kelas = $(this).data('kelas');
			var tapel = $(this).data('tapel');
			var smt = $(this).data('smt');
			PopupCenter('cetak/cetak-rapors.php?idp='+rowid+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel, 'Cetak Rapor',800,800);
			
		});
		$(document).on('click', '#previewM', function(e){
			e.preventDefault();
			var rowid = $(this).data('id');
			var kelas = $(this).data('kelas');
			var tapel = $(this).data('tapel');
			var smt = $(this).data('smt');
			PopupCenter('cetak/cetak-mutasi.php?idp='+rowid+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel, 'Cetak Halaman Mutasi',800,800);
			
		});
		
	});	
		
	
	function PopupCenter(pageURL, title,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	};
	
	$( "#cetakT" ).click(function() {
			var kelas=$('#kelas').val();
			var tapel=$('#tapel').val();
			var smt=$('#smt').val();
			if(kelas == 0){
				Swal.fire("Kesalahan",'Pilih Kelas Dahulu',"error");
				//swal('Pilih Kelas Dahulu', {buttons: false,timer: 1000,});
			}else{
				PopupCenter('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt, 'Cetak Penyerahan Rapor',800,800);
				//window.open('cetak/cetak-penyerahan-raport.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt,' _blank');
			}
		});
	
		
	</script>
</body>
</html>
