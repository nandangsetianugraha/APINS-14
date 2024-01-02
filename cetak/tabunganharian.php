<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
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
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
};
	$tanggal=$_GET['tanggal'];
		$namafilenya="Rekapitulasi Tabungan ".$tanggal.".pdf";
		$pdf=new exFPDF('P','mm',array(215,330));
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
		$table2->easyCell('REKAPITULASI TABUNGAN','align:C;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:11');
		$table2->easyCell(TanggalIndo($tanggal),'align:C;font-style:B');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{100, 17, 49, 49}','border:1');
		$table2->easyCell('Nama Nasabah','align:C;font-style:B');
		$table2->easyCell('Kode','align:C;font-style:B');
		$table2->easyCell('Setor','align:C;font-style:B');
		$table2->easyCell('Ambil','align:C;font-style:B');
		$table2->printRow(true);
		$skl = "select * from tabungan where tanggal='$tanggal' order by id asc";
		$qkl = $connect->query($skl);
		$ada=$qkl->num_rows;
		if($ada>0){
		while($sis=$qkl->fetch_assoc()){
			$nnas=$sis['nasabah_id'];
			$nsis=$connect->query("select * from nasabah where nasabah_id='$nnas'")->fetch_assoc();
			$table2->easyCell($nsis['nama'],'align:L');
			$table2->easyCell($sis['kode'],'align:C');
			$table2->easyCell(rupiah($sis['masuk']),'align:R');
			$table2->easyCell(rupiah($sis['keluar']),'align:R');
			$table2->printRow();
		};
		}else{
			$table2->rowStyle('font-size:12');
			$table2->easyCell('Tidak ada Setoran','colspan:4;align:C;font-style:B');
			$table2->printRow();
		};
		$jsetor=$connect->query("select sum(masuk) as setor from tabungan where tanggal='$tanggal'")->fetch_assoc();
		$jtarik=$connect->query("select sum(keluar) as ambil from tabungan where tanggal='$tanggal'")->fetch_assoc();
		$debet=$jsetor['setor'];
		$kredit=$jtarik['ambil'];
		$total=$debet-$kredit;
		$table2->easyCell('Jumlah','colspan:2;align:R;font-style:B');
		$table2->easyCell(rupiah($debet),'align:R;font-style:B');
		$table2->easyCell(rupiah($kredit),'align:R;font-style:B');
		$table2->printRow();
		$table2->easyCell('Total Setoran','colspan:2;align:R;font-style:B');
		$table2->easyCell(rupiah($total),'colspan:2;align:R;font-style:B');
		$table2->printRow();
		$table2->endTable();
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>