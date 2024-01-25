<?php 
require_once '../../config/db_connect.php';
//if form is submitted

if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$idptk=$_POST['idptk'];
	$tanggal=$_POST['tanggal'];
	$jenis=strip_tags($connect->real_escape_string($_POST['jenis']));
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$tipe=strip_tags($connect->real_escape_string($_POST['tipe']));
	$dosis=strip_tags($connect->real_escape_string($_POST['dosis']));
	
	if(empty($tanggal) || empty($jenis) || empty($tempat) || empty($tipe)){
		$validator['success'] = false;
		$validator['messages'] = "Data Isian tidak boleh kosong!";
	}else{
		$sql1 = "INSERT INTO data_kemenkes(peserta_didik_id,jenis,tanggal,tempat,tipe,dosis) VALUES('$idptk','$jenis','$tanggal','$tempat','$tipe','$dosis')";
		$query1 = $connect->query($sql1);
		if($query1 === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Penambahan Data Kemenkes berhasil dilakukan!";	
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Kesalahan Query Sistem";
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}