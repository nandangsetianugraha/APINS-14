<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$penilaian=$_POST['penilaian'];
	$kelas=$_POST['kelas'];
	$tapel=$_POST['tapel'];
	$smt=$_POST['smt'];
	$tanggal=$_POST['tanggal'];
	$awal=$_POST['jam1'];
	$akhir=$_POST['jam2'];
	$absen=$_POST['jum_absen'];
	$nomorabsen=strip_tags($connect->real_escape_string($_POST['nomor_absen']));
	//$mapel=$_POST['mapel'];
	$mapel=strip_tags($connect->real_escape_string($_POST['mapel']));
	$pengawas1=strip_tags($connect->real_escape_string($_POST['pengawas1']));
	$pengawas2=strip_tags($connect->real_escape_string($_POST['pengawas2']));
	$catatan=strip_tags($connect->real_escape_string($_POST['catatan']));
	if(empty($kelas) || empty($tanggal) || empty($awal) || empty($akhir)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from berita_acara where jenis='$penilaian' and tapel='$tapel' and smt='$smt' and kelas='$kelas' and mapel='$mapel'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "BAP Mapel Tersebut sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into berita_acara(tanggal,jenis,tapel,smt,kelas, mulai, selesai, mapel,pengawas1,pengawas2,absen,nomor_absen,catatan) values('$tanggal','$penilaian','$tapel','$smt','$kelas','$awal','$akhir','$mapel','$pengawas1','$pengawas2','$absen','$nomorabsen','$catatan')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan BAP berhasil dilakukan";		
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