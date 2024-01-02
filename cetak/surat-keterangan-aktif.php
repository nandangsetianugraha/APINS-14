<?php
require_once('fpdf/fpdf.php');
require_once('../config/config.php');
require_once('../config/db_connect.php');
	
class PDF extends FPDF{
  
  function Header(){
    $this->SetFont('Times','B',12);
    $this->Ln(0);
    $this->Cell(16,0.5, $this->Image('logo.jpg', $this->GetX(), $this->GetY(),2.9,2.9,0,0), 0, 0, 'L', false );
    $this->Cell(0.3,0.5,'',0,0,'J',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $this->Ln(0);
    $this->Cell(21,0.8,'PEMERINTAH KABUPATEN INDRAMAYU',0,0,'C');
    $this->Ln(0.5);
    $this->Cell(21,0.8,'DINAS PENDIDIKAN',0,0,'C');
    $this->Ln(0.5);
    $this->Cell(21,0.8,'YAYASAN AL-ISLAM INDRAMAYU',0,0,'C');
	$this->Ln(0.5);
	$this->SetFont('Times','B',14);
    $this->Cell(21,0.8,'SEKOLAH DASAR ISLAM AL-JANNAH',0,0,'C');
	$this->Ln(0.5);
	$this->SetFont('Arial','B',8);
    $this->Cell(21,0.8,'Alamat Jl. Raya Gabuswetan No. 1 Gabuswetan Indramayu 45263 Telp. (0234)5508501',0,0,'C');
	$this->Ln(0.35);
    $this->Cell(21,0.8,'E-mail: sdi.aljannah@gmail.com Laman: https://sdi-aljannah.web.id',0,0,'C');
    $this->Ln(0.5);
	$this->SetLineWidth(0.09);
	$this->Line(1,4.2,20,4.2);
	$this->SetLineWidth(0);
	$this->Line(1,4.3,20,4.3);
	$this->Ln(0.5);
  }
/**
  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,0.7,'SD ISLAM AL-JANNAH GABUSWETAN KABUPATEN INDRAMAYU - Halaman : '. $this->PageNo(),'BTRL',0,'C');
  }
 **/
 }

   $ids=$_GET['id'];
   $Ls=$connect->query("select * from sk_aktif where id='$ids'")->fetch_assoc();
   $idpd=$Ls['peserta_didik_id'];
   $nama=$connect->query("select * from siswa where peserta_didik_id='$idpd'")->fetch_assoc();
   $pdf = new PDF('P','cm','A4');
   $pdf->AliasNbPages();
   $pdf->AddPage();
   $pdf->SetFont('Times','B','12');
   $pdf->SetTextColor(0,0,0);
   $pdf->Ln(0.5);
   $pdf->Cell(14);
   $pdf->Cell(0,0,'NPSN',0,0,'L');
   $pdf->Ln(0.2);
   $pdf->Cell(14);
   $pdf->Cell(0.5,0.5,'2','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'0','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'2','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'5','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'8','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'0','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'8','BTLR',0,'L');
   $pdf->Cell(0.5,0.5,'8','BTLR',0,'L');
   $pdf->Ln(1.25);
   $pdf->SetFont('Courier','B','16');
   $pdf->Cell(0,0,'SURAT KETERANGAN',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->SetLineWidth(0);
   $pdf->Line(7.5,6.53,13.5,6.53);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(0,0,'Nomor: '.$Ls['no_surat'],0,0,'C');
   $pdf->Ln(1.5);
   $pdf->SetFont('Times','','12');
   $pdf->MultiCell(19,0.7,'Yang bertanda tangan di bawah ini, Kepala Sekolah Dasar Islam Al-Jannah, Kecamatan Gabuswetan Kabupaten Indramayu Propinsi Jawa Barat, menerangkan bahwa:',0,'J',0); 
   $pdf->Ln(0.1);
   //$pdf->Cell(0.5,0.5,'1.',0,0,'L');
   $pdf->Cell(6,0.5,'Nama',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(12.5,0.5,$nama['nama'],0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(6,0.5,'Tempat, Tanggal Lahir',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(12.5,0.5,$nama['tempat'].', '.TanggalIndo($nama['tanggal']),0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(6,0.5,'NIS/NISN',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(12.5,0.5,$nama['nis'].'/'.$nama['nisn'],0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(6,0.5,'Jenis Kelamin',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   if($nama['jk']==='L'){
	   $jk='Laki-laki';
   }else{
	   $jk='Perempuan';
   };
   $pdf->Cell(12.5,0.5,$jk,0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(6,0.5,'Nama Orang Tua',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   //$pdf->Cell(12.5,0.5,'',0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(1);
   $pdf->Cell(5,0.5,'Ayah',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(12.5,0.5,$nama['nama_ayah'],0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(1);
   $pdf->Cell(5,0.5,'Ibu',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(12.5,0.5,$nama['nama_ibu'],0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(6,0.5,'Alamat Rumah',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(12.4,0.5,$nama['alamat'],0,'J',0);
   $pdf->Ln(0.7);
   $pdf->MultiCell(19,0.7,'Benar nama tersebut di atas adalah sebagai Peserta Didik Kelas '.$Ls['kelas'].' pada Tahun Pelajaran '.$Ls['tapel'].' dan masih aktif sebagai siswa di sekolah kami.',0,'J',0);
   $pdf->Ln(0.7);
   $pdf->MultiCell(19,0.5,'Demikian Surat Keterangan ini Kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.',0,'J',0);
   $pdf->Ln(0.7);
   $pdf->Cell(13);
   $pdf->Cell(4,0.5,'Gabuswetan, '.TanggalIndo($Ls['tanggal']),0,0,'C');
   $pdf->Ln(0.7);
   $pdf->Cell(13);
   $pdf->Cell(4,0.5,'Kepala Sekolah',0,0,'C');
   $pdf->Ln(3);
   $pdf->Cell(13);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(4,0.5,'UMAR ALI, S.Pd.',0,0,'C');
   $pdf->SetTitle("Surat Keterangan Aktif Sekolah");
   $pdf->SetAuthor("APINS");
   $pdf->SetCreator("Nandang");
   $pdf->SetKeywords("APINS");
   $pdf->SetSubject("APINS");

   $pdf->Output();
 ?>
