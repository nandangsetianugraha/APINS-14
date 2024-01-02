<?php 

require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$mpid=$_GET['mapel'];
$tapel=$_GET['tapel'];
//$jenis=$_GET['jenis'];
$output = array('data' => array());
$sql = "select * from kd where kelas='$kelas' and mapel='$mpid' order by kd";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$kda=$s['kd'];
	$namakd1=$connect->query("select * from kkmku where kelas='$kelas' and tapel='$tapel' and mapel='$mpid' and kd='$kda' and jenis=1")->fetch_assoc();
	$namakd2=$connect->query("select * from kkmku where kelas='$kelas' and tapel='$tapel' and mapel='$mpid' and kd='$kda' and jenis=2")->fetch_assoc();
	$namakd3=$connect->query("select * from kkmku where kelas='$kelas' and tapel='$tapel' and mapel='$mpid' and kd='$kda' and jenis=3")->fetch_assoc();
	$cr1=$namakd1['nilai'];
	$cr2=$namakd2['nilai'];
	$cr3=$namakd3['nilai'];
	$actionButton1 = '
	<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$cr1.'"  onBlur="saveKKM(this,\'nilai\',\''.$kelas.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kda.'\',\'1\')" onClick="highlightEdit(this);">'.$cr1.'</span>
	';    
	$actionButton2 = '
	<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$cr2.'"  onBlur="saveKKM(this,\'nilai\',\''.$kelas.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kda.'\',\'2\')" onClick="highlightEdit(this);">'.$cr2.'</span>
	';
	$actionButton3 = '
	<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$cr3.'"  onBlur="saveKKM(this,\'nilai\',\''.$kelas.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kda.'\',\'3\')" onClick="highlightEdit(this);">'.$cr3.'</span>
	';
	$kkms=$connect->query("select AVG(nilai) as rerata from kkmku where kelas='$kelas' and tapel='$tapel' and mapel='$mpid' and kd='$kda'")->fetch_assoc();
	$idkd=explode('.',$kda);
	$idkds=$idkd[0].$idkd[1];
	$kkmKD='
	<p id="para'.$idkds.'">'.number_format($kkms['rerata'],0).'</p>
	';
	$output['data'][] = array(
		$s['kd'],
		$s['nama_kd'],
		$actionButton1,
		$actionButton2,
		$actionButton3,
		$kkmKD
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);