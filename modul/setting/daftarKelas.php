<?php 

require_once '../../function/db_connect.php';
$tapel=$_GET['tapel'];
$output = array('data' => array());

$sql = "SELECT * FROM rombel WHERE tapel='$tapel' order by tapel desc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idwk=$row['wali_kelas'];
	$idgp=$row['pendamping'];
	$idgp1=$row['pai'];
	$idgp2=$row['penjas'];
	$idgp3=$row['inggris'];
	$ids=$row['id_rombel'];
	$adawk = $connect->query("SELECT * FROM ptk where ptk_id='$idwk'")->num_rows;
	if($adawk>0){
		$nwk = $connect->query("SELECT * FROM ptk where ptk_id='$idwk'")->fetch_assoc();
		$namawali=$nwk['nama'];
	}else{
		$namawali="";
	};
	$adagp = $connect->query("SELECT * FROM ptk where ptk_id='$idgp'")->num_rows;
	if($adagp>0){
		$ngp = $connect->query("SELECT * FROM ptk where ptk_id='$idgp'")->fetch_assoc();
		$namagp=$ngp['nama'];
	}else{
		$namagp="";
	};
	$adagp1 = $connect->query("SELECT * FROM ptk where ptk_id='$idgp1'")->num_rows;
	if($adagp1>0){
		$ngp1 = $connect->query("SELECT * FROM ptk where ptk_id='$idgp1'")->fetch_assoc();
		$namagp1=$ngp1['nama'];
	}else{
		$namagp1="";
	};
	$adagp2 = $connect->query("SELECT * FROM ptk where ptk_id='$idgp2'")->num_rows;
	if($adagp2>0){
		$ngp2 = $connect->query("SELECT * FROM ptk where ptk_id='$idgp2'")->fetch_assoc();
		$namagp2=$ngp2['nama'];
	}else{
		$namagp2="";
	};
	$adagp3 = $connect->query("SELECT * FROM ptk where ptk_id='$idgp3'")->num_rows;
	if($adagp3>0){
		$ngp3 = $connect->query("SELECT * FROM ptk where ptk_id='$idgp3'")->fetch_assoc();
		$namagp3=$ngp3['nama'];
	}else{
		$namagp3="";
	};
	$actionButton = '
	<ul class="pagination pg-primary">
		<li class="page-item"><button data-target="#editKelas" class="btn btn-info btn-border btn-round btn-sm" type="button" id="'.$ids.'" data-toggle="modal" data-id="'.$ids.'"><i class="fa fa-edit"></i></button></li>
	<li class="page-item"><button class="btn btn-info btn-border btn-round btn-sm" type="button" data-toggle="modal" data-target="#outMemberModal" onclick="outMember('.$ids.')"><i class="fas fa-user-times"></i></button></li></ul>
	';
	
	$output['data'][] = array(
		$row['nama_rombel'],
		$row['kurikulum'],
		$namawali,
		$namagp,$namagp1,$namagp2,$namagp3,
		$actionButton
	);
}

// database connection close
$connect->close();

echo json_encode($output);