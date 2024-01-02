<?php 
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$ab=substr($kelas, 0, 1);
$mp=$_GET['mp'];
$output = array('data' => array());
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
if($mp==0){
}else{
	while($s=$query->fetch_assoc()) {
		$idpd=$s['peserta_didik_id'];
		$sql2 = "select * from siswa where peserta_didik_id='$idpd'";
		$query2 = $connect->query($sql2);
		$j=$query2->fetch_assoc();
		$sql1 = "select * from raport_k13 where id_pd='$idpd' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and jns='k4'";
		$query1 = $connect->query($sql1);
		$n=$query1->fetch_assoc();
		$nilai=$n['nilai'];
		$predikat=$n['predikat'];
		$deskripsi=$n['deskripsi'];
		$ada=$query1->num_rows;
		if($ada>0){
			$idr=$n['id_raport'];
			$tombol='
			<button class="btn btn-info btn-border btn-round btn-sm" type="button" id="'.$idr.'" data-bs-toggle="modal" data-bs-target="#info" data-id="'.$idr.'"><i class="fas fa-edit"></i></button>
			';
		}else{
			$tombol='';
		};
		$actionButton = '
			<div class="btn-group">
			<a class="btn btn-info btn-border btn-round btn-sm" data-kelas="'.$kelas.'" data-mp="'.$mp.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-pdid="'.$idpd.'" id="getRaport" ><i class="fas fa-sync"></i></a>
			</div>';
		$output['data'][] = array(
			$actionButton.' '.$j['nama'],
			$nilai,
			$predikat,
			$deskripsi.' '.$tombol	
		);
	};
};
// database connection close
$connect->close();
echo json_encode($output);