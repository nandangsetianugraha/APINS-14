<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../config/db_connect.php';
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
	};

	$bln=$_GET['bln'];
	$thn=$_GET['thn'];
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$namafilenya="Rekap Gaji ".$bulan[(int)$bln-1]." ".$thn.".pdf";
		$pdf=new exFPDF('L','mm',array(297,210));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, 1);
		$table2->rowStyle('font-size:14');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan','align:L;');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Indramayu - Jawa Barat 45263 Telp. (0234) 5508501','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:8;border:B');
		$table2->easyCell('Website: http://sdi-aljannah.web.id Email: sdi.aljannah@gmail.com');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, 1);
		$table2->rowStyle('font-size:14');
		$table2->easyCell('REKAP GAJI','align:C;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:9');
		$table2->easyCell('BULAN : '.$bulan[(int)$bln-1].' '.$thn,'align:C;font-style:B');
		$table2->printRow();
		$table2->endTable();
		
		
		
		$table2=new easyTable($pdf, '{14,75,45,50,50,36,40}','border:1');
		$table2->rowStyle('font-size:12;min-height:12');
		$table2->easyCell('ID','valign:M;align:C;font-style:B');
		$table2->easyCell('Nama Pegawai','valign:M;align:C;font-style:B');
		$table2->easyCell('Gaji Bersih','valign:M;align:C;font-style:B');
		$table2->easyCell('Potongan','valign:M;align:C;font-style:B');
		$table2->easyCell('Total Gaji','valign:M;align:C;font-style:B');
		$table2->easyCell('Tanda Tangan','colspan:2;valign:M;align:C;font-style:B');
		$table2->printRow(true);
		$cek=$connect->query("select * from id_pegawai order by pegawai_id asc");
		$a=1;
		while($sis=$cek->fetch_assoc()){
			$idp=$sis['ptk_id'];
			$idpeg=$sis['pegawai_id'];
			$namaptk=$connect->query("select * from ptk where ptk_id='$idp'")->fetch_assoc();
			$gp=$connect->query("select * from gajipokok where pegawai_id='$idpeg'")->fetch_assoc();
			$po=$connect->query("select * from potongan_gaji where pegawai_id='$idpeg' and bulan='$bln' and tahun='$thn'")->fetch_assoc();
			$totalgaji=$gp['insentif']*9*20+$gp['transport']+$gp['tunj_walikelas']+$gp['tunj_kepsek']+$gp['tunj_kehadiran']+$gp['tunj_ekskul'];
			if($po['absen']==0){
				$takhadir=0;
			}else{
				$takhadir=$gp['tunj_kehadiran'];
			};
			$totalpotong=round(($po['telat']/60)*$gp['insentif'])+round(($po['cepat']/60)*$gp['insentif'])+round($po['absen']*9*$gp['insentif'])+$takhadir+$po['ekskul']*($gp['tunj_ekskul']/4);
			$table2->rowStyle('font-size:12;min-height:14');
			$table2->easyCell($sis['pegawai_id'],'valign:M;align:C;font-style:B');
			$table2->easyCell($namaptk['nama'],'valign:M;align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($totalgaji,2),'valign:M;align:R;font-style:B');
			$table2->easyCell('Rp. '.number_format($totalpotong,2),'valign:M;align:R;font-style:B');
			$table2->easyCell('Rp. '.number_format($totalgaji-$totalpotong,2),'valign:M;align:R;font-style:B');
			if($a%2==0){
				$table2->easyCell('','valign:M;align:L;font-style:B;border:B');
				$table2->easyCell($a,'valign:M;align:L;font-style:B;border:BR');
			}else{
				$table2->easyCell($a,'valign:M;align:L;font-style:B;border:B');
				$table2->easyCell('','valign:M;align:L;font-style:B;border:BR');
			};
			$table2->printRow();
			$a++;
		};
		$table2->endTable(5);
		
		//Tanda Tangan
		$table2=new easyTable($pdf, '{33,5,33,33,5,33,25,5,80}');
			$table2->rowStyle('font-size:12');
			$table2->easyCell('Mengetahui/Menyetujui','colspan:8;align:L;font-style:B');
			$table2->easyCell('Gabuswetan, ......................................','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('Kepala Sekolah','colspan:8;align:L;font-style:B');
			$table2->easyCell('Bendahara','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:12');
			$table2->easyCell('UMAR ALI, S.Pd.','colspan:8;align:L;font-style:B');
			$table2->easyCell('ECI CUNIAH, S.Pd.','align:L;font-style:B');
			$table2->printRow();
		$table2->endTable();
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>