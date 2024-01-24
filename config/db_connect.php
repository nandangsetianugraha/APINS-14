<?php 
$host = "localhost"; // Host name
$username = "root"; // Mysql username
$password = ""; // Mysql password
$db_name = "apins"; // Database name

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
$cfg=$connect->query("select * from sekolah")->fetch_assoc();
$cfgs=$cekconfig->fetch_assoc();
$tapel_aktif=$cfgs['tapel'];
$smt_aktif=$cfgs['semester'];
$maintenis=$cfgs['maintenis'];
