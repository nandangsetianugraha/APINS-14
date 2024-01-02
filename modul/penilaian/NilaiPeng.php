<?php 
require_once '../../config/db_connect.php';
session_start();
$level=$_SESSION['level'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
$peta=$_GET['peta'];
$mpid=$_GET['mp'];
$kd=$_GET['kd'];
$tema=$_GET['tema'];
$jns=$_GET['jns'];
$ada=0;
/**
if($tapel_aktif==$tapel and $smt_aktif==$smt){
	$edit=true;
}else{
	$edit=false;
};
**/
$output = array('data' => array());
$edit=true;
$ckkm1=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mpid' and kd='$kd' and jenis='1'")->num_rows;
if($ckkm1>0){
	$boleh=true;
}else{
	$boleh=false;
};
$mpm=$connect->query("select * from mapel where id_mapel='$mpid'")->fetch_assoc();
if($boleh){
	$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
	$query = $connect->query($sql);
		while($s=$query->fetch_assoc()) {
			$idp=$s['peserta_didik_id'];
			$sql1 = "select * from nh where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='$jns'";
			$nh = $connect->query($sql1);
          	$siswa = $connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
            
			$m=$nh->fetch_assoc();
			if(empty($m['nilai'])){
				$nHar='';
			}else{
				$nHar=number_format($m['nilai'],0);
			};
			$nt='
				<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$nHar.'"  onBlur="saveHarian(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\''.$jns.'\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$nHar.'</span>
			';
			$output['data'][] = array(
				$siswa['nama'],
				$nt
			);
		};
}else{
	
};
$connect->close();

echo json_encode($output);