<?php 
require_once '../../config/db_connect.php';
//if form is submitted

if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$idptk=$_POST['idptk'];
	$jenjang=$_POST['jenjang'];
	$jk=$_POST['jk'];
	$status=$_POST['status'];
	$tanggal=$_POST['tanggal'];
	$nama_anak=strip_tags($connect->real_escape_string($_POST['nama_anak']));
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$nisn=strip_tags($connect->real_escape_string($_POST['nisn']));
	$masuk=strip_tags($connect->real_escape_string($_POST['masuk']));
	
	if(empty($nama_anak) || empty($tempat) || empty($tanggal)){
		$validator['success'] = false;
		$validator['messages'] = "Data Isian tidak boleh kosong!";
	}else{
		$cek=$connect->query("select * from anak where ptk_id='$idptk' and nama='$nama_anak'")->num_rows;
		if($cek>0){
			$validator['success'] = false;
			$validator['messages'] = "Nama Anak sudah ada!";
		}else{
			$sql1 = "INSERT INTO anak(ptk_id,nama,status,jenjang,nisn,jk,tempat_lahir,tanggal_lahir,tahun_masuk) VALUES('$idptk','$nama_anak','$status','$jenjang','$nisn','$jk','$tempat','$tanggal','$masuk')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Anak berhasil dilakukan!";	
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kesalahan Query Sistem";
			};
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}