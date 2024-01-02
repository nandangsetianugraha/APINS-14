<?php $data="Kesalahan";?>
<?php
if (isset($_SERVER['HTTP_REFERER'])){
	$refURL = $_SERVER['HTTP_REFERER'];
}else{
	$refURL = '';
}
?>
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
					<div class="row g-0 align-items-center justify-content-center h-100">
						<div class="col-md-8 col-lg-6 col-xl-4 text-center">
							<img src="<?=base_url();?>assets/images/error.svg" height="112">
							<h3 class="mb-3">Halaman Ini Saat Ini Tidak Tersedia</h3>
							<p class="mb-4">Ini bisa dikarenakan kesalahan teknis yang sedang kami perbaiki. <br/>Coba muat ulang halaman ini.</p>
							<button id="segarkan" class="btn btn-label-primary btn-lg btn-widest">Muat ulang Halaman</button>
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
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	$('#segarkan').click(function() {
    location.reload();
});
	</script>
</body>
</html>
