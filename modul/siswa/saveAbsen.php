<?php
session_start();
$ptkid=$_SESSION['userid'];
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
require_once '../../config/db_connect.php';
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$absensi=$_REQUEST['absensi'];
$ab=$_REQUEST['kelas'];
$tgl=$_REQUEST['tgl'];
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
    
        
        $ada = $connect->query("select * from absensi where tanggal='$tgl' AND peserta_didik_id='$idp' AND tapel='$tapel' AND smt='$smt' AND kelas='$ab'")->num_rows;
        if ($ada>0){
			$utt=$connect->query("select * from absensi where tanggal='$tgl' AND peserta_didik_id='$idp' AND tapel='$tapel' AND smt='$smt' AND kelas='$ab'")->fetch_assoc();
        	$idn=$utt['id_absen'];
        	$sql = "UPDATE absensi SET absensi='$absensi' WHERE id_absen='$idn'";
        }else{
        	$sql = "INSERT INTO absensi(tanggal,peserta_didik_id, tapel,smt, kelas, absensi) VALUES('$tgl','$idp','$tapel','$smt','$ab','$absensi')";
        };
		$query1 = $connect->query($sql);
        echo "saved";
    
?>