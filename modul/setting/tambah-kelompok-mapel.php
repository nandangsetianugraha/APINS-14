<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
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
			$sql = "select * from kelompok_mapel where kurikulum='$jns' and kelompok='$kelompok' and urut='$urutan'";
			$query = $connect->query($sql);
			$cks = $query->fetch_assoc();
			$ada=$query->num_rows;
			if($ada>0){
				$validator['success'] = false;
				$validator['messages'] = "Kelompok Mapel sudah ada, silahkan hapus terlebih dahulu!";
			}else{
				$sql1 = "insert into kelompok_mapel(kurikulum,kelompok,urut) values('$jns','$kelompok','$urutan')";
				//$sql1 = "insert into desa(id,id_kecamatan,nama) values('$id_desa','$id_kec','$nama_desa')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Penambahan Kelompok Mata pelajaran berhasil dilakukan";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Error while adding the member information";
				};
			};
			
		};
	}
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}