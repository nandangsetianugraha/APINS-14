<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
if($_POST) {
	$validator = array('success' => false, 'messages' => array());
	$idartikel = $_POST['idartikel'];
	//$slug = $_POST['slug'];
	$tanggal=$_POST['tanggal'];
	$isi = $_POST['content'];
	$judul = strip_tags($connect->real_escape_string($_POST['judul']));
	$sqls = "UPDATE pengumuman SET waktu='$tanggal',judul='$judul',berita='$isi' where id='$idartikel'";
	$query1 = $connect->query($sqls);
	if($query1 === TRUE) {	
		$validator['success'] = true;
		$validator['messages'] = "Pengumuman berhasil diubah!";			  
	}else{
		$validator['success'] = false;
		$validator['messages'] = "Ada kesalahan sistem";		 
	}
	$connect->close();
	echo json_encode($validator);
}