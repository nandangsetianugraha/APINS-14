<?php
session_start();
$ptkid=$_SESSION['userid'];
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
include_once("../../config/db_connect.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mpid=$_REQUEST['mp'];
$kelas=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
$pelajaran=$connect->query("select * from mapel_dta where id_mapel='$mpid'")->fetch_assoc();
if(is_numeric($nilai)){
    if($nilai>100){
    }else{
        $ada = $connect->query("select * from pas_dta where id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid'")->num_rows;
        if ($ada>0){
			$utt=$connect->query("select * from pas_dta where id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid'")->fetch_assoc();
        	$idn=$utt['idNH'];
        	if($nilai===0 or $nilai==="" or empty($nilai)){
				$aktiv='Hapus Nilai PAS DTA '.$pelajaran['kd_mapel'].'] atas nama '.$nama['nama'];
        		$sql="DELETE FROM pas_dta WHERE idNH='$idn'";
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        	}else{ 
				$aktiv='Update Nilai PAS DTA '.$pelajaran['kd_mapel'].' atas nama '.$nama['nama'];
        		$sql = "UPDATE pas_dta SET nilai='$nilai' WHERE idNH='$idn'";
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        	};
        }else{
        	$sql = "INSERT INTO pas_dta(id_pd, kelas, smt, tapel, mapel, nilai) VALUES('$idp','$kelas','$smt','$tapel','$mpid','$nilai')";
			$aktiv='Input Nilai PAS DTA ['.$pelajaran['kd_mapel'].'] atas nama '.$nama['nama'];
			$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        };
		$query1 = $connect->query($sql);
		$query2 = $connect->query($sql1);
        echo "saved";
    };
};
?>