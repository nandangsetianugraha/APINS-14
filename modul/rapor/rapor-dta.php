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
//$mp=$_GET['mp'];
$tapel=$_GET['tapel'];
if($tapel_aktif==$tapel and $smt_aktif==$smt){
	$edit=true;
}else{
	$edit=false;
};
if($mp==0){
}else{
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$siswa=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$sql2 = "select * from mapel_dta order by id_mapel asc";
	$query2 = $connect->query($sql2);
	while($sl=$query2->fetch_assoc()) {
		$mp=$sl['id_mapel'];
		$sql1 = "select * from raport_dta where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$mp'";
		$nh = $connect->query($sql1);
		$cekrapor=$connect->query("select * from raport_dta where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$mp'")->num_rows;
		if($cekrapor>0){
			$m=$nh->fetch_assoc();
			$ids=$m['id_raport'];
			if(empty($m['nilai'])){
			$nHar='';
			}else{
				$nHar=number_format($m['nilai'],0);
			};
			$nh1='
			<button type="button" class="btn btn-effect-ripple btn-xs btn-primary" data-kelas="'.$kelas.'" data-mp="'.$mp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-pdid="'.$idp.'" id="getRaport"><i class="fas fa-sync"></i></button>
			';
		}else{
			$nHar='';
			$nh1='
			<button type="button" class="btn btn-effect-ripple btn-xs btn-primary" data-kelas="'.$kelas.'" data-mp="'.$mp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-pdid="'.$idp.'" id="getRaport"><i class="fas fa-sync"></i></button>
			';
		}
		$output['data'][] = array(
			$nh1.' '.$siswa['nama'],
			$nHar
		);
	};
}
}
// database connection close
$connect->close();

echo json_encode($output);