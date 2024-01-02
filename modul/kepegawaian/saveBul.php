<?php
include_once("../../config/db.php");
$idp=$_REQUEST['id'];
$bln=$_REQUEST['bln'];
$thn=$_REQUEST['thn'];
$nilai=$_REQUEST['value'];
$kolom=$_REQUEST['column'];
$cek="select * from potongan_gaji where pegawai_id='$idp' and bulan='$bln' and tahun='$thn'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['id'];
	$sql = "UPDATE potongan_gaji SET $kolom='$nilai' WHERE id='$idn'";
}else{
	if($kolom=='hari'){
		$sql = "INSERT INTO potongan_gaji(pegawai_id,bulan,tahun,hari) VALUES('$idp','$bln','$thn','$nilai')";
	}elseif($kolom=='absen'){
		$sql = "INSERT INTO potongan_gaji(pegawai_id,bulan,tahun,absen) VALUES('$idp','$bln','$thn','$nilai')";
	}elseif($kolom=='ekskul'){
		$sql = "INSERT INTO potongan_gaji(pegawai_id,bulan,tahun,ekskul) VALUES('$idp','$bln','$thn','$nilai')";
	}elseif($kolom=='telat'){
		$sql = "INSERT INTO potongan_gaji(pegawai_id,bulan,tahun,telat) VALUES('$idp','$bln','$thn','$nilai')";
	}else{
		$sql = "INSERT INTO potongan_gaji(pegawai_id,bulan,tahun,cepat) VALUES('$idp','$bln','$thn','$nilai')";
	};
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>