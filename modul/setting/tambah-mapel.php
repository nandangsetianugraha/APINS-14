<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$jns=strip_tags($connect->real_escape_string($_POST['jns']));
	$mapel=strip_tags($connect->real_escape_string($_POST['mapel']));
	$kd_mapel=strip_tags($connect->real_escape_string($_POST['kd_mapel']));
	if(empty($kd_mapel) or empty($mapel)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		if($jns=='k13'){
			$sql = "select * from mapel where kd_mapel='$kd_mapel' and nama_mapel='$mapel'";
		}elseif($jns=='km'){
			$sql = "select * from mata_pelajaran where kd_mapel='$kd_mapel' and nama_mapel='$mapel'";
		}elseif($jns=='dta'){
			$sql = "select * from mapel_dta where kd_mapel='$kd_mapel' and nama_mapel='$mapel'";
		}else{
			$sql = "select * from mapel where kd_mapel='$kd_mapel' and nama_mapel='$mapel'";
		};
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode Mapel sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			if($jns=='k13'){
				$sql1 = "insert into mapel(kd_mapel,nama_mapel) values('$kd_mapel','$mapel')";
			}elseif($jns=='km'){
				$sql1 = "insert into mata_pelajaran(kd_mapel,nama_mapel) values('$kd_mapel','$mapel')";
			}elseif($jns=='dta'){
				$sql1 = "insert into mapel_dta(kd_mapel,nama_mapel) values('$kd_mapel','$mapel')";
			}else{
				$sql1 = "insert into mapel(kd_mapel,nama_mapel) values('$kd_mapel','$mapel')";
			};
			//$sql1 = "insert into desa(id,id_kecamatan,nama) values('$id_desa','$id_kec','$nama_desa')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Mata pelajaran berhasil dilakukan";		
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