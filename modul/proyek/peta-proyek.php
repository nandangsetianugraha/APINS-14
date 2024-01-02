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
$output = array('data' => array());
$proyek=$_GET['proyek'];
	$sql = "select * from pemetaan_proyek where proyek='$proyek' order by id_pemetaan asc";
	$query = $connect->query($sql);
	while ($row = $query->fetch_assoc()) {
		$idpeta=$row['id_pemetaan'];
		$proyek=$row['proyek'];
		$nproyek=$connect->query("select * from data_proyek where id_proyek='$proyek'")->fetch_assoc();
		$dimensi=$row['dimensi'];
		$ndimensi=$connect->query("select * from dimensi_proyek where id_dimensi='$dimensi'")->fetch_assoc();
		$actionButton = '
		<button type="button" class="mb-1 mt-1 me-1 btn btn-sm btn-danger" onclick="removePeta('.$idpeta.')"><i class="fas fa-trash"></i></button>
		';
		$output['data'][] = array(
			$ndimensi['nama_dimensi'],
			$actionButton
		);
	}

// database connection close
$connect->close();

echo json_encode($output);