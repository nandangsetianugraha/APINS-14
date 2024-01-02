<?php
session_start();
$ptkid=$_SESSION['userid'];
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
include_once("../../config/db_connect.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$proyek=$_REQUEST['proyek'];
$ab=$_REQUEST['kelas'];
$nilai=$_REQUEST['nilai'];
$idel=$_REQUEST['idel'];
$dimensi=$_REQUEST['dimensi'];
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
if(is_numeric($nilai)){
    
        $hasil=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$dimensi'")->fetch_assoc();
        $ada = $connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$dimensi'")->num_rows;
        if ($ada>0){
			$utt=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$dimensi'")->fetch_assoc();
        	$idn=$utt['id_penilaian'];
        	$sql = "UPDATE penilaian_proyek SET nilai='$nilai' WHERE id_penilaian='$idn'";
        }else{
        	$sql = "INSERT INTO penilaian_proyek(peserta_didik_id, kelas, tapel,smt, proyek, id_elemen, dimensi, nilai) VALUES('$idp','$ab','$tapel','$smt','$proyek','$idel','$dimensi','$nilai')";
        };
		$query1 = $connect->query($sql);
        echo "saved";
    
};
?>