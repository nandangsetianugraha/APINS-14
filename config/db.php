<?php
require_once "db_connect.php";

$koneksi = mysqli_connect($host, $username, $password, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
};
$cekconfig=mysqli_query($koneksi, "select * from konfigurasi");
$cfg=mysqli_fetch_array($cekconfig);
$tapel_aktif=$cfg['tapel'];
$smt_aktif=$cfg['semester'];
?>