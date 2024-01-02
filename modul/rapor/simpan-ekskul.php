<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['idpd'];
	$ide=$_POST['ide'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$ket=$connect->real_escape_string($_POST['keterangan']);
	if(empty($ket) || empty($id)){
		$validator['success'] = false;
		$validator['messages'] = "Keterangan tidak boleh kosong";
	}else{
		$cek=$connect->query("SELECT * FROM data_ekskul WHERE peserta_didik_id='$id' and smt='$smt' and tapel='$tapel' and id_ekskul='$ide' order by id_ekskul asc")->num_rows;
		if($cek>0){
			$validator['success'] = false;
			$validator['messages'] = "Data Ekskul Sudah ada, Hapus dulu datanya baru tambahkan lagi";
		}else{
			$sql1 = "INSERT INTO data_ekskul(peserta_didik_id, smt, tapel,id_ekskul, keterangan) VALUES('$id','$smt','$tapel','$ide','$ket')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Kegiatan Ekstrakurikuler berhasil ditambahkan!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}