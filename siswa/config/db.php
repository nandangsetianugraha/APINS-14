<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "penilaian";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
};
$cekconfig=mysqli_query($koneksi, "select * from konfigurasi");
$cfg=mysqli_fetch_array($cekconfig);
$tapel_aktif=$cfg['tapel'];
$smt_aktif=$cfg['semester'];
?>