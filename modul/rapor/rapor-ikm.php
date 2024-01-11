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
$mp=$_GET['mp'];
$tapel=$_GET['tapel'];
if($tapel_aktif==$tapel and $smt_aktif==$smt){
	$edit=true;
}else{
	$edit=false;
};
if($mp==0){
	$output['data'][] = array(
		'',
		'',
		''
	);
}else{
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$siswa=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$sql1 = "select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$mp'";
	$nh = $connect->query($sql1);
	$cekrapor=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$mp'")->num_rows;
	if($cekrapor>0){
		$m=$nh->fetch_assoc();
		$ids=$m['id_raport'];
		$data = explode("|" , $m['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		if($edit){
			$stat='';
		}else{
			$stat='disabled';
		};
		$tbl='
		<a href="#" class="btn btn-effect-ripple btn-xs btn-primary" type="button" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-info" '.$stat.'><i class="fa fa-edit"></i></a>
		';
		if(empty($m['nilai'])){
			$nHar='';
		}else{
			$nHar=number_format($m['nilai'],0);
		};
		$nh1='
			<button type="button" class="btn btn-effect-ripple btn-xs btn-primary" data-kelas="'.$kelas.'" data-mp="'.$mp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-pdid="'.$idp.'" id="getRaport" '.$stat.'><i class="fas fa-sync"></i></button>
			';
	}else{
		$nHar='';
		$kelebihan='';
		$kelemahan='';
		if($edit){
			$stat='';
		}else{
			$stat='disabled';
		};
		$tbl='
		
		';
		$nh1='
		<button type="button" class="btn btn-effect-ripple btn-xs btn-primary" data-kelas="'.$kelas.'" data-mp="'.$mp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-pdid="'.$idp.'" id="getRaport" '.$stat.'><i class="fas fa-sync"></i></button>
		';
	};
	
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$nh1.' '.$siswa['nama'],
		$nHar,
		$kelebihan.'<br/>'.$kelemahan.' '.$tbl
	);
}
}
// database connection close
$connect->close();

echo json_encode($output);