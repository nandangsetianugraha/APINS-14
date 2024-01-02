<?php 
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$ab=substr($kelas, 0, 1);
$output = array('data' => array());
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idpd=$s['peserta_didik_id'];
	$sql2 = "select * from siswa where peserta_didik_id='$idpd'";
	$query2 = $connect->query($sql2);
	$j=$query2->fetch_assoc();
	$sql1 = "select * from deskripsi_k13 where id_pd='$idpd' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and jns='k1'";
	$query1 = $connect->query($sql1);
	$ada=$query1->num_rows;
	if($ada>0){
		$m=$query1->fetch_assoc();
		$deskripsi=$m['deskripsi'];
		$idr=$m['id_raport'];
	}else{
		$deskripsi="";
	};
	$actionButton = '
		<div class="btn-group">
		<a class="btn btn-info btn-border btn-round btn-sm" data-kelas="'.$kelas.'" data-tapel="'.$tapel.'" data-smt="'.$smt.'" data-pdid="'.$idpd.'" id="getRaport" ><i class="fas fa-sync"></i></a>
		</div>';
	if($ada>0){
		$output['data'][] = array(
		$actionButton.' <button class="btn btn-info btn-border btn-round btn-sm" type="button" id="'.$idr.'" data-bs-toggle="modal" data-bs-target="#info" data-id="'.$idr.'"><i class="fas fa-edit"></i></button>'.' '.$j['nama'],
		$deskripsi	
		);
	}else{
		$output['data'][] = array(
		$actionButton.' '.$j['nama'],
		$deskripsi		
		);
	};
};
// database connection close
$connect->close();
echo json_encode($output);