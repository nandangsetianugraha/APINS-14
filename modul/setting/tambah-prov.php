<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id_prov=strip_tags($connect->real_escape_string($_POST['id_prov']));
	$nama_prov=strip_tags($connect->real_escape_string($_POST['nama_prov']));
	if(empty($nama_prov) or empty($id_prov)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from provinsi where id_prov='$id_prov'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode Provinsi sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into provinsi(id_prov,nama) values('$id_prov','$nama_prov')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Provinsi berhasil dilakukan";		
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