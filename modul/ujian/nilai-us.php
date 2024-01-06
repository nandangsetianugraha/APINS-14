<?php 
require_once '../../config/db_connect.php';
session_start();
$level=$_SESSION['level'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$ada=0;
/**
if($tapel_aktif==$tapel and $smt_aktif==$smt){
	$edit=true;
}else{
	$edit=false;
};
**/
$output = array('data' => array());
$ckkur=$connect->query("select * from rombel where nama_rombel like '%6%' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
$nkur=$ckkur['kurikulum'];
$idkur=$connect->query("select * from kurikulum where nama_kurikulum='$nkur'")->fetch_assoc();
$idk=$idkur['id_kurikulum'];
if($nkur=='Kurikulum 2013'){
	$sql4 = "select * from mapel order by id_mapel asc";
}elseif($nkur=='KTSP'){
    $sql4 = "select * from mapel order by id_mapel asc";
}else{
	$sql4 = "select * from mata_pelajaran order by id_mapel asc";
};
$sql="select * from penempatan where rombel like '%6%' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()){
	$idpd = $s['peserta_didik_id'];
	$siswa = $connect->query("select * from siswa where peserta_didik_id='$idpd'")->fetch_assoc();
	$query4 = $connect->query($sql4);
	
	while($nk=$query4->fetch_assoc()){
		$idmp=$nk['id_mapel'];
		$cekn = $connect->query("select * from nilai_us where tapel='$tapel' and peserta_didik_id='$idpd' and kurikulum='$idk' and mapel='$idmp'")->num_rows;
		if($cekn>0){
			$m=$connect->query("select * from nilai_us where tapel='$tapel' and peserta_didik_id='$idpd' and kurikulum='$idk' and mapel='$idmp'")->fetch_assoc();
			$nilaius=$m['nilai'];
		}else{
			$nilaius='';
		}
		$nt[$idmp]='
				<span class="input form-control form-control-sm" type="number" contenteditable="true" data-old_value="'.$nilaius.'"  onBlur="saveUS(this,\'nilai\',\''.$tapel.'\',\''.$idpd.'\',\''.$idk.'\',\''.$idmp.'\')" onClick="highlightEdit(this);">'.$nilaius.'</span>
			';
	};
	if($idk=='1'){
		$output['data'][] = array(
			$siswa['nama'],
			$nt[1],$nt[2],$nt[3],$nt[4],$nt[5],$nt[6],$nt[7],$nt[8],$nt[9],$nt[10],$nt[11]
		);
	}elseif($idk=='2'){
        $output['data'][] = array(
			$siswa['nama'],
			$nt[1],$nt[2],$nt[3],$nt[4],$nt[5],$nt[6],$nt[7],$nt[8],$nt[9],$nt[10],$nt[11]
		);
    }else{
		$output['data'][] = array(
			$siswa['nama'],
			$nt[1],$nt[2],$nt[3],$nt[4],$nt[5],$nt[6],$nt[7],$nt[8],$nt[9]
		);
	}
};

$connect->close();

echo json_encode($output);