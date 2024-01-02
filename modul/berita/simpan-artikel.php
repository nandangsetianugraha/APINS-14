<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
if($_POST) {
	$validator = array('success' => false, 'messages' => array());
	$penulis = $_POST['penulis'];
	$tanggal=$_POST['tanggal'];
	$isi = $_POST['content'];
	$judul = strip_tags($connect->real_escape_string($_POST['judul']));
	$slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
	$cek = $connect->query("select * from berita where slug='$slug'")->num_rows;
	if($cek>0){
		$validator['success'] = false;
		$validator['messages'] = "Judul berita sudah ada! silahkan hapus judul berita yang lama.";
	}else{
		$sqls = "INSERT INTO berita(penulis,tanggal,judul,slug,isi,images,view) VALUES('$penulis','$tanggal','$judul','$slug','$isi','https://sdi-aljannah.web.id/images/gallery/default.png','0')";
		$query1 = $connect->query($sqls);
		if($query1 === TRUE) {	
			$validator['success'] = true;
			$validator['messages'] = "Artikel berhasil dibuat!";			  
		}else{
			$validator['success'] = false;
			$validator['messages'] = "Ada kesalahan sistem";		 
		}
	}
	$connect->close();
	echo json_encode($validator);
}