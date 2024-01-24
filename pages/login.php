<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?=base_url();?>assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | <?=$apps['nama'];?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url();?>assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/fonts/materialdesignicons.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/typeahead-js/typeahead.css" />
	<link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/spinkit/spinkit.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/@form-validation/umd/styles/index.min.css" />
	<link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/toastr/toastr.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="<?=base_url();?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url();?>assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
      <!-- Logo -->
      
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
       
        <!-- /Left Section -->

        <!-- Login -->
		
        <div
          class="d-flex col-12 col-lg-12 col-xl-12 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4" id="log-in">
          <div class="w-px-400 mx-auto pt-1 pt-lg-0" id="statusnya">
			<p class="text-center mt-2">
              <a href="<?=base_url();?>">
			  		<img src="<?=base_url();?>assets/<?=$cfgs['image_login'];?>" alt="Avatar image" style="width: 100px; height: 100px;"><br>				
				<span class="app-brand-text demo text-heading fw-bold">Rapor <?=$apps['nama'];?> Versi <?=$apps['versi'];?></span>
			  </a>
            </p>
			
            <?php if($maintenis==1){ ?>
                <div class="alert alert-solid-danger d-flex align-items-center" role="alert">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                    Saat ini Server sedang Maintenance, beberapa halaman akan dibatasi aksesnya.
                </div>
            <?php } ?>

            <form id="formAuthentication" class="mb-3" method="POST" name="form1" action="<?=base_url();?>pages/checklogin.php" autocomplete="off">
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Masukkan Nama Pengguna"
                  autofocus />
                <label for="email">Nama Pengguna</label>
              </div>
              <div class="mb-3">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                      <label for="password">Kata Sandi</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
              </div>
			  
              <div class="mb-3">
                <div class="row">
					  <div class="col-6">
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
					  <div class="col-6">
						<select id="smt" name="smt" class="form-select" required aria-label="select example">
							<option value="1" <?php if($smt_aktif==1){echo "selected";} ?>>Semester 1</option>
							<option value="2" <?php if($smt_aktif==2){echo "selected";} ?>>Semester 2</option>
						</select>
					  </div>
				</div>
				<a href="<?=base_url();?>lupa-password">Forgot password?</a>
              </div>
              <button type="submit"  name="Submit" id="submit" class="btn btn-primary d-grid w-100">Masuk</button>
            </form>

            <script>
    function updateClock() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();
      var day = currentTime.getDate();
      var month = currentTime.getMonth() + 1; // Perhatikan: Bulan dimulai dari 0
      var year = currentTime.getFullYear();

      // Format waktu
      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;
      
      // Format tanggal
      day = (day < 10) ? "0" + day : day;
      month = (month < 10) ? "0" + month : month;

      // Membuat string waktu dan tanggal dalam format HH:mm:ss DD/MM/YYYY
      var dateTimeString = hours + ":" + minutes + ":" + seconds + " " + day + "-" + month + "-" + year;

      // Menetapkan nilai string waktu dan tanggal ke elemen dengan id "dateTime"
      document.getElementById("dateTime").innerText = dateTimeString;

      // Memanggil fungsi ini lagi setiap detik
      setTimeout(updateClock, 1000);
    }

    // Memanggil fungsi updateClock() setelah dokumen selesai dimuat
    window.onload = function() {
      updateClock();
    };
  </script>
</head>
<body>
  
  <div class="text-center mt-2" id="dateTime"></div>
</body>

            
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=base_url();?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url();?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?=base_url();?>assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?=base_url();?>assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
	<script src="<?=base_url();?>assets/vendor/libs/block-ui/block-ui.js"></script>
	<script src="<?=base_url();?>assets/vendor/libs/toastr/toastr.js"></script>

    <!-- Main JS -->
    <script src="<?=base_url();?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=base_url();?>assets/js/pages-auth.js"></script>
	<script src="<?=base_url();?>pages/login.js"></script>
  </body>
</html>
