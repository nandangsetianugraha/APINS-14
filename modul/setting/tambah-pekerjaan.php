<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$kd_pek=strip_tags($connect->real_escape_string($_POST['kd_pek']));
	$pek=strip_tags($connect->real_escape_string($_POST['pek']));
	if(empty($kd_pek) or empty($pek)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from pekerjaan where id_pekerjaan='$kd_pek'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode Pekerjaan sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into pekerjaan(id_pekerjaan,nama_pekerjaan) values('$kd_pek','$pek')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Pekerjaan berhasil dilakukan";		
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