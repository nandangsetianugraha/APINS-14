<?php
require_once('fpdf/fpdf.php');
require_once('../config/config.php');
require_once('../config/db_connect.php');
class PDF extends FPDF{
function Header(){
   global $connect;
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
	$status=$_GET['status'];
	$cfg=$connect->query("select * from konfigurasi where id_conf='1'")->fetch_assoc();
	$cfgs=$connect->query("select * from sekolah")->fetch_assoc();
	$iddesa=$cfgs['desa'];
	$idkec=$cfgs['kecamatan'];
	$idkab=$cfgs['kabupaten'];
	$idprov=$cfgs['provinsi'];
	$desa=$connect->query("select * from desa where id='$iddesa'")->fetch_assoc();
	$kec=$connect->query("select * from kecamatan where id='$idkec'")->fetch_assoc();
	$kab=$connect->query("select * from kabupaten where id='$idkab'")->fetch_assoc();
	$prov=$connect->query("select * from provinsi where id_prov='$idprov'")->fetch_assoc();
	$jns=$connect->query("select * from jns_mutasi where id_mutasi='$status'")->fetch_assoc();
   $this->SetTextColor(0,0,0);
   $this->SetFont('Arial','B','12');
   $this->Ln(0);
   $this->Cell(16,0.5, $this->Image('../assets/'.$cfg['image_login'], $this->GetX(), $this->GetY(),1.7,1.7,0,0), 0, 0, 'L', false );
    $this->Cell(0.3,0.5,'',0,0,'L',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $this->Ln(0);
   $this->Cell(19,1,'DAFTAR SISWA KELAS '.strtoupper($jns['nama_mutasi']),0,0,'C');
	$this->Ln(0.5);
   $this->Ln(0.5);

   $this->Cell(19,0,strtoupper($cfg['nama_sekolah']),0,0,'C');
   $this->Ln(0.5);
   $this->Cell(19,0,'TAHUN PELAJARAN '.$tapel,0,0,'C');
   $this->Ln(1);

   $this->SetFont('Arial','','9');
   $this->Cell(4,0.5,'KOTA/KABUPATEN',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($kab['nama']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'KODE',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'SEKOLAH/MADRASAH',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($cfgs['nama']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'KODE',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'STATUS',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($jns['nama_mutasi']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'',0,0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(3,0.5,'',0,0,'L');
   $this->Ln(0.5);
   
   $this->SetFont('Arial','B','8');
   $this->SetFillColor(192,192,192);
   $this->Ln(1);
   $this->SetTextColor(0,0,0);
   $this->Cell(1,1,'No','LTB',0,'C',1);
   $this->Cell(3,1,'NIS / NISN','LTB',0,'C',1);
   $this->Cell(7,1,'Nama Peserta','LTB',0,'C',1);
   $this->Cell(5,1,'Tempat Tanggal Lahir','LTBR',0,'C',1);
   $this->Cell(3,1,'Kelas','LTBR',0,'C',1);
   $this->Ln(1);

  }
  function Footer(){
    global $connect;
   $this->SetY(-2,5);
   $this->Cell(0,1,'Daftar Siswa - Halaman : '. $this->PageNo(),0,0,'R');
  }
 }


$i = 0;
$status=$_GET['status'];
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
$querys = $connect->query("select * from siswa where status='$status' order by nama asc");

    while ($mL = $querys->fetch_assoc()) {
	  $idp = $mL['peserta_didik_id'];
	  $namaLengkap = $mL['nama'];
	  $nrmb = $connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
	  $cell[$i][0]=$mL['nis'].' / '.$mL['nisn'];
	  $cell[$i][1]=$namaLengkap;
      $cell[$i][2]=$mL['tempat'].", ".TanggalIndo($mL['tanggal']);
      $cell[$i][3]=$nrmb['rombel'];
      $cell[$i][4]="";
      $i++;
    }
	

   //$pdf = new PDF('P','cm',array(21.5,33));
   $pdf = new PDF('P','cm','A4');
   $pdf->AliasNbPages();
   $pdf->AddPage();
   //$pdf->SetFont('Arial','','9');
   
   $pdf->SetTextColor(0,0,0);
   $pdf->SetTitle("Daftar Hadir Peserta ~ APINS");
   $pdf->SetAuthor("APINS");
   $pdf->SetCreator("Nandang");
   $pdf->SetKeywords("APINS");
   $pdf->SetSubject("APINS");
	
    $jumlahpeserta=$connect->query("select * from siswa where status='$status'")->num_rows;
   $pdf->SetFont('Arial','','8');
if($jumlahpeserta<20){
  $lebar=1.3;
}else{
  $lebar=1.2;
}
   for($j=0;$j<$i;$j++){
     $no = $j+1;
     $noo = $no . ".";
    $pdf->Cell(1,$lebar,$noo,'LB',0,'C');
    $pdf->Cell(3,$lebar,$cell[$j][0],'LB',0,'L');
    $pdf->Cell(7,$lebar,$cell[$j][1],'LBR',0,'L');

    if ($j % 2 == 0) {
    $pdf->Cell(3,$lebar,$cell[$j][2],'B',0,'L');
    $pdf->Cell(2,$lebar," ",'BR',0,'L');
      } else {
    $pdf->Cell(2,$lebar,$cell[$j][2],'B',0,'L');
    $pdf->Cell(3,$lebar," ",'BR',0,'L');
    }
    $pdf->Cell(3,$lebar,$cell[$j][3],'BR',0,'C');
    $pdf->Ln();
   }
   //$ket1 = F_GetKeterangan();
   //$ket2 = F_GetKeterangan2();
   //$ket3 = F_GetKeterangan3();
   //$proktor = F_GetNamaPengawas1();
   $pdf->Ln(0.7);
   $pdf->SetFont('Times','','12');
   $pdf->Cell(13,0.5,'',0,0,'L');
   $pdf->Cell(4,0.5,'Kepala Sekolah',0,0,'C');
   $pdf->Ln(0.1);
   $pdf->MultiCell(13.5,0.5,'',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'',0,0,'L');
   $pdf->MultiCell(11,0.5,'',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'',0,0,'L');
   $pdf->MultiCell(11,0.5,'',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'',0,0,'L');
   $pdf->MultiCell(11,0.5,'',0,'J',0);
   //$pdf->Cell(13,0.5,'Tembusan :',0,0,'L');
   $pdf->Ln(0.2);
   $pdf->Cell(13);
   $pdf->SetFont('Times','B','12');
   $nptk = $connect->query("select * from ptk where jenis_ptk_id='99'")->fetch_assoc();
   if(empty($nptk['gelar']) or $nptk['gelar']==''){
	   $namawl=$nptk['nama'];
   }else{
	   $namawl=$nptk['nama'].', '.$nptk['gelar'];
   };
   $pdf->Cell(4,0.5,$namawl,0,0,'C');


   

   $pdf->Output();
 ?>
