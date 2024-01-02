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
$ab=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$lm=$_REQUEST['lm'];
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
$pelajaran=$connect->query("select * from mata_pelajaran where id_mapel='$mpid'")->fetch_assoc();
if(is_numeric($nilai)){
    if($nilai>100){}else{
        $hasil=$connect->query("select * from sumatif where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and lm='$lm'")->fetch_assoc();
        $ada = $connect->query("select * from sumatif where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and lm='$lm'")->num_rows;
        if ($ada>0){
			$utt=$connect->query("select * from sumatif where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and lm='$lm'")->fetch_assoc();
        	$idn=$utt['idNH'];
        	if($nilai==0 or $nilai=="" or empty($nilai)){
				$aktiv='Hapus Nilai Sumatif '.$pelajaran['kd_mapel'].' [Materi '.$lm.'] atas nama '.$nama['nama'];
        		$sql="DELETE FROM sumatif WHERE idNH='$idn'";
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        	}else{ 
				$aktiv='Update Nilai Sumatif '.$pelajaran['kd_mapel'].' [Materi '.$lm.'] atas nama '.$nama['nama'];
        		$sql = "UPDATE sumatif SET nilai='$nilai' WHERE idNH='$idn'";
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        	};
        }else{
        	$sql = "INSERT INTO sumatif(id_pd, kelas, smt, tapel, mapel, lm, nilai) VALUES('$idp','$ab','$smt','$tapel','$mpid','$lm','$nilai')";
			$aktiv='Input Nilai Sumatif '.$pelajaran['kd_mapel'].' [Materi '.$lm.'] atas nama '.$nama['nama'];
			$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        };
		$query1 = $connect->query($sql);
		$query2 = $connect->query($sql1);
        echo "saved";
    };
};
?>