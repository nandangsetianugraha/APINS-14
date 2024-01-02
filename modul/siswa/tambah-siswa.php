<?php 

include("../../config/db_connect.php");
function random($panjang)
{
   $karakter = 'abcdefghijklmnopqrstuvwxyz1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($karakter)-1);
   $string .= $karakter{$pos};
   }
    return $string;
};
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$nis=strip_tags($connect->real_escape_string($_POST['nis']));
	$nisn=strip_tags($connect->real_escape_string($_POST['nisn']));
	$nama=strip_tags($connect->real_escape_string($_POST['nama']));
	$jk=$_POST['jk'];
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$tanggal=$_POST['tanggal'];
	$nik=strip_tags($connect->real_escape_string($_POST['nik']));
	$agama=$_POST['agama'];
	$no_wa=$_POST['no_wa'];
	$pend=strip_tags($connect->real_escape_string($_POST['pend_seb']));
	$alamat=strip_tags($connect->real_escape_string($_POST['alamat']));
	$ayah=strip_tags($connect->real_escape_string($_POST['ayah']));
	$ibu=strip_tags($connect->real_escape_string($_POST['ibu']));
	$pek_ayah=$_POST['pek_ayah'];
	$pek_ibu=$_POST['pek_ibu'];
	//$=$_POST[''];
	//$=$_POST[''];
	$jalan=strip_tags($connect->real_escape_string($_POST['jalan']));
	$kelurahan=$_POST['kelurahan'];
	$kecamatan=$_POST['kecamatan'];
	$kabupaten=$_POST['kabupaten'];
	$provinsi=$_POST['provinsi'];
	$id_pd1=random(8);
	$id_pd2=random(4);
	$id_pd3=random(4);
	$id_pd4=random(4);
	$id_pd5=random(12);
	$id_pd=$id_pd1.'-'.$id_pd2.'-'.$id_pd3.'-'.$id_pd4.'-'.$id_pd5;
	if(empty($nama) || empty($tanggal)){
		$validator['success'] = false;
		$validator['messages'] = "Nama dan tanggal lahir tidak boleh kosong!";
	}else{
			$sql1 = "INSERT INTO siswa(peserta_didik_id,nis,nisn,nama,jk,tempat,tanggal,nik,agama,pend_sebelum,alamat,nama_ayah,nama_ibu,no_wa,pek_ayah,pek_ibu,jalan,kelurahan,kecamatan,kabupaten,provinsi,avatar,status,nasabah_id) VALUES('$id_pd','$nis','$nisn','$nama','$jk','$tempat','$tanggal','$nik','$agama','$pend','$alamat','$ayah','$ibu','$no_wa','$pek_ayah','$pek_ibu','$jalan','$kelurahan','$kecamatan','$kabupaten','$provinsi','avatar.png','1','0')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Siswa atas nama $nama berhasil!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Ada yang error nih???";
			};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}