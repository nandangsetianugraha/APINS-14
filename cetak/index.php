<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
$request  = $_SERVER['REQUEST_URI'];
$params     = explode("/", $request);
$halaman = $params[3];
$tipe = count($params)>4 ? $params[4] : '';
$act = count($params)>5 ? $params[5] : '';

	if( file_exists($halaman . '.php') ) {
		include $halaman . '.php';
	}else{
		echo $halaman;
	}

?>