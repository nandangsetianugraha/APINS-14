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

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
};
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
	
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
    
};

	$tglawal=$_GET['tglawal'];
	$tglakhir=$_GET['tglakhir'];
	$jenis=$_GET['jenis'];
	$tapel=$_GET['tapel'];
		$pdf=new exFPDF('L','mm',array(215,330));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, '{30,300}');
		$table2->easyCell('','img:logo.jpg,w20;rowspan:4;align:C;border:B');
		$table2->easyCell('SD ISLAM AL-JANNAH','font-size:14;align:L;');
		$table2->printRow();
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan','align:L');
		$table2->printRow();
		$table2->easyCell('Kab. Indramayu - Jawa Barat 45263 Telp. (0234) 5508501','align:L');
		$table2->printRow();
		$table2->easyCell('Website: https://sdi-aljannah.web.id Email: sdi.aljannah@gmail.com','align:L;border:B');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{330}', 'align:C');
		$table2->easyCell('LAPORAN PENERIMAAN PEMBAYARAN SISWA','align:C');
		$table2->printRow();
		$table2->easyCell('TANGGAL '.$tglawal.' SAMPAI '.$tglakhir,'align:C');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{60,5,265}', 'align:L');
		$table2->easyCell('Petugas','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Ika Yuliani','align:L');
		$table2->printRow();
		$table2->easyCell('Metode Transaksi','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Tunai','align:L');
		$table2->printRow();
		if($jenis==0){
			$jenisnya='Semua Pos';
		}else{
			$jlap=$connect->query("select * from jenis_tunggakan where id_tunggakan='$jenis'")->fetch_assoc();
			$jenisnya=$jlap['nama_tunggakan'];
		};
		$table2->easyCell('Pos Penerimaan','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell($jenisnya,'align:L');
		$table2->printRow();
		$table2->endTable();
		if($jenis==0){
			$sql11="select * from pembayaran where tanggal >= '$tglawal' and tanggal <= '$tglakhir' and tapel='$tapel' group by tanggal";
		}else{
			$sql11="select * from pembayaran where tanggal >= '$tglawal' and tanggal <= '$tglakhir' and tapel='$tapel' and jenis='$jenis' group by tanggal";
		};
		$query11 = $connect->query($sql11);
		while($r = $query11->fetch_assoc()){
			$tgls=$r['tanggal'];
			$table2=new easyTable($pdf, '{15,30,110,15,40,90,40}', 'align:C');
			$table2->easyCell('Tanggal : '.$tgls,'colspan:7;align:L');
			$table2->printRow();
			if($jenis==0){
				$sql12="select * from pembayaran where tanggal = '$tgls' and tapel='$tapel'";
			}else{
				$sql12="select * from pembayaran where tanggal = '$tgls' and tapel='$tapel' and jenis='$jenis'";
			};
			$query12 = $connect->query($sql12);
			$urut=0;
			$table2->easyCell('No','align:L;border:BT');
			$table2->easyCell('Nomor Induk','align:L;border:BT');
			$table2->easyCell('Nama Siswa','align:L;border:BT');
			$table2->easyCell('Kelas','align:L;border:BT');
			$table2->easyCell('Nomor Transaksi','align:L;border:BT');
			$table2->easyCell('Deskripsi','align:L;border:BT');
			$table2->easyCell('Jumlah Penerimaan','align:L;border:BT');
			$table2->printRow(true);
			while($s = $query12->fetch_assoc()){
				$urut=$urut+1;
				$idps=$s['peserta_didik_id'];
				$nm=$connect->query("select * from siswa where peserta_didik_id='$idps'")->fetch_assoc();
				$kls=$connect->query("select * from penempatan where peserta_didik_id='$idps' and tapel='$tapel'")->fetch_assoc();
				$table2->easyCell($urut,'align:L');
				$table2->easyCell($nm['nis'],'align:L');
				$table2->easyCell($nm['nama'],'align:L');
				$table2->easyCell($kls['rombel'],'align:L');
				$table2->easyCell($s['id_invoice'],'align:L');
				$table2->easyCell($s['deskripsi'],'align:L');
				$table2->easyCell(rupiah($s['bayar']),'align:R');
				$table2->printRow();
			};
			$table2->easyCell('','colspan:5;align:L');
			$table2->easyCell('Sub Total Tanggal '.$r['tanggal'],'align:L;border:BT');
			if($jenis==0){
				$subt=$connect->query("select sum(bayar) as total from pembayaran where tanggal = '$tgls' and tapel='$tapel'")->fetch_assoc();
			}else{
				$subt=$connect->query("select sum(bayar) as total from pembayaran where tanggal = '$tgls' and tapel='$tapel' and jenis='$jenis'")->fetch_assoc();
			};
			$table2->easyCell(rupiah($subt['total']),'align:R;border:BT');
			$table2->printRow();
			$table2->endTable();
		}
		
		$table2=new easyTable($pdf, '{15,30,110,15,40,90,40}', 'align:C');
		$table2->easyCell('','colspan:5;align:L');
		$table2->easyCell('','align:L;border:B');
		$table2->easyCell('','align:L;border:B');
		$table2->printRow();
		
		$table2->easyCell('','colspan:5;align:L');
		$table2->easyCell('Grand Total','align:L;border:B');
		if($jenis==0){
			$subtg=$connect->query("select sum(bayar) as gtotal from pembayaran where tanggal >= '$tglawal' and tanggal <= '$tglakhir' and tapel='$tapel'")->fetch_assoc();
		}else{
			$subtg=$connect->query("select sum(bayar) as gtotal from pembayaran where tanggal >= '$tglawal' and tanggal <= '$tglakhir' and tapel='$tapel' and jenis='$jenis'")->fetch_assoc();
		};
		$table2->easyCell(rupiah($subtg['gtotal']),'align:R;border:B');
		$table2->printRow();
		$table2->endTable();
	
		
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>