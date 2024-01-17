<?php
require_once('fpdf/fpdf.php');
require_once('../config/db_connect.php');
function namahari($tanggal){
    
		//fungsi mencari namahari
		//format $tgl YYYY-MM-DD
		//harviacode.com
		
		$tgl=substr($tanggal,8,2);
		$bln=substr($tanggal,5,2);
		$thn=substr($tanggal,0,4);

		$info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
		
		switch($info){
			case '0': return "Minggu"; break;
			case '1': return "Senin"; break;
			case '2': return "Selasa"; break;
			case '3': return "Rabu"; break;
			case '4': return "Kamis"; break;
			case '5': return "Jumat"; break;
			case '6': return "Sabtu"; break;
		};
		
	}
function TanggalIndo($tanggal)
	{
		$bulan = array ('Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
	}

class PDF extends FPDF{
function Header(){
   global $connect;
	$ids=$_GET['id'];
	$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
	//$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
	$tanggal=$Ls['tanggal'];
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
  	$smt=$Ls['smt'];
  if($smt==1){
    $smts="GANJIL";
  }else{
    $smts="GENAP";
  };
    
   $this->SetTextColor(0,0,0);
   $this->SetFont('Arial','B','12');
   $this->Ln(0);
   $this->Cell(16,0.5, $this->Image('../assets/'.$cfg['image_login'], $this->GetX(), $this->GetY(),1.7,1.7,0,0), 0, 0, 'L', false );
    $this->Cell(0.3,0.5,'',0,0,'L',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $this->Ln(0);
   $this->Cell(19,1,'DAFTAR HADIR PESERTA ',0,0,'C');
   $this->Ln(0.5);
   $this->Ln(0.5);

   $this->Cell(19,0,strtoupper($Ls['jenis'].' '.$smts),0,0,'C');
   $this->Ln(0.5);
   $this->Cell(19,0,'TAHUN PELAJARAN '.$Ls['tapel'],0,0,'C');
   $this->Ln(1);

   $this->SetFont('Arial','','9');
   $this->Cell(4,0.5,'KOTA/KABUPATEN',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,'','B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'KODE',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'18','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'SEKOLAH/MADRASAH',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,strtoupper($cfg['nama_sekolah']),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'KODE',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'RUANG',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,$Ls['kelas'],'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'KELAS',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,$Ls['kelas'],'B',0,'L');
   $this->Ln(0.5);
	$tanggal=$Ls['tanggal'];
   $this->Cell(4,0.5,'HARI',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,namahari($tanggal).', '.TanggalIndo($tanggal),'B',0,'L');
   $this->Cell(0.3,0.5,'',0,0,'L');
   $this->Cell(1.3,0.5,'PUKUL',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,$Ls['mulai'].' - '.$Ls['selesai'],'B',0,'L');
   $this->Ln(0.5);

   $this->Cell(4,0.5,'MATA PELAJARAN',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,$Ls['mapel'],'B',0,'L');

   $this->SetFont('Arial','B','8');
   $this->SetFillColor(192,192,192);
   $this->Ln(1);
   $this->SetTextColor(0,0,0);
   $this->Cell(1,1,'No','LTB',0,'C',1);
   $this->Cell(3,1,'Nomor Peserta','LTB',0,'C',1);
   $this->Cell(7,1,'Nama Peserta','LTB',0,'C',1);
   $this->Cell(5,1,'Tanda Tangan','LTBR',0,'C',1);
   $this->Cell(3,1,'Ket','LTBR',0,'C',1);
   $this->Ln(1);

  }
  function Footer(){
    global $connect;
	$ids=$_GET['id'];
	$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
   $this->SetY(-2,5);
   $this->Cell(0,1,'Daftar Hadir '.$Ls['jenis'].' - Halaman : '. $this->PageNo(),0,0,'R');
  }
 }


$i = 0;
$ids=$_GET['id'];
$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
$kelas=$Ls['kelas'];
$tapel=$Ls['tapel'];
$smt=$Ls['smt'];
$querys = $connect->query("select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc");

    while ($mL = $querys->fetch_assoc()) {
	  $idp = $mL['peserta_didik_id'];
	  $siswa = $connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
      $namaLengkap = $siswa['nama'];
	  if($siswa['nisn']===''){
		$cell[$i][0]='D02180879'.substr($siswa['nis'],5,4);
	  }else{
		$cell[$i][0]='D02180879'.substr($siswa['nisn'],6,4);
	  }
      $cell[$i][1]=$namaLengkap;
      $cell[$i][2]="";
      $cell[$i][3]="";
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
	$romb=$Ls['kelas'];
	$tpl=$Ls['tapel'];
    $jumlahpeserta=$connect->query("select * from penempatan where rombel='$romb' and tapel='$tpl' and smt='$smt'")->num_rows;
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
    $pdf->Cell(3,$lebar,$noo,'B',0,'L');
    $pdf->Cell(2,$lebar," ",'BR',0,'L');
      } else {
    $pdf->Cell(2,$lebar," ",'B',0,'L');
    $pdf->Cell(3,$lebar,$noo,'BR',0,'L');
    }
    $pdf->Cell(3,$lebar,'','BR',0,'L');
    $pdf->Ln();
   }
   //$ket1 = F_GetKeterangan();
   //$ket2 = F_GetKeterangan2();
   //$ket3 = F_GetKeterangan3();
   //$proktor = F_GetNamaPengawas1();
   


  	
	$nHadir=$jumlahpeserta-$Ls['absen'];

   $pdf->Ln(1);
   $pdf->SetFont('Arial','','9');
   $pdf->Cell(11,0.7,'',0,0,'L');
   $pdf->Cell(4.8,0.7,'Pengawas 1',0,0,'L');
   $pdf->Cell(5.8,0.7,'Pengawas 2',0,0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(5.8,0.7,'Jumlah Peserta yang Seharusnya Hadir',"LT",0,'L');
   $pdf->Cell(0.4,0.7,':','T',0,'L');
   $pdf->Cell(1,0.5,$jumlahpeserta,'TB',0,'L');
   $pdf->Cell(1.2,0.7,'orang','TR',0,'L');

  
   $pdf->Ln(0.7);
   $pdf->Cell(5.8,0.7,'Jumlah Peserta yang Tidak Hadir','L',0,'L');
   $pdf->Cell(0.4,0.7,':',0,0,'L');
   $pdf->Cell(1,0.5,'','B',0,'L');
   $pdf->Cell(1.2,0.7,'orang','R',0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(5.8,0.8,'Jumlah Peserta Hadir','LTB',0,'L');
   $pdf->Cell(0.4,0.8,':','TB',0,'L');
   $pdf->Cell(1,0.8,'','BT',0,'L');
   $pdf->Cell(1.2,0.8,'orang','TBR',0,'L');

   $pdf->Cell(1.2,0.8,'',0,0,'L');
   $pdf->Cell(4.1,0.8,'( '.$Ls['pengawas1'].' )',0,0,'C');
   $pdf->Cell(1.2,0.8,'',0,0,'L');
   $pdf->Cell(4,0.8,'( '.$Ls['pengawas2'].' )',0,0,'C');

   $pdf->Ln(0.6);
   $pdf->Cell(6.2,0.6,'',0,0,'L');
   $pdf->Cell(1,0.6,'','T',0,'L');
   $pdf->Ln(0);
   $pdf->Cell(9.5,0.6,'',0,0,'L');
   $pdf->Cell(4.1,0.6,'NIP. -',0,0,'C');
   $pdf->Cell(1.5,0.6,'',0,0,'L');
   $pdf->Cell(4.1,0.6,'NIP. -',0,0,'L');

   $pdf->Output();
 ?>
