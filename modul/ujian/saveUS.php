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
$tapel=$_REQUEST['tapel'];
$mapel=$_REQUEST['mp'];
$nilai=$_REQUEST['value'];
$kur=$_REQUEST['kur'];
$cek="select * from nilai_us where tapel='$tapel' and peserta_didik_id='$pdid' AND kurikulum='$kur' AND mapel='$mapel'";
$ada = $connect->query($cek)->num_rows;
$nama=$connect->query("select * from siswa where peserta_didik_id='$pdid'")->fetch_assoc();
if($kur==='2'){
	$pelajaran=$connect->query("select * from mapel where id_mapel='$mapel'")->fetch_assoc();
}else{
	$pelajaran=$connect->query("select * from mata_pelajaran where id_mapel='$mapel'")->fetch_assoc();
};
if(is_numeric($nilai)){
    if($nilai>100){}else{
        if ($ada>0){
			$utt=$connect->query($cek)->fetch_assoc();
        	$idn=$utt['id_us'];
        	if($nilai==0 or empty($nilai)){
        		$sql="DELETE FROM nilai_us WHERE id_us='$idn'";
        	}else{ 
        		$sql = "UPDATE nilai_us SET nilai='$nilai' WHERE id_us='$idn'";
        	};
        }else{
        	$sql = "INSERT INTO nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) VALUES('$tapel','$pdid','$kur','$mapel','$nilai')";
        };
		$query3 = $connect->query($sql);
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