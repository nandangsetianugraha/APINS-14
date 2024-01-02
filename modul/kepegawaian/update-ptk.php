<?php 
require_once '../../config/db_connect.php';
function random($panjang){
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
	$idptk=strip_tags($connect->real_escape_string($_POST['ptkid']));
	$nama=strip_tags($connect->real_escape_string($_POST['nama']));
	$gelar=strip_tags($connect->real_escape_string($_POST['gelar']));
	$jk=$_POST['jeniskelamin'];
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$tanggal=$_POST['tanggal'];
	$nik=strip_tags($connect->real_escape_string($_POST['nik']));
	$niy=strip_tags($connect->real_escape_string($_POST['niynigk']));
	$nuptk=strip_tags($connect->real_escape_string($_POST['nuptk']));
	$alamat=strip_tags($connect->real_escape_string($_POST['alamat']));
	$email=strip_tags($connect->real_escape_string($_POST['email']));
	$hp=strip_tags($connect->real_escape_string($_POST['noHP']));
	$statuspeg=$_POST['statuspegawai'];
	$jenispeg=$_POST['jenispegawai'];
	$sql = "select * from jenis_ptk where jenis_ptk_id='$jenispeg'";
	$query = $connect->query($sql);
	$cks = $query->fetch_assoc();
	$jnsptk=$cks['jenis_ptk'];
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
		$sql1 = "INSERT INTO ptk(ptk_id,nama,gelar,jenis_kelamin,tempat_lahir,tanggal_lahir,nik,niy_nigk,nuptk,status_kepegawaian_id,jenis_ptk_id,alamat_jalan,no_hp,email,status_keaktifan_id,gambar,nasabah_id) VALUES('$id_pd','$nama','$gelar','$jk','$tempat','$tanggal','$nik','$niy','$nuptk','$statuspeg','$jenispeg','$alamat','$hp','$email','1','user-default.png','0')";
      	$query1 = $connect->query($sql1);
		if($query1 === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Penambahan PTK berhasil dilakukan!";	
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Kesalahan Query Sistem";
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}