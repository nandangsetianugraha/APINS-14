<?php 
require_once '../../config/db_connect.php';
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};
$validator = array('success' => false, 'sakit' => array(),'ijin' => array(),'alfa' => array());
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$tgl=$_GET['tgl'];
$sekarang=date('Y-m-d');
$bulannow=substr($tgl,5,2);
$tahun=substr($tgl,0,4);
if($kelas==0){
	$absensi=$connect->query("SELECT SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa FROM absensi WHERE month(tanggal)='$bulannow' and year(tanggal)='$tahun' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
}else{
	$absensi=$connect->query("SELECT SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa FROM absensi WHERE month(tanggal)='$bulannow' and year(tanggal)='$tahun' and tapel='$tapel' and smt='$smt' and kelas='$kelas'")->fetch_assoc();
};
$validator['success'] = false;
$validator['sakit'] = $absensi['sakit'];
$validator['ijin'] = $absensi['ijin'];
$validator['alfa'] = $absensi['alfa'];

// database connection close
$connect->close();

echo json_encode($validator);