<?php
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$mp=$_GET['mp'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$ab=substr($kelas,0,1);
$output = array('data' => array());
if($tapel_aktif==$tapel and $smt_aktif==$smt){
	$edit=true;
}else{
	$edit=false;
};
$sql = "select * from penempatan where tapel='$tapel' and smt='$smt' and rombel='$kelas' order by nama asc";
$query = $connect->query($sql);
$mapel=$connect->query("select * from mata_pelajaran where id_mapel='$mp'")->fetch_assoc();
if($mp==0){
}else{
	$ceklm=$connect->query("select * from lingkup_materi where kelas='$ab' and smt='$smt' and mapel='$mp'")->num_rows;
	$cektp=$connect->query("select * from tp where kelas='$ab' and smt='$smt' and mapel='$mp'")->num_rows;
	if($ceklm>0 and $cektp>0){
		while($s=$query->fetch_assoc()) {
			$idp=$s['peserta_didik_id'];
			$siswa=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
			$sql1 = "select * from sts where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$mp'";
			$nh = $connect->query($sql1);
			$m=$nh->fetch_assoc();
			if(empty($m['nilai'])){
				$nHar='';
			}else{
				$nHar=number_format($m['nilai'],0);
			};
			if($edit){
				$nh='
				<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$nHar.'"  onBlur="saveTengahSumatif(this,\'nilai\',\''.$idp.'\',\''.$kelas.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mp.'\')" onClick="highlightEdit(this);">'.$nHar.'</span>
				';
			}else{
				$nh=$nHar;
			};
			$output['data'][] = array(
				$siswa['nama'],
				$nh
			);
		};
	};
};

// database connection close
$connect->close();

echo json_encode($output);