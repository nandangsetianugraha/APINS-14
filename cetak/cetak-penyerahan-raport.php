<?php
require_once('fpdf/fpdf.php');
require_once('../config/config.php');
require_once('../config/db_connect.php');

class PDF extends FPDF{
function Header(){
   global $connect;
	$cfg=$connect->query("select * from konfigurasi where id_conf='1'")->fetch_assoc();
	$cfgs=$connect->query("select * from sekolah")->fetch_assoc();
	$idesa = $cfgs['desa'];
	$ikec = $cfgs['kecamatan'];
	$ikab = $cfgs['kabupaten'];
	$iprov = $cfgs['provinsi'];
	$desa=$connect->query("select * from desa where id='$idesa'")->fetch_assoc();
	$kec=$connect->query("select * from kecamatan where id='$ikec'")->fetch_assoc();
	$kab=$connect->query("select * from kabupaten where id='$ikab'")->fetch_assoc();
	$prov=$connect->query("select * from provinsi where id_prov='$iprov'")->fetch_assoc();
	$kelas=$_GET['kelas'];
	$ab=substr($kelas, 0, 1);
	$tapel=$_GET['tapel'];
	$tahun1=substr($tapel,0,4);
	$tahun2=substr($tapel,5,4);
	$smt=$_GET['smt'];
    
   $this->SetTextColor(0,0,0);
   $this->SetFont('Arial','B','12');
   $this->Ln(0);
   $this->Cell(16,0.5, $this->Image('../assets/'.$cfg['image_login'], $this->GetX(), $this->GetY(),1.7,1.7,0,0), 0, 0, 'L', false );
    $this->Cell(0.3,0.5,'',0,0,'L',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $this->Ln(0);
   $this->Cell(19,1,'DAFTAR PENYERAHAN RAPORT (Format PK-7a)',0,0,'C');
   $this->Ln(0.5);
   $this->Ln(0.5);

   $this->Cell(19,0,strtoupper($cfg['nama_sekolah']),0,0,'C');
   $this->Ln(0.5);
   $this->Cell(19,0,'SEMESTER '.$smt.' TAHUN PELAJARAN '.$tapel,0,0,'C');
   $this->Ln(1);
   

   $this->SetFont('Arial','','9');
   $this->Cell(4,0.5,'Nama Sekolah',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($cfgs['nama']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(2.3,0.5,'Status',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'Swasta','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'Alamat',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,$cfgs['alamat_jalan'],'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(2.3,0.5,'Hari/Tanggal',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'Desa/Kelurahan',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($desa['nama']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(2.3,0.5,'Pukul',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'','B',0,'L');
   $this->Ln(0.5);
   //$tanggal=$Ls['tanggal'];
   $this->Cell(4,0.5,'Kecamatan',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($kec['nama']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(2.3,0.5,'Kelas',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,$kelas,'B',0,'L');
   $this->Ln(0.5);

   $this->Cell(4,0.5,'Kabupaten',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($kab['nama']),'B',0,'L');

   $this->SetFont('Arial','B','8');
   $this->SetFillColor(192,192,192);
   $this->Ln(1.2);
   $this->SetTextColor(0,0,0);
   $this->Cell(1,1,'No','LTB',0,'C',1);
   $this->Cell(3,1,'Nomor Induk','LTB',0,'C',1);
   $this->Cell(7,1,'Nama Lengkap Siswa','LTB',0,'C',1);
   $this->Cell(5,1,'Tanda Tangan','LTBR',0,'C',1);
   $this->Cell(3,1,'Ket','LTBR',0,'C',1);
   $this->Ln(1);

  }
  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,1,'Format PK-7a - Halaman : '. $this->PageNo(),0,0,'R');
  }
 }


$i = 0;
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$querys = $connect->query("select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc");

    while ($mL = $querys->fetch_assoc()) {
	  $idp = $mL['peserta_didik_id'];
	  $siswa = $connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
      $namaLengkap = $siswa['nama'];
	  //if($siswa['nisn']===''){
		$cell[$i][0]=$siswa['nis'];
	  //}else{
		//$cell[$i][0]='D02180879'.substr($siswa['nisn'],6,4);
	  //}
      $cell[$i][1]=$namaLengkap;
      $cell[$i][2]="";
      $cell[$i][3]="";
      $cell[$i][4]="";
      $i++;
    }


   $pdf = new PDF('P','cm','A4');
   $pdf->AliasNbPages();
   $pdf->AddPage();
   //$pdf->SetFont('Arial','','9');
   $pdf->SetTextColor(0,0,0);
   $pdf->SetTitle("Format Penyerahan Raport ~ APINS");
   $pdf->SetAuthor("APINS");
   $pdf->SetCreator("Nandang");
   $pdf->SetKeywords("APINS");
   $pdf->SetSubject("APINS");

   $pdf->SetFont('Arial','','8');
   for($j=0;$j<$i;$j++){
     $no = $j+1;
     $noo = $no . ".";
    $pdf->Cell(1,1,$noo,'LB',0,'C');
    $pdf->Cell(3,1,$cell[$j][0],'LB',0,'C');
    $pdf->Cell(7,1,$cell[$j][1],'LBR',0,'L');

    if ($j % 2 == 0) {
    $pdf->Cell(3,1,$noo,'B',0,'L');
    $pdf->Cell(2,1," ",'BR',0,'L');
      } else {
    $pdf->Cell(2,1," ",'B',0,'L');
    $pdf->Cell(3,1,$noo,'BR',0,'L');
    }
    $pdf->Cell(3,1,'','BR',0,'L');
    $pdf->Ln();
   }
   //$ket1 = F_GetKeterangan();
   //$ket2 = F_GetKeterangan2();
   //$ket3 = F_GetKeterangan3();
   //$proktor = F_GetNamaPengawas1();
   


   $pdf->Ln(0.5);
   $pdf->Cell(4,0.5,'Keterangan',0,0,'L');
   $pdf->Ln(0.5);
   $pdf->Cell(4,0.3,'1. Dibuat rangkap 2 (dua), masing-masing untuk Wali kelas dan Arsip Sekolah',0,0,'L');
 $romb=$_GET['kelas'];
	$tpl=$_GET['tapel'];
    $jumlahpeserta=$connect->query("select * from penempatan where rombel='$romb' and tapel='$tpl' and smt='$smt'")->num_rows;
	$nHadir=$jumlahpeserta;

   $pdf->Ln(1.5);
   $pdf->SetFont('Arial','','9');
   $pdf->Cell(11,0.7,'',0,0,'L');
   $pdf->Cell(4.8,0.7,'',0,0,'L');
   $pdf->Cell(5.8,0.7,'Wali Kelas',0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(5.8,0.7,'Jumlah Peserta Didik',"LT",0,'L');
   $pdf->Cell(0.4,0.7,':','T',0,'L');
   $pdf->Cell(1,0.5,$jumlahpeserta,'TB',0,'L');
   $pdf->Cell(1.2,0.7,'orang','TR',0,'L');

  
   $pdf->Ln(0.7);
   $pdf->Cell(5.8,0.7,'Jumlah belum mengambil','L',0,'L');
   $pdf->Cell(0.4,0.7,':',0,0,'L');
   $pdf->Cell(1,0.5,'','B',0,'L');
   $pdf->Cell(1.2,0.7,'orang','R',0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(5.8,0.8,'Jumlah','LTB',0,'L');
   $pdf->Cell(0.4,0.8,':','TB',0,'L');
   $pdf->Cell(1,0.8,'','BT',0,'L');
   $pdf->Cell(1.2,0.8,'orang','TBR',0,'L');
	$query1 = $connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'");
	$wali = $query1->fetch_assoc();
	$idwali=$wali['wali_kelas'];
	$idpend=$wali['pendamping'];
	$namawali = $connect->query("select * from ptk where ptk_id='$idwali'")->fetch_assoc();
	if($namawali['gelar']===''){
		$walikelas=$namawali['nama'];
	}else{
		$walikelas=$namawali['nama'].', '.$namawali['gelar'];
	}
	$namapend = $connect->query("select * from ptk where ptk_id='$idpend'")->fetch_assoc();
	if($namapend['gelar']===''){
		$pendamping=$namapend['nama'];
	}else{
		$pendamping=$namapend['nama'].', '.$namapend['gelar'];
	}
   $pdf->Cell(1.2,0.8,'',0,0,'L');
   $pdf->Cell(4.1,0.8,'',0,0,'L');
   $pdf->Cell(1.2,0.8,'',0,0,'L');
   $pdf->Cell(4,0.8,'( '.$walikelas.' )',0,0,'L');

   $pdf->Ln(0.6);
   $pdf->Cell(6.2,0.6,'',0,0,'L');
   $pdf->Cell(1,0.6,'','T',0,'L');
   $pdf->Ln(0);
   $pdf->Cell(9.5,0.6,'',0,0,'L');
   $pdf->Cell(4.1,0.6,'',0,0,'L');
   $pdf->Cell(1.5,0.6,'',0,0,'L');
   $pdf->Cell(4.1,0.6,'NIP. -',0,0,'L');

   $pdf->Output();
 ?>
