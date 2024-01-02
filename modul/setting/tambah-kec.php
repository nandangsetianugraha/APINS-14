<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id_prov=strip_tags($connect->real_escape_string($_POST['id_prov']));
	$id_kab=strip_tags($connect->real_escape_string($_POST['id_kab']));
	$id_kec=strip_tags($connect->real_escape_string($_POST['id_kec']));
	$nama_kec=strip_tags($connect->real_escape_string($_POST['nama_kec']));
	if(empty($nama_kec) or empty($id_kec)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from kecamatan where id='$id_kec' and id_kabupaten='$id_kab'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode Kecamatan sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into kecamatan(id,id_kabupaten,nama) values('$id_kec','$id_kab','$nama_kec')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Kecamatan berhasil dilakukan";		
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