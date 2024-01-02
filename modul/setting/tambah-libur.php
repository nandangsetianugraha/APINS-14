<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$tanggal1=$_POST['tanggal_awal'];
	$tanggal2=$_POST['tanggal_akhir'];
	$keterangan=strip_tags($connect->real_escape_string($_POST['keterangan']));
	if(empty($tanggal1) || empty($tanggal2) || empty($keterangan)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from harilibur where tanggal_awal='$tanggal1' and tanggal_akhir='$tanggal2' and keterangan='$keterangan'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Hari Libur sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into harilibur(tanggal_awal,tanggal_akhir, keterangan) values('$tanggal1','$tanggal2','$keterangan')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Hari Libur berhasil dilakukan";		
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