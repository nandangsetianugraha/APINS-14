<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
if($_POST) {
	$validator = array('success' => false, 'messages' => array());
	$tanggal=$_POST['tanggal'];
	$isi = $_POST['content'];
	$judul = strip_tags($connect->real_escape_string($_POST['judul']));
	
		$sqls = "INSERT INTO pengumuman(waktu,judul,berita,tipe) VALUES('$tanggal','$judul','$isi','Pengumuman')";
		$query1 = $connect->query($sqls);
		if($query1 === TRUE) {	
			$validator['success'] = true;
			$validator['messages'] = "Pengumuman berhasil dibuat!";			  
		}else{
			$validator['success'] = false;
			$validator['messages'] = "Ada kesalahan sistem";		 
		}
	
	$connect->close();
	echo json_encode($validator);
}