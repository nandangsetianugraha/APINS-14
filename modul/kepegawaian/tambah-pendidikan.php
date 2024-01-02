<?php 
require_once '../../config/db_connect.php';
//if form is submitted

if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$idptk=$_POST['idptk'];
	$jenjang=$_POST['jenjang'];
	$satuan=strip_tags($connect->real_escape_string($_POST['satuan']));
	$fakultas=strip_tags($connect->real_escape_string($_POST['fakultas']));
	$masuk=strip_tags($connect->real_escape_string($_POST['masuk']));
	$keluar=strip_tags($connect->real_escape_string($_POST['keluar']));
	
	if(empty($satuan) || empty($masuk) || empty($keluar)){
		$validator['success'] = false;
		$validator['messages'] = "Data Isian tidak boleh kosong!";
	}else{
		$cek=$connect->query("select * from riwayat_pendidikan where ptk_id='$idptk' and jenjang='$jenjang'")->num_rows;
		if($cek>0){
			$validator['success'] = false;
			$validator['messages'] = "Jenjang Pendidikan sudah ada!";
		}else{
			$sql1 = "INSERT INTO riwayat_pendidikan(ptk_id,jenjang,nama_jenjang,fakultas,tahun_masuk,tahun_keluar) VALUES('$idptk','$jenjang','$satuan','$fakultas','$masuk','$keluar')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Riwayat Pendidikan berhasil dilakukan!";	
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