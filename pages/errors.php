<?php include "layout/head.php"; ?>
</head>

<body class="preload-active">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<div class="row g-0 align-items-center justify-content-center h-100">
						<div class="col-md-8 col-lg-6 col-xl-4 text-center">
							<h1 class="widget20"><img src="assets/images/error.svg"></h1>
							<h2 class="mb-3">Halaman Ini Saat Ini Tidak Tersedia</h2>
							<p class="mb-4">Ini bisa dikarenakan kesalahan teknis yang sedang kami perbaiki. Coba muat ulang halaman ini.</p>
							<a href="<?=base_url();?>" class="btn btn-label-primary btn-lg btn-widest">Kembali</a>
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Float Button -->
	<?php include "layout/script.php"; ?>
</body>
</html>
