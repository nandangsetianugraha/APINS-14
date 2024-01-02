<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$tanggal1=$_POST['tanggal1'];
	$tanggal2=$_POST['tanggal2'];
	$jam1=$_POST['jam1'];
	$jam2=$_POST['jam2'];
	//$keterangan=strip_tags($connect->real_escape_string($_POST['keterangan']));
	if(empty($tanggal1) || empty($tanggal2) || empty($jam1) || empty($jam2)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from shift where tanggal_awal='$tanggal1' and tanggal_akhir='$tanggal2'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Jam Kerja sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into shift(tanggal_awal, tanggal_akhir, masuk, keluar) values('$tanggal1','$tanggal2','$jam1','$jam2')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Jam Kerja berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}