<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['ptkid'];
	$jns_daftar=$_POST['jns'];
	$jns_mutasi=$_POST['statuss'];
	$tanggalmasuk=$_POST['tanggalmasuk'];
	$noakta=strip_tags($connect->real_escape_string($_POST['noakta']));
	$nokk=strip_tags($connect->real_escape_string($_POST['nokk']));
	$lintang=strip_tags($connect->real_escape_string($_POST['lintang']));
	$bujur=strip_tags($connect->real_escape_string($_POST['bujur']));
	
		$cekreg = $connect->query("select * from data_register where peserta_didik_id='$ids'")->num_rows;
		if($cekreg>0){
			$sql1 = "UPDATE data_register SET jns_daftar='$jns_daftar', tgl_masuk='$tanggalmasuk', jns_mutasi='$jns_mutasi', noakta='$noakta', nokk='$nokk', lintang='$lintang', bujur='$bujur' WHERE peserta_didik_id='$ids'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Registrasi berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		}else{
			$sql1 = "INSERT INTO data_register(peserta_didik_id,jns_daftar,tgl_masuk,jns_mutasi,noakta,nokk,lintang,bujur) VALUES('$ids','$jns_daftar','$tanggalmasuk','$jns_mutasi','$noakta','$nokk','$lintang','$bujur')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Register berhasil dibuat!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		}
	
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}