<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$aspek=$_POST['aspek'];
	$mapel=$_POST['mapel'];
	$kd=strip_tags($connect->real_escape_string($_POST['kd']));
	$deskripsi=strip_tags($connect->real_escape_string($_POST['deskripsi']));
	if(empty($kelas) || empty($smt) || empty($kd) || empty($deskripsi)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from kd where kelas='$kelas' and aspek='$aspek' and mapel='$mapel' and kd='$kd'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "KD sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into kd(kelas, aspek, mapel, kd, nama_kd) values('$kelas','$aspek','$mapel','$kd','$deskripsi')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan KD berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the KD";
			};
		};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}