<?php
include("../../config/db.php");
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];

$sql2 = "select * from rombel where nama_rombel='$kelas' and tapel='$tapel' and smt='$smt'";
$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
$cek=mysqli_num_rows($qu3);

	$po=mysqli_fetch_array($qu3);
	$idpeng1=$po['pendamping'];
	if($idpeng1===''){
	}else{
	$peng1=mysqli_fetch_array(mysqli_query($koneksi,"select * from ptk where ptk_id='$idpeng1'"));
	if($peng1['gelar']===''){
		echo $peng1['nama'];	
	}else{
		echo $peng1['nama'].', '.$peng1['gelar'];
	}
	}
?>