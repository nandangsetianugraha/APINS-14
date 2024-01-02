<?php $data="Autentifikasi";?>
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
						<div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
							<!-- BEGIN Portlet -->
							<div class="portlet" id="log-in">
								<div class="portlet-body">
									<div class="text-center mt-4 mb-5">
										<!-- BEGIN Avatar -->
										<div class="avatar avatar-lg">
											<span class="avatar-display">
												<img src="assets/images/aljannah.png" alt="AI">
											</span>
										</div>
										<h3>APINS versi <?=$versi;?></h3>
										<!-- END Avatar -->
									</div>
									<!-- BEGIN Form -->
									<h2>Autentifikasi Berhasil</h2>
									<p>Menunggu mengarahkan ke halaman utama</p>
									<!-- END Form -->
								</div>
							</div>
							<!-- END Portlet -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<?php include "layout/script.php"; ?>
  <script>
	$(document).ready(function(){
		location.href = "https://apins.sdi-aljannah.web.id"
   	})
	</script>
</body>

</html>
