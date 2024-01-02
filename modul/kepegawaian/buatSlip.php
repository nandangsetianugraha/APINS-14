<?php
include_once("../../config/db.php");
$idpeg=$_REQUEST['idpeg'];
$bln=$_REQUEST['bln'];
$thn=$_REQUEST['thn'];
$hari=$_REQUEST['hari'];
$absen=$_REQUEST['absen'];
$ekskul=$_REQUEST['ekskul'];
$telat=$_REQUEST['telat'];
$cepat=$_REQUEST['cepat'];
$ptk=mysqli_fetch_array(mysqli_query($koneksi,"select * from id_pegawai where ptk_id='$idpeg'"));
$pegid=$ptk['pegawai_id'];
$gaji=mysqli_fetch_array(mysqli_query($koneksi,"select * from gajipokok where pegawai_id='$pegid'"));
$cek="select * from slip_gaji where ptk_id='$idpeg' and bulan='$bln' and tahun='$thn'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows(mysqli_query($koneksi,"select * from slip_gaji where ptk_id='$idpeg' and bulan='$bln' and tahun='$thn'"));
$utt=mysqli_fetch_array($hasil);
$gapok=$gaji['insentif']*9*20;
$transport=$gaji['transport'];
$tunj_jabatan=$gaji['tunj_walikelas'];
$tunj_lain=$gaji['tunj_kepsek'];
$tunj_kehadiran=$gaji['tunj_kehadiran'];
$tunj_ekskul=$gaji['tunj_ekskul'];
$pot_telat=($gaji['insentif']/60)*$telat;
$pot_cepat=($gaji['insentif']/60)*$cepat;
$pot_absen=($gaji['insentif']*9)*$absen;
if($absen>0){
	$pot_ketidakhadiran=$gaji['tunj_kehadiran'];
}else{
	$pot_ketidakhadiran=0;
};
$pot_ekskul=($gaji['tunj_ekskul']/4)*$ekskul;
$ketidakhadiran=$hari-$absen;
$totalgaji=$gapok + $transport + $tunj_jabatan + $tunj_lain + $tunj_kehadiran + $tunj_ekskul;
$total_pot = $pot_telat + $pot_cepat + $pot_absen + $pot_ketidakhadiran + $pot_ekskul;
$gaji_bersih = $totalgaji - $total_pot;
if($ada>0){
	
	$sql = "UPDATE slip_gaji SET gapok='$gapok', tunj_transport='$transport', tunj_jabatan='$tunj_jabatan', tunj_lain='$tunj_lain', tunj_kehadiran='$tunj_kehadiran', tunj_ekskul='$tunj_ekskul', pot_telat='$pot_telat', pot_cepat='$pot_cepat', pot_absen='$pot_absen', pot_ketidakhadiran='$pot_ketidakhadiran', pot_ekskul='$pot_ekskul', hari_kerja='$hari', kehadiran='$absen', absensi='$ketidakhadiran', telat='$telat', cepat='$cepat', total_gaji='$totalgaji', total_pot='$total_pot', gaji_bersih='$gaji_bersih' WHERE ptk_id='$idpeg' and bulan='$bln' and tahun='$thn'";
}else{
	$sql = "INSERT INTO slip_gaji(ptk_id,bulan,tahun,gapok,tunj_transport,tunj_jabatan,tunj_lain,tunj_kehadiran,tunj_ekskul,pot_telat,pot_cepat,pot_absen,pot_ketidakhadiran,pot_ekskul,hari_kerja,kehadiran,absensi,telat,cepat,total_gaji,total_pot,gaji_bersih) VALUES('$idpeg','$bln','$thn','$gapok','$transport','$tunj_jabatan','$tunj_lain','$tunj_kehadiran','$tunj_ekskul','$pot_telat','$pot_cepat','$pot_absen','$pot_ketidakhadiran','$pot_ekskul','$hari','$absen','$ketidakhadiran','$telat','$cepat','$totalgaji','$total_pot','$gaji_bersih')";
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>