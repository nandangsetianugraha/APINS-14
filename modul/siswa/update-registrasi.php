<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['ptkid'];
	$jns_daftar=$_POST['jns'];
	$jns_mutasi=$_POST['statuss'];
	$tanggalmasuk=$_POST['tanggalmasuk'];
	$tanggalmutasi=$_POST['tanggalmutasi'];
	$asaltk=strip_tags($connect->real_escape_string($_POST['asaltk']));
	$asalra=strip_tags($connect->real_escape_string($_POST['asalra']));
	$alasan=strip_tags($connect->real_escape_string($_POST['alasan']));
	$noijazah=strip_tags($connect->real_escape_string($_POST['ijazah']));
	$noskhun=strip_tags($connect->real_escape_string($_POST['skhun']));
	if(empty($jns_daftar) || empty($jns_mutasi)){
		$validator['success'] = false;
		$validator['messages'] = "Jenis Pendaftaran dan Status Keaktifan tidak boleh kosong!";
	}else{
		$cekreg = $connect->query("select * from data_register where peserta_didik_id='$ids'")->num_rows;
		if($cekreg>0){
			$sql1 = "UPDATE data_register SET jns_daftar='$jns_daftar', tgl_masuk='$tanggalmasuk', asal_tk='$asaltk', asal_ra='$asalra', mutasi='$jns_mutasi', tgl_mutasi='$tanggalmutasi', alasan='$alasan', ijazah='$noijazah', skhun='$noskhun' WHERE peserta_didik_id='$ids'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Registrasi berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		}else{
			$sql1 = "INSERT INTO data_register(peserta_didik_id,jns_daftar,tgl_masuk,asal_tk,asal_ra,mutasi,tgl_mutasi,alasan,ijazah,skhun) VALUES('$ids','$jns_daftar','$tanggalmasuk','$asaltk','$asalra','$jns_mutasi','$tanggalmutasi','$alasan','$noijazah','$noskhun')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Register berhasil dibuat!";		
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