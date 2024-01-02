<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['idpd'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$sakit=$connect->real_escape_string($_POST['sakit']);
	$ijin=$connect->real_escape_string($_POST['ijin']);
	$alfa=$connect->real_escape_string($_POST['alfa']);
	if(empty($id)){
		$validator['success'] = false;
		$validator['messages'] = "Keterangan tidak boleh kosong";
	}else{
		$cek=$connect->query("SELECT * FROM data_absensi WHERE peserta_didik_id='$id' and smt='$smt' and tapel='$tapel'")->num_rows;
		if($cek>0){
			$idr=$connect->query("SELECT * FROM data_absensi WHERE peserta_didik_id='$id' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
			$idrp=$idr['id'];
			$sql1 = "UPDATE data_absensi set sakit='$sakit', ijin='$ijin', alfa='$alfa' WHERE id='$idrp'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Absensi berhasil diupdate!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error update Data Absensi???";
			};
		}else{
			$sql1 = "INSERT INTO data_absensi(peserta_didik_id,smt,tapel,sakit,ijin,alfa) VALUES('$id','$smt','$tapel','$sakit','$ijin','$alfa')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Absen berhasil ditambahkan!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		}
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}