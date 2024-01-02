<?php
include_once("../../config/db.php");
$idp=$_REQUEST['id'];
$nilai=$_REQUEST['value'];
$kolom=$_REQUEST['column'];
$cek="select * from gajipokok where pegawai_id='$idp'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['id'];
	$sql = "UPDATE gajipokok SET $kolom='$nilai' WHERE id='$idn'";
}else{
	if($kolom=='insentif'){
		$sql = "INSERT INTO gajipokok(pegawai_id,insentif) VALUES('$idp','$nilai')";
	}elseif($kolom=='transport'){
		$sql = "INSERT INTO gajipokok(pegawai_id,transport) VALUES('$idp','$nilai')";
	}elseif($kolom=='tunj_walikelas'){
		$sql = "INSERT INTO gajipokok(pegawai_id,tunj_walikelas) VALUES('$idp','$nilai')";
	}elseif($kolom=='tunj_kepsek'){
		$sql = "INSERT INTO gajipokok(pegawai_id,tunj_kepsek) VALUES('$idp','$nilai')";
	}elseif($kolom=='tunj_kehadiran'){
		$sql = "INSERT INTO gajipokok(pegawai_id,tunj_kehadiran) VALUES('$idp','$nilai')";
	}else{
		$sql = "INSERT INTO gajipokok(pegawai_id,tunj_ekskul) VALUES('$idp','$nilai')";
	}
	
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>