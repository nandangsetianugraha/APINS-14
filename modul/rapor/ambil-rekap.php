<?php
require_once '../../config/db_connect.php';
$contents='';
$contents .= '
<table id="rekaprapor" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="text-center">Nama Siswa</th>
';
			
$sql1 = "select * from mapel order by id_mapel asc";
$query1 = $connect->query($sql1);
while ($row1 = $query1->fetch_assoc()) {
$contents .= '
<th class="text-center">'.$row1['kd_mapel'].'</th>
';
};
$contents .= '
			<th class="text-center">Jumlah</th>
			<th class="text-center">Rerata</th>
			<th class="text-center">Rank</th>
		</tr>
	</thead>
	<tbody>
';
$tapel=$_GET['tapel'];
$kelas=$_GET['kelas'];
$ab=substr($kelas, 0, 1);
$smt=$_GET['smt'];
$jns=$_GET['jns'];
$output = array('data' => array());
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	
	$ada1=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='$jns'")->num_rows;
	if($ada1>0){
		$nh1=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='$jns'")->fetch_assoc();
		$nilai1=$nh1['nilai'];
	}else{
		$nilai1="";
	};
	$ada2=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='$jns'")->num_rows;
	if($ada2>0){
		$nh2=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='$jns'")->fetch_assoc();
		$nilai2=$nh2['nilai'];
	}else{
		$nilai2="";
	};
	$ada3=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='$jns'")->num_rows;
	if($ada3>0){
		$nh3=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='$jns'")->fetch_assoc();
		$nilai3=$nh3['nilai'];
	}else{
		$nilai3="";
	};
	$ada4=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='$jns'")->num_rows;
	if($ada4>0){
		$nh4=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='$jns'")->fetch_assoc();
		$nilai4=$nh4['nilai'];
	}else{
		$nilai4="";
	};
	$ada5=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='$jns'")->num_rows;
	if($ada5>0){
		$nh5=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='$jns'")->fetch_assoc();
		$nilai5=$nh5['nilai'];
	}else{
		$nilai5="";
	};
	$ada6=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='$jns'")->num_rows;
	if($ada6>0){
		$nh6=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='$jns'")->fetch_assoc();
		$nilai6=$nh6['nilai'];
	}else{
		$nilai6="";
	};
	$ada7=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='$jns'")->num_rows;
	if($ada7>0){
		$nh7=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='$jns'")->fetch_assoc();
		$nilai7=$nh7['nilai'];
	}else{
		$nilai7="";
	};
	$ada8=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='$jns'")->num_rows;
	if($ada8>0){
		$nh8=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='$jns'")->fetch_assoc();
		$nilai8=$nh8['nilai'];
	}else{
		$nilai8="";
	};
	$ada9=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='$jns'")->num_rows;
	if($ada9>0){
		$nh9=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='$jns'")->fetch_assoc();
		$nilai9=$nh9['nilai'];
	}else{
		$nilai9="";
	};
	$ada10=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='$jns'")->num_rows;
	if($ada10>0){
		$nh10=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='$jns'")->fetch_assoc();
		$nilai10=$nh10['nilai'];
	}else{
		$nilai10="";
	};
	$ada11=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='$jns'")->num_rows;
	if($ada11>0){
		$nh11=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='$jns'")->fetch_assoc();
		$nilai11=$nh11['nilai'];
	}else{
		$nilai11="";
	};
	
	$nrh=$connect->query("select avg(nilai) as rerata from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='$jns'")->fetch_assoc();
	$nrt=$connect->query("select sum(nilai) as rerata from raport_k13 where id_pd='$idp'  and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='$jns'")->fetch_assoc();
	$contents .= '
	<tr>
		<td>'.$s['nama'].'</td>
		<td>'.$nilai1.'</td>
		<td>'.$nilai2.'</td>
		<td>'.$nilai3.'</td>
		<td>'.$nilai4.'</td>
		<td>'.$nilai5.'</td>
		<td>'.$nilai6.'</td>
		<td>'.$nilai7.'</td>
		<td>'.$nilai8.'</td>
		<td>'.$nilai9.'</td>
		<td>'.$nilai10.'</td>
		<td>'.$nilai11.'</td>
		<td>'.number_format($nrt['rerata'],2).'</td>
		<td>'.number_format($nrh['rerata'],2).'</td>
		<td></td>
	</tr>
	';
};
$contents .= '
</tbody>
</table>
';

echo json_encode($contents);
?>