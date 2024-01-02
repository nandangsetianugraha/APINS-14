<?php
session_start();
require_once '../../config/db_connect.php';
$validator = array('success' => false, 'messages' => array());
if (!isset($_SESSION['userid'])) {
	$validator['success'] = false;
	$validator['messages'] = "Session Anda Sudah berakhir....Silahkan Login kembali";
}else{
$ptkid=$_SESSION['userid'];
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
$pdid=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mapel=$_REQUEST['mp'];
$kelas=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$kd=$_REQUEST['kd'];
$ab=substr($kelas,0,1);
$cek="select * from nuts where id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel' and kd='$kd'";
$ada = $connect->query($cek)->num_rows;
$utt=$connect->query($cek)->fetch_assoc();
$nama=$connect->query("select * from siswa where peserta_didik_id='$pdid'")->fetch_assoc();
$pelajaran=$connect->query("select * from mapel where id_mapel='$mapel'")->fetch_assoc();
if(is_numeric($nilai)){
    if($nilai>100){}else{
        if ($ada>0){
        	$idn=$utt['idNH'];
        	if($nilai==0 or empty($nilai)){
        		$sql="DELETE FROM nuts WHERE idNH='$idn'";
				$aktiv='Hapus Nilai PTS '.$pelajaran['kd_mapel'].' [KD '.$kd.'] atas nama '.$nama['nama'];
				$sql2 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
				$query2 = $connect->query($sql2);
        	}else{ 
        		$sql = "UPDATE nuts SET nilai='$nilai' WHERE idNH='$idn'";
				$aktiv='Update Nilai PTS '.$pelajaran['kd_mapel'].' [KD '.$kd.'] atas nama '.$nama['nama'];
				$sql2 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
				$query2 = $connect->query($sql2);
        	};
        }else{
        	$sql = "INSERT INTO nuts(id_pd,kelas,smt,tapel,mapel,kd,nilai) VALUES('$pdid','$ab','$smt','$tapel','$mapel','$kd','$nilai')";
			$aktiv='Input Nilai PTS '.$pelajaran['kd_mapel'].' [KD '.$kd.'] atas nama '.$nama['nama'];
			$sql2 = "INSERT INTO log(ptk_id, logDate, activity) VALUES('$ptkid','$waktu','$aktiv')";
			$query2 = $connect->query($sql2);
        };
        $query1 = $connect->query($sql);
		$vck = $connect->query("select * from temp_pts where id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel'")->num_rows;
        $vrh=$connect->query("select avg(nilai) as rerata from nuts where id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel'")->fetch_assoc();
        $rerata=$vrh['rerata'];
        if($vck>0){
        	$vcn=$connect->query("select * from temp_pts where id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel'")->fetch_assoc();
        	$idt=$vcn['idNH'];
        	$sql1 = "UPDATE temp_pts SET nilai='$rerata' WHERE idNH='$idt'";
        }else{
        	$sql1 = "INSERT INTO temp_pts(id_pd,kelas,smt,tapel,mapel,nilai) VALUES('$pdid','$kelas','$smt','$tapel','$mapel','$rerata')";
        };
		$query3 = $connect->query($sql1);
		$validator['success'] = true;
		$validator['messages'] = "Sukses";
    };
}else{
	$validator['success'] = false;
	$validator['messages'] = "Bukan Angka";
}
};
$connect->close();
echo json_encode($validator);
?>