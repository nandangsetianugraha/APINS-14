<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=strip_tags($connect->real_escape_string($_POST['ids']));
	$jns=strip_tags($connect->real_escape_string($_POST['jns']));
	$kelompok=strip_tags($connect->real_escape_string($_POST['kelompok']));
	$urutan=strip_tags($connect->real_escape_string($_POST['urutan']));
	if(!is_numeric($urutan)){
		$validator['success'] = false;
		$validator['messages'] = "Urutan harus berupa angka";
	}else{
		if(empty($jns) or empty($urutan) or empty($kelompok)){
			$validator['success'] = false;
			$validator['messages'] = "Tidak Boleh Kosong Datanya!";
		}else{
				$sql1 = "update kelompok_mapel set kelompok='$kelompok', urut='$urutan' where id_kelompok='$ids'";
				//$sql1 = "insert into desa(id,id_kecamatan,nama) values('$id_desa','$id_kec','$nama_desa')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Update Kelompok Mata pelajaran berhasil dilakukan";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Error while adding the member information";
				};
			
		};
	}
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}