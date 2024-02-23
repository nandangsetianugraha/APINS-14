<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
include "../config/config.php";
include "../config/db_connect.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Login | APINS</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="<?=base_url();?>assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
    <link rel="manifest" href="<?=base_url();?>__manifest.json">
  	<style>
.pageLoader {
  background: #fff;
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  z-index: 9000;
  display: flex;
  align-items: center;
  justify-content: center;
}
.pageLoader .imgWrapper {
  width: 80px;
  height: 80px;
  display: inline-block;
  position: relative;
  margin-bottom: 32px;
}
.pageLoader .imgWrapper .spin {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  border-radius: 10px;
  background: rgba(0, 0, 0, 0.4);
}
.pageLoader .imgWrapper .spin .spinner-border {
  margin-top: 24px;
}
.pageLoader .in {
  color: #161e29;
  font-size: 20px;
  font-weight: 500;
  letter-spacing: -0.02em;
  text-align: center;
}
.pageLoader .in .itemlogo {
  width: 80px;
  height: 80px;
  border-radius: 10px;
}
</style>
</head>
<body class="bg-white">
	<!-- loader -->
    <div class="pageLoader">
        <div class="in">
            <div class="imgWrapper">
                <img src="../assets/img/aljannah.png" alt="logo" class="itemlogo">
                <div class="spin">
                    <div class="spinner-border text-light" role="status"></div>
                </div>
            </div>
            <p>Loading...</p>
        </div>
    </div>
    <!-- * loader -->
  	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            
        </div>
        <div class="pageTitle">Masuk - APINS</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
    <!-- App Capsule -->
    <div id="appCapsule">
		
        <div class="login-form mt-1">
            <div class="section">
                <img src="<?=base_url();?>assets/img/aljannah.png" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Masuk</h1>
                <h4>Gunakan NIS dan Tanggal Lahir</h4>
            </div>
            <div class="section mt-1 mb-5">
                <form method="POST" name="form1" action="checklogin.php" class="js-validate needs-validation" novalidate>
					<ul class="listview image-listview no-line no-space flush">
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="mail-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="email6">Nomor Induk Siswa</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="NIS" autocomplete=off>
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                        <div class="input-info">Masukkan NIS</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="lock-closed-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="password6">Kata Sandi</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="YYYYmmdd">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                        <div class="input-info">Masukkan Kata Sandi</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="form-links mt-2">
                        <div>
                            <a href="javascript:;">Register Now</a>
                        </div>
                        <div><a href="javascript:;" class="text-muted">Forgot Password?</a></div>
                    </div>
                    <div class="form-button-group">
                        <button type="submit" name="Submit" id="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->
	<div id="notification-welcome" class="notification-box">
        <div class="notification-dialog android-style">
            <div class="notification-header">
                <div class="in">
                    <img src="<?=base_url();?>assets/img/icon/72x72.png" alt="image" class="imaged w24">
                    <strong>APINS</strong>
                    <span><?=TanggalIndo(date('Y-m-d'));?></span>
                </div>
                <a href="#" class="close-button">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="notification-content">
                <div class="in">
                    <h3 class="subtitle">Login Berhasil</h3>
                    <div class="text">
                        Login Sukses!! <br/>
                        Anda akan dialihkan ke halaman Siswa.
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div id="notification-error" class="notification-box">
        <div class="notification-dialog android-style">
            <div class="notification-header">
                <div class="in">
                    <img src="<?=base_url();?>assets/img/icon/72x72.png" alt="image" class="imaged w24">
                    <strong>APINS</strong>
                    <span><?=TanggalIndo(date('Y-m-d'));?></span>
                </div>
                <a href="#" class="close-button">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="notification-content">
                <div class="in">
                    <h3 class="subtitle">Error!</h3>
                    <div class="text">
                        Username atau Password tidak boleh kosong
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div id="notification-errors" class="notification-box">
        <div class="notification-dialog android-style">
            <div class="notification-header">
                <div class="in">
                    <img src="<?=base_url();?>assets/img/icon/72x72.png" alt="image" class="imaged w24">
                    <strong>APINS</strong>
                    <span><?=TanggalIndo(date('Y-m-d'));?></span>
                </div>
                <a href="#" class="close-button">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="notification-content">
                <div class="in">
                    <h3 class="subtitle">Error!</h3>
                    <div class="text" id="pesan">
                        Terjadi Kesalahan sistem
						silahkan dicoba beberapa saat lagi.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="<?=base_url();?>assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="<?=base_url();?>assets/js/lib/popper.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?=base_url();?>assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?=base_url();?>assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="<?=base_url();?>assets/js/base.js"></script>
	<script src="<?=base_url();?>auth/login.js"></script>
  <script>
$(document).ready(function () {
    setTimeout(() => {
        $(".pageLoader").fadeToggle(200);
    }, 1000); // hide delay when page load
    
});
</script>
</body>
</html>