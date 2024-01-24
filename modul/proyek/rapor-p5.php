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
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
if($ab==1 or $ab==2){ $vase='A';};
if($ab==3 or $ab==4){ $vase='B';};
if($ab==5 or $ab==6){ $vase='C';};
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$dproyek=$connect->query("select * from data_proyek where kelas='$kelas' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
$idproyek=$dproyek['id_proyek'];
$sql = "select penempatan.peserta_didik_id,siswa.nama from penempatan left join siswa on penempatan.peserta_didik_id=siswa.peserta_didik_id where penempatan.rombel='$kelas' and penempatan.tapel='$tapel' and penempatan.smt='$smt' order by siswa.nama asc";
$query = $connect->query($sql);
$sqlp="select * from pemetaan_proyek where proyek='$idproyek'";
$queryp=$connect->query($sqlp);
$jumfase=0;
while ($rowp = $queryp->fetch_assoc()) {
	$dimensi=$rowp['dimensi'];
	$cekjum=$connect->query("select * from elemen_proyek where dimensi='$dimensi' and fase='$vase'")->num_rows;
	$jumfase=$jumfase+$cekjum;
}
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$ceksiswa=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' and kelas='$kelas' and tapel='$tapel' and smt='$smt' and proyek='$idproyek'")->num_rows;
	if(empty($idproyek)){
		$tombol=' ';
	}else{
		if($ceksiswa==$jumfase){
		$tombol='
		<button class="btn btn-sm btn-outline-primary me-1 mb-1" id="previewS" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-proyek="'.$idproyek.'"><i class="fa fa-print"></i> Cetak</button>';
		}else{
			$tombol='';
		}
	};
	
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$row['nama'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);
