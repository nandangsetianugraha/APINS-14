<?php 
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$ab=substr($kelas, 0, 1);
$output = array('data' => array());
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idpd=$s['peserta_didik_id'];
	$sql2 = "select * from siswa where peserta_didik_id='$idpd'";
	$query2 = $connect->query($sql2);
	$j=$query2->fetch_assoc();
	$ki1=$connect->query("select * from deskripsi_k13 where id_pd='$idpd' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k1'")->num_rows;
	$ki2=$connect->query("select * from deskripsi_k13 where id_pd='$idpd' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k2'")->num_rows;
	$ki3=$connect->query("select * from raport_k13 where id_pd='$idpd' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k3'")->num_rows;
	$ki4=$connect->query("select * from raport_k13 where id_pd='$idpd' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k4'")->num_rows;
	if($ab>3){
		$jmpl=11;
	}else{
		$jmpl=9;
	};
	if($ki1>0){
		$cek1='<span class="badge badge-success"><i class="fas fa-check"></i></span>';
		$cek11=true;
	}else{
		$cek1='<span class="badge badge-danger"><i class="fas fa-times"></i></span>';
		$cek11=false;
	};
	if($ki2>0){
		$cek2='<span class="badge badge-success"><i class="fas fa-check"></i></span>';
		$cek22=true;
	}else{
		$cek2='<span class="badge badge-danger"><i class="fas fa-times"></i></span>';
		$cek22=false;
	};
	if($ki3 < $jmpl){
		$cek3='<span class="badge badge-danger"><i class="fas fa-times"></i> '.$ki3.'/'.$jmpl.'</span>';
		$cek33=false;
	}else{
		$cek3='<span class="badge badge-success"><i class="fas fa-check"></i> '.$ki3.'/'.$jmpl.'</span>';
		$cek33=true;
	};
	if($ki4 < $jmpl){
		$cek4='<span class="badge badge-danger"><i class="fas fa-times"></i> '.$ki4.'/'.$jmpl.'</span>';
		$cek44=false;
	}else{
		$cek4='<span class="badge badge-success"><i class="fas fa-check"></i> '.$ki4.'/'.$jmpl.'</span>';
		$cek44=true;
	};
	if($cek11==true and $cek22==true and $cek33==true and $cek44==true){
		$actionButton = '
		<div class="btn-group">
		<a href="cetak/cetakNilai.php?idp='.$idpd.'&kelas='.$kelas.'&tapel='.$tapel.'&smt='.$smt.'" class="btn btn-primary btn-xs" target="_blank"><i class="fas fa-print"></i> Cetak</a>
		</div>';
	}else{
		$actionButton='';
	};
	$output['data'][] = array(
		$j['nama'],
		$cek1,$cek2,$cek3,$cek4,
		$actionButton
		);
};
$connect->close();
echo json_encode($output);