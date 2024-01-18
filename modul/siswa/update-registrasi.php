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
	$noakta=strip_tags($connect->real_escape_string($_POST['noakta']));
	$nokk=strip_tags($connect->real_escape_string($_POST['nokk']));
	$lintang=strip_tags($connect->real_escape_string($_POST['lintang']));
	$bujur=strip_tags($connect->real_escape_string($_POST['bujur']));
	$alasan=strip_tags($connect->real_escape_string($_POST['alasan']));
	$sekolah_mutasi=strip_tags($connect->real_escape_string($_POST['sekolah_mutasi']));
	$nopes=strip_tags($connect->real_escape_string($_POST['nopes']));
	$noijazah=strip_tags($connect->real_escape_string($_POST['ijazah']));
	$noskhun=strip_tags($connect->real_escape_string($_POST['skhun']));
	if(empty($jns_daftar) || empty($jns_mutasi)){
		$validator['success'] = false;
		$validator['messages'] = "Jenis Pendaftaran dan Status Keaktifan tidak boleh kosong!";
	}else{
		$cekreg = $connect->query("select * from data_register where peserta_didik_id='$ids'")->num_rows;
		if($cekreg>0){
			$sql1 = "UPDATE data_register SET jns_daftar='$jns_daftar', tgl_masuk='$tanggalmasuk', jns_mutasi='$jns_mutasi', tgl_mutasi='$tanggalmutasi', noakta='$noakta', nokk='$nokk', lintang='$lintang', bujur='$bujur', alasan='$alasan', sekolah_mutasi='$sekolah_mutasi', nopes='$nopes', ijazah='$noijazah', skhun='$noskhun' WHERE peserta_didik_id='$ids'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Registrasi berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		}else{
			$sql1 = "INSERT INTO data_register(peserta_didik_id,jns_daftar,tgl_masuk,jns_mutasi,tgl_mutasi,noakta,nokk,lintang,bujur,alasan,sekolah_mutasi,nopes,ijazah,skhun) VALUES('$ids','$jns_daftar','$tanggalmasuk','$jns_mutasi','$tanggalmutasi','$noakta','$nokk','$lintang','$bujur','$alasan','$sekolah_mutasi','$nopes','$noijazah','$noskhun')";
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