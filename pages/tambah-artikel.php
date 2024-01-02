<?php $data="Tambah Artikel";?>
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
									<h3 class="portlet-title">Tambah Artikel</h3>
									<div class="portlet-addon">
										<a href="daftar-artikel" class="btn btn-danger modal-confirm">Kembali</a>
									</div>
									<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
									<form class="row g-3" action="modul/berita/simpan-artikel.php" autocomplete="off" method="POST" id="simpanartikel" autocomplete="off">
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">Tanggal</label>
											<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?=date('Y-m-d');?>">
											<input type="hidden" name="penulis" id="penulis" value="<?=$bioku['ptk_id'];?>">
										</div>
										<div class="col-md-6">
											<label for="inputEmail4" class="form-label">Judul</label>
											<input type="text" class="form-control" id="judul" name="judul" required>
										</div>
										<div class="col-md-12">
											<label for="inputEmail4" class="form-label">Isi Artikel</label>
											<div class="quill" id="quill"></div>
										</div>
										<div class="row">
											<div class="col-md-12 text-end mt-3">
												<button type="submit" class="btn btn-primary modal-confirm">Simpan</button>
												<a href="daftar-artikel" class="btn btn-danger modal-confirm">Kembali</a>
											</div>
										</div>
									</form>
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
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="ekskulForm" method="POST" action="modul/rapor/simpan-ekskul.php" class="form">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
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
	var isRtl = $("html").attr("dir") === "rtl";
	var direction = isRtl ? "right" : "left";
	$("#tanggal").datepicker({ 
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: direction, 
		todayHighlight: true 
	});
	var quill = new Quill("#quill", {
					theme: "snow",
					modules: {
						toolbar: [
							[{ font: ["poppins", "roboto mono"] }, { size: [] }],
							["bold", "italic", "underline", "strike"],
							[{ color: [] }, { background: [] }],
							[{ script: "super" }, { script: "sub" }],
							[{ header: "1" }, { header: "2" }, "blockquote"],
							[{ list: "ordered" }, { list: "bullet" }, { indent: "-1" }, { indent: "+1" }],
							[{ direction: "rtl" }, { align: [] }],
							["link", "image", "video", "formula"],
							["clean"],
						],
					},
				});
	$("#simpanartikel").unbind('submit').bind('submit', function() {
			var form = $(this);
			var quillHtml = quill.root.innerHTML.trim();
			var tanggal = $('#tanggal').val();
			var judul = $('#judul').val();
			var penulis = $('#penulis').val();
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : {content:quillHtml,tanggal:tanggal,judul:judul,penulis:penulis},
				dataType : 'json',
				beforeSend: function(){	
					$('#simpanartikel').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#simpanartikel').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						setTimeout(function () {window.open("./daftar-artikel","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
	
	
	</script>
</body>
</html>
