<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$tema=$_POST['tema'];
	$fase=$_POST['fase'];
	$nproyek=strip_tags($connect->real_escape_string($_POST['n_proyek']));
	$dproyek=strip_tags($connect->real_escape_string($_POST['d_proyek']));
	if(empty($kelas) || empty($smt) || empty($tema) || empty($fase) || empty($nproyek) || empty($dproyek)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from data_proyek where kelas='$kelas' and smt='$smt' and tapel='$tapel'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Proyek sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into data_proyek(tema,fase,kelas,tapel,smt, nama_proyek,deskripsi_proyek) values('$tema','$fase','$kelas','$tapel','$smt','$nproyek','$dproyek')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Proyek berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error Saat menambahkan Proyek";
			};
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}