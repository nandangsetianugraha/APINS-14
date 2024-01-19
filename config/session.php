<?php 
$idku=$_SESSION['userid'];
$tapel = $_SESSION['tapel'];
$smt = $_SESSION['smt'];
$level=$_SESSION['level'];
//$cfg=$connect->query("select * from konfigurasi")->fetch_assoc();
$bioku = $connect->query("select * from ptk where ptk_id='$idku'")->fetch_assoc();
$filegbr = base_url().'images/ptk/'.$bioku['gambar'];
//$file_headerss = @get_headers($filegbr);
if(file_exists($filegbr)) {
	//$exists = false;
	$avatar="profile-7.jpg";
}else {
	//$exists = true;
	$avatar=$bioku['gambar'];
};
$status=$bioku['status_kepegawaian_id'];
$levels=$bioku['jenis_ptk_id'];
$jns_ptk = $connect->query("select * from jenis_ptk where jenis_ptk_id='$levels'")->fetch_assoc();
$status_ptk = $connect->query("select * from status_kepegawaian where status_kepegawaian_id='$status'")->fetch_assoc();
if($level==96){
		//PAI
	$nk=$connect->query("select * from rombel where tapel='$tapel' and smt='$smt' and pai='$idku' order by nama_rombel asc")->fetch_assoc();
	$kelas=$nk['nama_rombel'];
	if(isset($_SESSION['kurikulum'])){
	}else{
		$_SESSION['kurikulum']='Kurikulum 2013';
	};
}elseif($level==95){
		//PJOK
	$nk=$connect->query("select * from rombel where tapel='$tapel' and smt='$smt' and penjas='$idku' order by nama_rombel asc")->fetch_assoc();
	$kelas=$nk['nama_rombel'];
	if(isset($_SESSION['kurikulum'])){
	}else{
		$_SESSION['kurikulum']='Kurikulum 2013';
	};
}elseif($level==94){
		//Bahasa Inggris
	$nk=$connect->query("select * from rombel where tapel='$tapel' and smt='$smt' and inggris='$idku' order by nama_rombel asc")->fetch_assoc();
	$kelas=$nk['nama_rombel'];
	if(isset($_SESSION['kurikulum'])){
	}else{
		$_SESSION['kurikulum']='Kurikulum 2013';
	};
}elseif($level==97){
		//Guru Pendamping
	$nk=$connect->query("select * from rombel where tapel='$tapel' and smt='$smt' and pendamping='$idku' order by nama_rombel asc")->fetch_assoc();
	$kelas=$nk['nama_rombel'];
	$_SESSION['kurikulum']=$nk['kurikulum'];
}elseif($level==98){
		//Guru Kelas
	$nk=$connect->query("select * from rombel where tapel='$tapel' and smt='$smt' and wali_kelas='$idku' order by nama_rombel asc")->fetch_assoc();
	$kelas=$nk['nama_rombel'];
	$_SESSION['kurikulum']=$nk['kurikulum'];
}else{
	$kelas="1";
	if(isset($_SESSION['kurikulum'])){
	}else{
		$_SESSION['kurikulum']='Kurikulum Merdeka';
	};
};
if($kelas==''){
	$norombel=true;
	$_SESSION['kurikulum']='Kurikulum Merdeka';
}else{
	$norombel=false;
};
$ab=substr($kelas,0,1);