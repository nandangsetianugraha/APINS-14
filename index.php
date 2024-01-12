<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
$request  = $_SERVER['REQUEST_URI'];
$params     = explode("/", $request);
$halaman = $params[1];
$tipe = count($params)>2 ? $params[2] : '';
$act = count($params)>3 ? $params[3] : '';
include 'config/config.php';
include 'config/db_connect.php';
include 'config/versi.php';
if (!isset($_SESSION['userid'])) {
	if($halaman==="lupa-password"){
		include "pages/lupa-password.php";
	}elseif($halaman==="otp"){
		include "pages/otp.php";
	}else{
		include "pages/login.php";
	}
}else{
  	include 'config/session.php';
  	$kurikulum=$_SESSION['kurikulum'];
	if($halaman==="" or $halaman==="beranda"){
		include "pages/home.php";
	}else{
		if($maintenis==1 and $level<>11){
			include "pages/perawatan.php";
		}else{
			if($norombel){
				include "pages/norombel.php";
			}else{
				if( file_exists('pages/' . $halaman . '.php') ) {
					include 'pages/' . $halaman . '.php';
				}else{
					include "pages/error.php";
				}
			}
		}
	}
}
?>
