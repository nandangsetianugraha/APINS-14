<?php
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$ab=substr($kelas,0,1);
$output = array('data' => array());
if($kelas==0){
	$sql = "select * from penempatan where tapel='$tapel' and smt='$smt' order by rombel asc";
}else{
	$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
};
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$sql1 = "select * from siswa where peserta_didik_id='$idp'";
	$query1 = $connect->query($sql1);
	$row1 = $query1->fetch_assoc();
	if($smt==1){
		$tahun1=substr($tapel,0,4);
		$tahun2=substr($tapel,5,4);
		$tahunseb1=(int) $tahun1-1;
		$tahunseb2=(int) $tahun2-1;
		$tapelseb=$tahunseb1."/".$tahunseb2;
		$smtseb=2;
	}else{
		$tapelseb=$tapel;
		$smtseb=1;
	};
	$kes=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' AND smt='$smtseb' AND tapel='$tapelseb'")->fetch_assoc();
	$kess=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
	//$sqlp = "SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'";
	//$pn = $connect->query($sqlp)->fetch_assoc();
	$ids=$kes['id'];
	$idss=$kess['id'];
	$tng=$kes['tinggi'];
	$tngs='
	<div class="d-grid gap-3">
		'.$kes['tinggi'].'
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['tinggi'].'"  onBlur="saveKes(this,\'tinggi\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['tinggi'].'</span>
	</div>	
	';
	$brt=$kes['berat'];
	$brts='
	<div class="d-grid gap-3">
		'.$kes['berat'].'
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['berat'].'"  onBlur="saveKes(this,\'berat\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['berat'].'</span>
	</div>
	';
	$telinga=$kes['pendengaran'];
	$telingas='
	<div class="d-grid gap-3">
		'.$kes['pendengaran'].'
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['pendengaran'].'"  onBlur="saveKes(this,\'pendengaran\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['pendengaran'].'</span>
	</div>
	';
	$mata=$kes['penglihatan'];
	$matas='
	<div class="d-grid gap-3">
		'.$kes['penglihatan'].'
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['penglihatan'].'"  onBlur="saveKes(this,\'penglihatan\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['penglihatan'].'</span>
	</div>
	';
	$gg=$kes['gigi'];
	$ggs='
	<div class="d-grid gap-3">
		'.$kes['gigi'].'
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['gigi'].'"  onBlur="saveKes(this,\'gigi\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['gigi'].'</span>
	</div>
	';
	$lain=$kes['lainnya'];
	$lains=$kess['lainnya'];
	$output['data'][] = array(
		$row1['nama'],
        $kes['tinggi'],'<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['tinggi'].'"  onBlur="saveKes(this,\'tinggi\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['tinggi'].'</span>',
		$kes['berat'],'	<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['berat'].'"  onBlur="saveKes(this,\'berat\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['berat'].'</span>',
		$kes['pendengaran'],'<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['pendengaran'].'"  onBlur="saveKes(this,\'pendengaran\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['pendengaran'].'</span>',
		$kes['penglihatan'],'<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['penglihatan'].'"  onBlur="saveKes(this,\'penglihatan\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['penglihatan'].'</span>',
		$kes['gigi'],'<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$kess['gigi'].'"  onBlur="saveKes(this,\'gigi\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$kess['gigi'].'</span>'
	);
	
};
// database connection close
$connect->close();
echo json_encode($output);