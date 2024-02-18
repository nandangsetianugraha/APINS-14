	
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Error</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
	
	<!-- App Capsule -->
    <div id="appCapsule">
        <!-- konten -->
		<div class="error-page">
            <div class="mb-2">
                <img src="<?=base_url();?>siswa/assets/img/404.png" alt="alt" class="imaged square w200">
            </div>
            <h1 class="title">Error</h1>
            <div class="text mb-3">
                Halaman tidak ditemukan!
            </div>
            <div id="countDown" class="mb-5"></div>

            <div class="fixed-footer">
                <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url();?>siswa/" class="btn btn-primary btn-lg btn-block">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
		<!-- konten -->
    </div>
    <!-- * App Capsule -->
    
    <!-- App Sidebar -->
    <?php include "layout/app-sidebar.php";?>
	<!-- * App Sidebar -->
    
	<!-- ///////////// Js Files ////////////////////  -->
    <?php include "layout/javascript.php";?>
	
	<!-- ////////////////////////////////////////////////////////// -->
    <!-- only for under construction page -->
    <!-- jQuery Countdown -->
    <script src="<?=base_url();?>assets/js/plugins/jquery-countdown/jquery.countdown.min.js"></script>
    <!-- jQuery Countdown Settings -->
    <script>
        var date = "2023/12/20"; 
        $('#countDown').countdown(date, function (event) {
            $(this).html(event.strftime(
                '<div>%D<span>Days</span></div>'
                +
                '<div>%H<span>Hours</span></div>'
                +
                '<div>%M<span>Minutes</span></div>'
                +
                '<div>%S<span>Seconds</span></div>'
            ));
        });
    </script>
    <!-- ////////////////////////////////////////////////////////// -->
   