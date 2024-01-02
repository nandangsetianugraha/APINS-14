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
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$sq1 = "SELECT * FROM raport_ikm WHERE id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel'";
	$ada1 = $connect->query($sq1)->num_rows;
	$status="";
	if($ada1<8 and $ab=="1"){
		$status="disabled";
	};
	if($ada1<9 and $ab<>"1"){
		$status="disabled";
	};
	$aksi='
	<a href="cetak/cetak-rapor.php?idp='.$idp.'&kelas='.$kelas.'&smt='.$smt.'&tapel='.$tapel.'" type="button" class="btn btn-success mb-2"><i class="fa fa-print opacity-50 me-1" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"></i> Cetak</a>
	';
	$sql1 = "select * from mata_pelajaran order by id_mapel asc";
	$query1 = $connect->query($sql1);
	$tombol='';
	while ($row1 = $query1->fetch_assoc()) {
		$idm=$row1['id_mapel'];
		$ceks = $connect->query("SELECT * FROM raport_ikm WHERE id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->num_rows;
		if($ceks>0){
			$tanda='<i class="fa fa-check"></i>';
			$btns='btn-primary';
		}else{
			$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
			$btns='btn-danger';
		};
		if($ab=="1" and $idm==5){
		}else{
		$tombol.='<button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' '.$row1['kd_mapel'].'
                </button>';
		};
	};
	$cekkes = $connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
	if($cekkes>0){
		$tanda='<i class="fa fa-check"></i>';
		$btns='btn-primary';
	}else{
		$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
		$btns='btn-danger';
	};
	$tombol.='<br/><button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' Data Kesehatan
                </button>';
	$cekabs = $connect->query("SELECT * FROM data_absensi WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
	if($cekabs>0){
		$tanda='<i class="fa fa-check"></i>';
		$btns='btn-primary';
	}else{
		$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
		$btns='btn-danger';
	};
	$tombol.='<button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' Data Absensi
                </button>';
	
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$row['nama'],
		$tombol,
		$aksi
	);
}

// database connection close
$connect->close();

echo json_encode($output);