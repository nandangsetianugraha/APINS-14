<?php $data="Masuk";?>
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
										<h3><?=$apps['nama'];?> v<?=$apps['versi'];?></h3>
										<!-- END Avatar -->
									</div>
									<!-- BEGIN Form -->
                                    <?php if($maintenis==1){?>
                                    <div class="alert alert-outline-secondary">
                                        <div class="alert-icon">
                                            <i class="fa fa-wrench"></i>
                                        </div>
                                        <div class="alert-content">Server sedang dalam tahap perbaikan dan optimalisasi Database, beberapa halaman akan dibatasi aksesnya!</div>
                                    </div>
                                    <?php } ?>
                                    <div id="ckc">
									<form class="d-grid gap-3" method="POST" name="form1" action="<?=base_url();?>pages/checklogin.php" id="login-form" autocomplete="off">
										<!-- BEGIN Validation Container -->
										<div class="validation-container">
											<!-- BEGIN Form Floating -->
											<div class="input-group">
												<span class="input-group-text" id="basic-addon1"><i class="fa fa-user-alt"></i></span>
												<input class="form-control form-control-lg" type="text" name="username" id="username" placeholder="Pengguna">
											</div>
											<!-- END Form Floating -->
										</div>
										<!-- END Validation Container -->
										<!-- BEGIN Validation Container -->
										<div class="validation-container">
											<!-- BEGIN Form Floating -->
											<div class="input-group">
												<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
												<input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Kata Sandi">
											</div>
											<!-- END Form Floating -->
										</div>
										<div class="validation-container">
											<div class="row">
												<div class="col-6">
													<div>
														<label for="password">Tahun Ajaran</label>
														<select id="tapel" name="tapel" class="form-select" required aria-label="select example">
															<?php 
															$tapels = $connect->query("SELECT * FROM tapel");
															//$cfg=$cekconfig->fetch_assoc();
															while($t=$tapels->fetch_assoc()){
															?>
															<option value="<?=$t['nama_tapel']?>" <?php if($t['nama_tapel']==$tapel_aktif){echo "selected";} ?>><?=$t['nama_tapel'];?></option>
															<?php } ?>
														</select>
														
													</div>
												</div>
												<div class="col-6">
													<div>
														<label for="password">Semester</label>
														<select id="smt" name="smt" class="form-select" required aria-label="select example">
															<option value="1" <?php if($smt_aktif==1){echo "selected";} ?>>Semester 1</option>
															<option value="2" <?php if($smt_aktif==2){echo "selected";} ?>>Semester 2</option>
														</select>
														
													</div>
												</div>
											</div>
										</div>
										
										<!-- END Validation Container -->
										<!-- BEGIN Flex -->
										<div class="d-flex align-items-center justify-content-between">
											<div class="validation-container">
												<!-- BEGIN Form Check -->
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="remember" name="remember">
													<label class="form-check-label" for="remember">Show/Hide Password</label>
												</div>
												<!-- END Form Check -->
											</div>
											<a href="<?=base_url();?>lupa-password">Forgot password?</a>
										</div>
										<!-- END Flex -->
										<!-- BEGIN Flex -->
										<div class="d-flex align-items-center justify-content-between">
											<span>Don't have an account? <a href="javascript:void(0);">Register</a></span>
											<button type="submit"  name="Submit" id="submit" class="btn btn-label-primary btn-lg btn-widest">Login</button>
										</div>
										<!-- END Flex -->
									</form>
									<!-- END Form -->
                                    </div>
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
	<script type="text/javascript" src="<?=base_url();?>assets/app/pages/pages/login.js"></script>
	<script src="<?=base_url();?>pages/login.js"></script>
  <script>
	$(document).ready(function(){
  
   $('#remember').on('click', function(){
      var passInput=$("#password");
      if(passInput.attr('type')==='password')
        {
          passInput.attr('type','text');
      }else{
         passInput.attr('type','password');
      }
  })
})
	</script>
</body>

</html>
