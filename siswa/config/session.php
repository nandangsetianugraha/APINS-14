<?php 
$idku=$_SESSION['peserta_didik_id'];

//$cfg=$connect->query("select * from konfigurasi")->fetch_assoc();
$bioku = $connect->query("select * from siswa where peserta_didik_id='$idku'")->fetch_assoc();
$filegbr = 'images/siswa/'.$bioku['avatar'];
$file_headerss = @get_headers($filegbr);
if($file_headerss[0] == 'HTTP/1.1 404 Not Found') {
	//$exists = false;
	$avatar="profile-7.jpg";
}else {
	//$exists = true;
	$avatar=$bioku['avatar'];
};
$rombel = $connect->query("select * from penempatan where peserta_didik_id='$idku' and tapel='$tapel_aktif' and smt='$smt_aktif'")->fetch_assoc();
$kelas=$rombel['rombel'];
$nrombel = $connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel_aktif'")->fetch_assoc();
$kurikulum = $nrombel['kurikulum'];
$nwali=$nrombel['wali_kelas'];
$npend=$nrombel['pendamping'];
$wali = $connect->query("select * from ptk where ptk_id='$nwali'")->fetch_assoc();
$pendamping = $connect->query("select * from ptk where ptk_id='$npend'")->fetch_assoc();
