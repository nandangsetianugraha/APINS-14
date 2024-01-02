<?php
session_start();
$ptkid=$_SESSION['userid'];
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
include_once("../../config/db_connect.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$jenis=$_REQUEST['jenis'];
$ab=$_REQUEST['kelas'];
$nilai=$_REQUEST['nilai'];
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
    
        
        $ada = $connect->query("select * from nsp where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND jns='$jenis'")->num_rows;
        if ($ada>0){
			$utt=$connect->query("select * from nsp where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND jns='$jenis'")->fetch_assoc();
        	$idn=$utt['idNH'];
        	$sql = "UPDATE nsp SET nilai='$nilai' WHERE idNH='$idn'";
        }else{
        	$sql = "INSERT INTO nsp(id_pd, kelas, smt, tapel, jns, nilai) VALUES('$idp','$ab','$smt','$tapel','$jenis', '$nilai')";
        };
		$query1 = $connect->query($sql);
        echo "saved";
    
?>