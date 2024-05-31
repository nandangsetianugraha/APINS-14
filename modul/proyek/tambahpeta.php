<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$proyek=$_POST['proyek'];
	$dimensi=$_POST['dimensi'];
	$sub_elemen=$_POST['sub_elemen'];
	if(empty($proyek) || empty($dimensi) || empty($sub_elemen)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from pemetaan_proyek where proyek='$proyek' and dimensi='$dimensi' and elemen='$sub_elemen'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Peta Proyek sudah dipetakan, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into pemetaan_proyek(proyek,dimensi,elemen) values('$proyek','$dimensi','$sub_elemen')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Pemetaan Proyek berhasil dilakukan";		
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