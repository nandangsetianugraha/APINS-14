<?php 

require_once '../../config/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$output = array('data' => array());

$sql = "SELECT * FROM rombel WHERE tapel='$tapel' and smt='$smt' order by nama_rombel asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idwk=$row['wali_kelas'];
	$idgp=$row['pendamping'];
	$idgp1=$row['pai'];
	$idgp2=$row['penjas'];
	$idgp3=$row['inggris'];
	$ids=$row['id_rombel'];
	$nrombel=$row['nama_rombel'];
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
	<button class="btn btn-outline-success btn-sm me-1 mb-1" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-rombel"><i class="fa fa-edit"></i> Edit</button>
	<button class="btn btn-outline-danger btn-sm me-1 mb-1" onclick="removeRombel('.$ids.')"> <i class="fa fa-trash"></i> Hapus</button>
	<button class="btn btn-outline-primary btn-sm me-1 mb-1" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#anggota-rombel"> <i class="fa fa-users"></i> Anggota Rombel</button>
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