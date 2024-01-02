<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id_prov=strip_tags($connect->real_escape_string($_POST['id_prov']));
	$id_kab=strip_tags($connect->real_escape_string($_POST['id_kab']));
	$nama_kab=strip_tags($connect->real_escape_string($_POST['nama_kab']));
	if(empty($nama_kab) or empty($id_kab)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from kabupaten where id='$id_kab' and id_provinsi='$id_prov'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode Kabupaten sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into kabupaten(id,id_provinsi,nama) values('$id_kab','$id_prov','$nama_kab')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Kabupaten berhasil dilakukan";		
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