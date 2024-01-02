<?php
session_start();
$ptkid=$_SESSION['userid'];
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
include_once("../../config/db.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mpid=$_REQUEST['mp'];
$ab=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$tema=$_REQUEST['tema'];
$kd=$_REQUEST['kd'];
$jns=$_REQUEST['jns'];
$cek="select * from nk where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and tema='$tema' and kd='$kd' and jns='$jns'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$nama=mysqli_fetch_array(mysqli_query($koneksi,"select * from siswa where peserta_didik_id='$idp'"));
$pelajaran=mysqli_fetch_array(mysqli_query($koneksi,"select * from mapel where id_mapel='$mpid'"));
if(is_numeric($nilai)){
    if($nilai>100){
		
	}else{
        if ($ada>0){
			$utt=mysqli_fetch_array($hasil);
			$idn=$utt['idNH'];
        	if($nilai==0 or $nilai==""){
        		$sql="DELETE FROM nk WHERE idNH='$idn'";
				mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
				$aktiv='Hapus Nilai Ketrampilan '.$pelajaran['kd_mapel'].' [Tema '.$tema.' KD '.$kd.'] atas nama '.$nama['nama'];
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
				mysqli_query($koneksi, $sql1) or die("database error:". mysqli_error($koneksi));
				echo "saved";
        	}else{ 
        		$sql = "UPDATE nk SET nilai='$nilai' WHERE idNH='$idn'";
				mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
				$aktiv='Update Nilai Ketrampilan '.$pelajaran['kd_mapel'].' [Tema '.$tema.' KD '.$kd.'] atas nama '.$nama['nama'];
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
				mysqli_query($koneksi, $sql1) or die("database error:". mysqli_error($koneksi));
				echo "saved";
        	};
        }else{
        	$sql = "INSERT INTO nk(id_pd, kelas, smt, tapel, mapel, tema, kd, jns, nilai) VALUES('$idp','$ab','$smt','$tapel','$mpid','$tema','$kd','$jns','$nilai')";
			mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
			$aktiv='Input Nilai Ketrampilan '.$pelajaran['kd_mapel'].' [Tema '.$tema.' KD '.$kd.'] atas nama '.$nama['nama'];
			$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
			mysqli_query($koneksi, $sql1) or die("database error:". mysqli_error($koneksi));
			echo "saved";
        };
        
    };
};
?>