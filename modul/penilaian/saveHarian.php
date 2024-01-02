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
$tema=$_REQUEST['tema'];
$kd=$_REQUEST['kd'];
$jns=$_REQUEST['jns'];
$output = array('success' => false, 'messages' => array());
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
$pelajaran=$connect->query("select * from mapel where id_mapel='$mpid'")->fetch_assoc();
if(is_numeric($nilai)){
    if($nilai>100){
		$output['success'] = false;
		$output['messages'] = 'Nilai diatas 100';
	}else{
        $cek="select * from nh where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and tema='$tema' and kd='$kd' and jns='$jns'";
        $ada = $connect->query($cek)->num_rows;
        if ($ada>0){
			$utt=$connect->query($cek)->fetch_assoc();
        	$idn=$utt['idNH'];
        	if($nilai==0 or empty($nilai)){
				$aktiv='Hapus Nilai Pengetahuan '.$pelajaran['kd_mapel'].' [Tema '.$tema.' KD '.$kd.'] atas nama '.$nama['nama'];
        		$sql="DELETE FROM nh WHERE idNH='$idn'";
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        	}else{ 
				$aktiv='Update Nilai Pengetahuan '.$pelajaran['kd_mapel'].' [Tema '.$tema.' KD '.$kd.'] atas nama '.$nama['nama'];
        		$sql = "UPDATE nh SET nilai='$nilai' WHERE idNH='$idn'";
				$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        	};
        }else{
        	$sql = "INSERT INTO nh(id_pd, kelas, smt, tapel, mapel, tema, kd, jns, nilai) VALUES('$idp','$ab','$smt','$tapel','$mpid','$tema','$kd','$jns','$nilai')";
			$aktiv='Input Nilai Pengetahuan '.$pelajaran['kd_mapel'].' [Tema '.$tema.' KD '.$kd.'] atas nama '.$nama['nama'];
			$sql1 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
        };
		$hasil1=$connect->query($sql);
		$hasil2=$connect->query($sql1);
        if($hasil1===true and $hasil2===true){
			$output['success'] = true;
			$output['messages'] = 'OK';
		}else{
			$output['success'] = false;
			$output['messages'] = 'Gagal';
		}
    };
}else{
	$output['success'] = false;
	$output['messages'] = 'Bukan Angka';
};
echo json_encode($output);