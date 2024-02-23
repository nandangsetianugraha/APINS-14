<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
$request  = $_SERVER['REQUEST_URI'];
$params     = explode("/", $request);
$halaman = $params[2];
$tipe = count($params)>3 ? $params[3] : '';
$act = count($params)>4 ? $params[4] : '';
include "config/config.php";
include "config/db_connect.php";
if (is_user_login()==false) {
    header("location:./auth");
	exit();
};
include 'config/session.php';
include "layout/head.php"; 
?>
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
<body>

    <!-- loader -->
    <div class="pageLoader">
        <div class="in">
            <div class="imgWrapper">
                <img src="assets/img/aljannah.png" alt="logo" class="itemlogo">
                <div class="spin">
                    <div class="spinner-border text-light" role="status"></div>
                </div>
            </div>
            <p>Loading...</p>
        </div>
    </div>
    <!-- * loader -->

    

    <input type="hidden" id="urls" value="<?=base_url();?>">
		<?php 
		if($halaman==="" or $halaman==="beranda"){
			include 'pages/home.php';
		}else{
			if( file_exists('pages/' . $halaman . '.php') ) {
				include 'pages/' . $halaman . '.php';
			}else{
				include "pages/error.php";
			}
		};
		?>
<script>
$(document).ready(function () {
    setTimeout(() => {
        $(".pageLoader").fadeToggle(200);
    }, 1000); // hide delay when page load
    
});
</script>
</body>

</html>