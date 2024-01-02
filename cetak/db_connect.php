<?php 
$host = "localhost"; // Host name
$username = "admin_nilai"; // Mysql username
$password = "M@ikawasumi79"; // Mysql password
$db_name = "admin_nilai"; // Database name

// create connection
$connect = new mysqli($host, $username, $password, $db_name);

// check connection 
if($connect->connect_error) {
	die("Connection Failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
};
$sql = "select * from konfigurasi";
$cekconfig = $connect->query($sql);
$cfg=$cekconfig->fetch_assoc();
$tapel_aktif=$cfg['tapel'];
$smt_aktif=$cfg['semester'];
$maintenis=$cfg['maintenis'];
$versi=$cfg['versi'];
