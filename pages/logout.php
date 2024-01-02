<?php
	include_once("../config/config.php");
	include_once("../config/db_connect.php");
    session_start();
	$aktiv='Keluar dari Sistem';
	$ptkid=$_SESSION['userid'];
	date_default_timezone_set('Asia/Jakarta');
	$waktu=date('Y-m-d H:i:s');
	$sql2 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
	$query1 = $connect->query($sql2);
    session_destroy();
    header("location:../");
