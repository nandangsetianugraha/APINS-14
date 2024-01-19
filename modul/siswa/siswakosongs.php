<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
if($smt==2){
	$ntapel=$tapel;
	$nsmt=1;
	$ab=(int) substr($kelas,0,1);
};
if($smt==1){
	$tpl1=(int)substr($tapel,0,4);
	$ntpl1=$tpl1-1;
	$tpl2=(int)substr($tapel,5,4);
	$ntpl2=$tpl2-1;
	$ntapel=$ntpl1."/".$ntpl2;
	$nsmt=2;
	$ab=(int) substr($kelas,0,1)-1;
};
$output = array('data' => array());
$sql = "SELECT * FROM siswa where status='1' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$sqlp = "SELECT * FROM penempatan WHERE peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'";
	$queryp = $connect->query($sqlp);
	$pn = $queryp->num_rows;
	$nisn=$row['nisn'];
	$jk=$row['jk'];
	$abc=(int)$ab-1;
	
	//$abc=(int) substr($kelasnya,0,1);
	if($pn>0){

	}else{
		$nkelas = $connect->query("SELECT * FROM penempatan WHERE peserta_didik_id='$idp' and tapel='$ntapel' and smt='$nsmt'")->fetch_assoc();
		$kelasnya=$nkelas['rombel'];
		$abc=(int)substr($kelasnya,0,1);
		$cek = $connect->query("SELECT * FROM penempatan WHERE peserta_didik_id='$idp' and tapel='$ntapel' and smt='$nsmt'")->num_rows;
		if($abc==$ab or $abc==''){
			$actionButton = '
				<button class="btn btn-outline-success btn-sm me-1 mb-1" onclick="tempatkan(\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')">
					<i class="fa fa-share"></i>
				</button>
				';

			//$tgl=$row['tempat'].", ".TanggalIndo($row['tanggal']);

			$output['data'][] = array(
				$actionButton.' '.$row['nama'],
				$row['nis'],
				$row['nisn'],
				$kelasnya
			);
		}
	}
}
$connect->close();
echo json_encode($output);