<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id_prov=strip_tags($connect->real_escape_string($_POST['id_prov']));
	$id_kab=strip_tags($connect->real_escape_string($_POST['id_kab']));
	$id_kec=strip_tags($connect->real_escape_string($_POST['id_kec']));
	$id_desa=strip_tags($connect->real_escape_string($_POST['id_desa']));
	$nama_desa=strip_tags($connect->real_escape_string($_POST['nama_desa']));
	if(empty($nama_desa) or empty($id_desa)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from desa where id='$id_desa' and id_kecamatan='$id_kec'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode Desa sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into desa(id,id_kecamatan,nama) values('$id_desa','$id_kec','$nama_desa')";
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