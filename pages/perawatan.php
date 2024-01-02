<?php $data="Perawatan";?>
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
							<h1 class="widget20"><i class="fa fa-wrench"></i></h1>
							<h2 class="mb-3">Perawatan!</h2>
							<p class="mb-4">
								<div class="alert alert-outline-secondary">
									<div class="alert-content">Server sedang dalam tahap perawatan dan optimalisasi Database!</div>
								</div>
							</p>
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
</body>
</html>
