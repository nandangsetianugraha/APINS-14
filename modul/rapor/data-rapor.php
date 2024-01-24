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
$sql = "select penempatan.peserta_didik_id,siswa.nama from penempatan left join siswa on penempatan.peserta_didik_id=siswa.peserta_didik_id where penempatan.rombel='$kelas' and penempatan.tapel='$tapel' and penempatan.smt='$smt' order by siswa.nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	//$siswa = $connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
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
	<button class="btn btn-sm btn-outline-primary me-1 mb-1" id="previewS" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"><i class="fa fa-print"></i> Sampul</button>
	<button class="btn btn-sm btn-outline-success me-1 mb-1" id="previewI" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"><i class="fa fa-print"></i> Identitas</button>
	<button class="btn btn-sm btn-outline-info me-1 mb-1" id="previewR" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"><i class="fa fa-print"></i> Rapor</button>
	<button class="btn btn-sm btn-outline-secondary me-1 mb-1" id="previewB" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"><i class="fa fa-print"></i> Nilai</button>
	<button class="btn btn-sm btn-outline-warning me-1 mb-1" id="previewA" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"><i class="fa fa-print"></i> Semuanya</button>
	<button class="btn btn-sm btn-outline-danger me-1 mb-1" id="previewM" data-kelas="'.$kelas.'" data-id="'.$idp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'"><i class="fa fa-print"></i> Mutasi</button>
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
			$tombol.='<button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' '.$row1['kd_mapel'].'
                </button>';
		}else{
			$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
			$btns='btn-danger';
		};
	};
	$cekkes = $connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
	if($cekkes>0){
		$tanda='<i class="fa fa-check"></i>';
		$btns='btn-primary';
		$tombol.='<br/><button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' Data Kesehatan
                </button>';
	}else{
		$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
		$btns='btn-danger';
	};
	
	$cekpres = $connect->query("SELECT * FROM data_prestasi WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
	if($cekpres>0){
		$tanda='<i class="fa fa-check"></i>';
		$btns='btn-primary';
		$tombol.='<br/><button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' Data Prestasi
                </button>';
	}else{
		$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
		$btns='btn-danger';
	};
	
	$cekabs = $connect->query("SELECT * FROM data_absensi WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
	if($cekabs>0){
		$tanda='<i class="fa fa-check"></i>';
		$btns='btn-primary';
		$tombol.='<button type="button" class="btn btn-sm '.$btns.' me-1 mb-1">
                  '.$tanda.' Data Absensi
                </button>';
	}else{
		$tanda='<i class="fa fa-times opacity-50 me-1"></i>';
		$btns='btn-danger';
	};
	
	
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
