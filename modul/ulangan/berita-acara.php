<?php 

require_once '../../config/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$output = array('data' => array());

$sql = "select * from berita_acara where tapel='$tapel' and smt='$smt' order by id_bap desc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$ids=$s['id_bap'];
	$actionButton = '
	<a href="cetak/daftarHadir.php?id='.$s['id_bap'].'" target="_blank" rel="noopener noreferrer" class="btn btn-effect-ripple btn-xs btn-primary"><i class="fa fa-calendar"></i></a>
		<a href="cetak/beritaAcara.php?id='.$s['id_bap'].'" target="_blank" rel="noopener noreferrer" class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-print"></i></a>
	';
	$output['data'][] = array(
		$s['tanggal'],
		$s['jenis'].'<br/>'.$s['mapel'],
		$s['kelas'],
		$s['mulai'].' s.d. '.$s['selesai'],
		$s['pengawas1'].'<br/>'.$s['pengawas2'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);