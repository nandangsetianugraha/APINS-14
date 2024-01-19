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
	
	$idp=$_POST['idsiswa'];
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$siswa=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$namas=$siswa['nama'];
	if(empty($idp) || empty($kelas)){
		$validator['success'] = false;
		$validator['messages'] = "Harus diisi datanya!";
	}else{
		$sql1 = "INSERT INTO penempatan(peserta_didik_id,nama,rombel,tapel,smt) VALUES('$idp','$namas','$kelas','$tapel','$smt')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penempatan $namas ke Rombel $kelas berhasil!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Ada yang error nih???";
			};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}