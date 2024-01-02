<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
if($smt==2){
	$ntapel=$tapel;
	$nsmt=1;
}else{
	$tpl1=substr($tapel,0,4);
	$ntpl1=$tpl1-1;
	$tpl2=substr($tapel,5,4);
	$ntpl2=$tpl2-1;
	$ntapel=$ntpl1."/".$ntpl2;
	$nsmt=2;
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
	$nkelas = $connect->query("SELECT * FROM penempatan WHERE peserta_didik_id='$idp' and tapel='$ntapel' and smt='$nsmt'")->fetch_assoc();
	$kelasnya=$nkelas['rombel'];
	
	if($pn>0){

	}else{

			$actionButton = '
				<button class="btn btn-outline-success btn-icon" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#tempatkan">
					<i class="fa fa-home"></i>
				</button>
				<button class="btn btn-outline-info btn-icon" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#mutasikan">
					<i class="fa fa-times"></i>
				</button>
				';

		//$tgl=$row['tempat'].", ".TanggalIndo($row['tanggal']);

		$output['data'][] = array(

			$row['nama'],
			$row['nik'],
			$row['nis'],
			$row['tempat'].', '.TanggalIndo($row['tanggal']),
			$kelasnya,
			$actionButton

		);

	}

}


$connect->close();



echo json_encode($output);