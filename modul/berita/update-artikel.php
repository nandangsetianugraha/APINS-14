<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
if($_POST) {
	$validator = array('success' => false, 'messages' => array());
	$idartikel = $_POST['idartikel'];
	//$slug = $_POST['slug'];
	$penulis = $_POST['penulis'];
	$tanggal=$_POST['tanggal'];
	$isi = $_POST['content'];
	$judul = strip_tags($connect->real_escape_string($_POST['judul']));
	$slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
	$sqls = "UPDATE berita SET tanggal='$tanggal',judul='$judul',slug='$slug',isi='$isi' where id='$idartikel'";
	$query1 = $connect->query($sqls);
	if($query1 === TRUE) {	
		$validator['success'] = true;
		$validator['messages'] = "Artikel berhasil diubah!";			  
	}else{
		$validator['success'] = false;
		$validator['messages'] = "Ada kesalahan sistem";		 
	}
	$connect->close();
	echo json_encode($validator);
}