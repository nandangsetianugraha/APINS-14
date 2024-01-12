<?php
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
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../inc/db_connect.php';
 $bulan1 = array ('Januari',
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
	$tanggal=$_GET['tanggal'];
	$bulan=substr($tanggal,5,2);
	$tahun=substr($tanggal,0,4);
	$kelas=$_GET['kelas'];
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
	if(empty($bulan) || empty($tahun)){
	}else{
		$hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
		$namafilenya="Absensi Kelas ".$kelas." Bulan ".$bulan1[(int)$bulan-1].".pdf";
		$pdf=new exFPDF('L','mm',array(330,215));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',12);

		$table2=new easyTable($pdf, 2);
		$table2->easyCell('DAFTAR ABSENSI KELAS '.$kelas,'align:L;font-style:B');
		$table2->easyCell('','align:R');
		$table2->printRow();
		$table2->easyCell('Bulan : '.$bulan1[(int)$bulan-1],'align:L;');
		$table2->easyCell('Tahun '.$tahun,'align:R');
		$table2->printRow();
		$table2->endTable();
		if($hari==31){
			$table3=new easyTable($pdf, '{85, 6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,8,8,8, 15}','align:L;border:1');
			$table3->rowStyle('font-size:10');
			$table3->easyCell('Nama Siswa','rowspan:2;align:C');
			$table3->easyCell('Tanggal','colspan:31;align:C');
			$table3->easyCell('Absensi','colspan:3;align:C');
			$table3->easyCell('Jumlah','rowspan:2;align:C');
			$table3->printRow();
			$table3->rowStyle('font-size:10');
			for ($i=1; $i < 32; $i++) { 
			  $table3->easyCell($i,'align:C');
			};
			$table3->easyCell('S','align:C');
			$table3->easyCell('I','align:C');
			$table3->easyCell('A','align:C');
			$table3->printrow(true);
		}elseif($hari==30){
			$table3=new easyTable($pdf, '{91, 6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,8,8,8, 15}','align:L;border:1');
			$table3->rowStyle('font-size:10');
			$table3->easyCell('Nama Siswa','rowspan:2;align:C');
			$table3->easyCell('Tanggal','colspan:30;align:C');
			$table3->easyCell('Absensi','colspan:3;align:C');
			$table3->easyCell('Jumlah','rowspan:2;align:C');
			$table3->printRow();
			$table3->rowStyle('font-size:10');
			for ($i=1; $i < 31; $i++) { 
			  $table3->easyCell($i,'align:C');
			};
			$table3->easyCell('S','align:C');
			$table3->easyCell('I','align:C');
			$table3->easyCell('A','align:C');
			$table3->printrow(true);
		}elseif($hari==29){
			$table3=new easyTable($pdf, '{97, 6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,8,8,8, 15}','align:L;border:1');
			$table3->rowStyle('font-size:10');
			$table3->easyCell('Nama Siswa','rowspan:2;align:C');
			$table3->easyCell('Tanggal','colspan:29;align:C');
			$table3->easyCell('Absensi','colspan:3;align:C');
			$table3->easyCell('Jumlah','rowspan:2;align:C');
			$table3->printRow();
			$table3->rowStyle('font-size:10');
			for ($i=1; $i < 30; $i++) { 
			  $table3->easyCell($i,'align:C');
			};
			$table3->easyCell('S','align:C');
			$table3->easyCell('I','align:C');
			$table3->easyCell('A','align:C');
			$table3->printrow(true);
		}else{
			$table3=new easyTable($pdf, '{103, 6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,8,8,8, 15}','align:L;border:1');
			$table3->rowStyle('font-size:10');
			$table3->easyCell('Nama Siswa','rowspan:2;align:C');
			$table3->easyCell('Tanggal','colspan:28;align:C');
			$table3->easyCell('Absensi','colspan:3;align:C');
			$table3->easyCell('Jumlah','rowspan:2;align:C');
			$table3->printRow();
			$table3->rowStyle('font-size:10');
			for ($i=1; $i < 29; $i++) { 
			  $table3->easyCell($i,'align:C');
			};
			$table3->easyCell('S','align:C');
			$table3->easyCell('I','align:C');
			$table3->easyCell('A','align:C');
			$table3->printrow(true);
		}
		$skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
		$qkl = $connect->query($skl);
		$ssakit=0;$sijin=0;$salfa=0;
		while($sis=$qkl->fetch_assoc()){
			$idp=$sis['peserta_didik_id'];
			$sw=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
			$snama=$connect->query("select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where MONTH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and peserta_didik_id='$idp'")->fetch_assoc();
			if(empty($snama['sakit'])){
				$sakit=0;
			}else{
				$sakit=$snama['sakit'];
			};
			if(empty($snama['ijin'])){
				$ijin=0;
			}else{
				$ijin=$snama['ijin'];
			};
			if(empty($snama['alfa'])){
				$alfa=0;
			}else{
				$alfa=$snama['alfa'];
			};
			//$sikap->rowStyle('font-size:12; min-height:35');
			$table3->rowStyle('font-size:10; min-height:8');
			$table3->easyCell($sw['nama'],'align:L;valign:M');
			for ($i=1; $i < $hari+1; $i++) { 
				if($i>9){
					$ab=$i;
				}else{
					$ab="0".$i;
				};
				$ttt=$tahun."-".$bulan."-".$ab;
				$absen=$connect->query("select * from absensi where tanggal='$ttt' and peserta_didik_id='$idp'")->fetch_assoc();
				if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
					$table3->easyCell('','bgcolor:#acaeaf;');
				}else{
					if(empty($absen['absensi'])){
						$an="";
					}else{
						$an=$absen['absensi'];
					};
					$table3->easyCell($an,'align:C;valign:M');
				};
				
			};
			$jabs=$connect->query("select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where MONTH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and peserta_didik_id='$idp'")->fetch_assoc();
			$ssakit=$ssakit+$jabs['sakit'];
			$sijin=$sijin+$jabs['ijin'];
			$salfa=$salfa+$jabs['alfa'];
          	if($sakit==0){
              	$table3->easyCell('','align:C;valign:M');
            }else{
            	$table3->easyCell($sakit,'align:C;valign:M');
            };
          	if($ijin==0){
              	$table3->easyCell('','align:C;valign:M');
            }else{
              	$table3->easyCell($ijin,'align:C;valign:M');
            };
          	if($alfa==0){
              	$table3->easyCell('','align:C;valign:M');
            }else{
              	$table3->easyCell($alfa,'align:C;valign:M');
            };
          	$jabs=$sakit+$ijin+$alfa;
          	if($jabs==0){
              	$table3->easyCell('','align:C;valign:M');
            }else{
              	$table3->easyCell($jabs,'align:C;valign:M');
            }
			$table3->printrow();
		};
		//selesai isi tabel siswa
		
		//Jumlahkan Sakit
		$table3->rowStyle('font-size:10');
		$table3->easyCell('SAKIT','align:R');
		for ($i=1; $i < $hari+1; $i++) { 
			if($i>9){
				$ab=$i;
			}else{
				$ab="0".$i;
			};
			$ttt=$tahun."-".$bulan."-".$ab;
			$skl1 = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
			$qkl1 = $connect->query($skl1);
				$jsakit=0;
				$jijin=0;
				$jalfa=0;
				while($mk=$qkl1->fetch_assoc()){
					$pds=$mk['peserta_didik_id'];
					$jab=$connect->query("select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where tanggal='$ttt' and peserta_didik_id='$pds'")->fetch_assoc();
					$jsakit=$jsakit+$jab['sakit'];
					$jijin=$jijin+$jab['ijin'];
					$jalfa=$jalfa+$jab['alfa'];
				};
				$jkeh=$jsakit+$jijin+$jalfa;
			//$absen=$connect->query("select * from absensi where tanggal='$tahun-$bulan-$ab'")->fetch_assoc();
			if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
				$table3->easyCell('','bgcolor:#acaeaf;');
			}else{
              	if($jsakit==0){
                  	$table3->easyCell('','align:C');
                }else{
                  	$table3->easyCell($jsakit,'align:C');
                };
			};
		};
      	if($ssakit==0){
          	$table3->easyCell('','align:C');
        }else{
			$table3->easyCell($ssakit,'align:C');
        };
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		if($ssakit==0){
          	$table3->easyCell('','align:C');
        }else{
			$table3->easyCell($ssakit,'align:C');
        };
		$table3->printrow();
		
		//Jumlahkan Ijin
		$table3->rowStyle('font-size:10');
		$table3->easyCell('IJIN','align:R');
		for ($i=1; $i < $hari+1; $i++) { 
			if($i>9){
				$ab=$i;
			}else{
				$ab="0".$i;
			};
			$ttt=$tahun."-".$bulan."-".$ab;
			$skl1 = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
			$qkl1 = $connect->query($skl1);
				$jsakit=0;
				$jijin=0;
				$jalfa=0;
				while($mk=$qkl1->fetch_assoc()){
					$pds=$mk['peserta_didik_id'];
					$jab=$connect->query("select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where tanggal='$ttt' and peserta_didik_id='$pds'")->fetch_assoc();
					$jsakit=$jsakit+$jab['sakit'];
					$jijin=$jijin+$jab['ijin'];
					$jalfa=$jalfa+$jab['alfa'];
				};
				$jkeh=$jsakit+$jijin+$jalfa;
			//$absen=$connect->query("select * from absensi where tanggal='$tahun-$bulan-$ab'")->fetch_assoc();
			if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
				$table3->easyCell('','bgcolor:#acaeaf;');
			}else{
              	if($jijin==0){
                  	$table3->easyCell('','align:C');
                }else{
					$table3->easyCell($jijin,'align:C');
                }
			};
		};
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
      	if($sijin==0){
          	$table3->easyCell('','align:C');
        }else{
			$table3->easyCell($sijin,'align:C');
        };
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		if($sijin==0){
          	$table3->easyCell('','align:C');
        }else{
			$table3->easyCell($sijin,'align:C');
        };
		$table3->printrow(); 
		
		//Jumlahkan ALFA
		$table3->rowStyle('font-size:10');
		$table3->easyCell('TANPA KETERANGAN','align:R');
		for ($i=1; $i < $hari+1; $i++) { 
			if($i>9){
				$ab=$i;
			}else{
				$ab="0".$i;
			};
			$ttt=$tahun."-".$bulan."-".$ab;
			$skl1 = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
			$qkl1 = $connect->query($skl1);
				$jsakit=0;
				$jijin=0;
				$jalfa=0;
				while($mk=$qkl1->fetch_assoc()){
					$pds=$mk['peserta_didik_id'];
					$jab=$connect->query("select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where tanggal='$ttt' and peserta_didik_id='$pds'")->fetch_assoc();
					$jsakit=$jsakit+$jab['sakit'];
					$jijin=$jijin+$jab['ijin'];
					$jalfa=$jalfa+$jab['alfa'];
				};
				$jkeh=$jsakit+$jijin+$jalfa;
			//$absen=$connect->query("select * from absensi where tanggal='$tahun-$bulan-$ab'")->fetch_assoc();
			if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
				$table3->easyCell('','bgcolor:#acaeaf;');
			}else{
              	if($jalfa==0){
                  	$table3->easyCell('','align:C');
                }else{
					$table3->easyCell($jalfa,'align:C');
                }
			};
		};
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
      	if($salfa==0){
          	$table3->easyCell('','align:C');
          	$table3->easyCell('','align:C');
        }else{
          	$table3->easyCell($salfa,'align:C');
          	$table3->easyCell($salfa,'align:C');
        }
		$table3->printrow(); 
		
		//Jumlahkan TOTAL
		$table3->rowStyle('font-size:10');
		$table3->easyCell('TOTAL ABSENSI','align:R');
		for ($i=1; $i < $hari+1; $i++) { 
			if($i>9){
				$ab=$i;
			}else{
				$ab="0".$i;
			};
			$ttt=$tahun."-".$bulan."-".$ab;
			$skl1 = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
			$qkl1 = $connect->query($skl1);
				$jsakit=0;
				$jijin=0;
				$jalfa=0;
				while($mk=$qkl1->fetch_assoc()){
					$pds=$mk['peserta_didik_id'];
					$jab=$connect->query("select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where tanggal='$ttt' and peserta_didik_id='$pds'")->fetch_assoc();
					$jsakit=$jsakit+$jab['sakit'];
					$jijin=$jijin+$jab['ijin'];
					$jalfa=$jalfa+$jab['alfa'];
				};
				$jkeh=$jsakit+$jijin+$jalfa;
			//$absen=$connect->query("select * from absensi where tanggal='$tahun-$bulan-$ab'")->fetch_assoc();
			if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
				$table3->easyCell('','bgcolor:#acaeaf;');
			}else{
              	if($jkeh==0){
                  	$table3->easyCell('','align:C;bgcolor:#acaeaf;');
                }else{
                  	$table3->easyCell($jkeh,'align:C;bgcolor:#acaeaf;');
                };
			};
		};
      	if($ssakit==0){
          	$table3->easyCell('','align:C;bgcolor:#acaeaf;');
        }else{
          	$table3->easyCell($ssakit,'align:C;bgcolor:#acaeaf;');
        };
      	if($sijin==0){
          	$table3->easyCell('','align:C;bgcolor:#acaeaf;');
        }else{
          	$table3->easyCell($sijin,'align:C;bgcolor:#acaeaf;');
        };
      	if($salfa==0){
          	$table3->easyCell('','align:C;bgcolor:#acaeaf;');
        }else{
          	$table3->easyCell($salfa,'align:C;bgcolor:#acaeaf;');
        };
      	$stot=$ssakit+$sijin+$salfa;
     	if($stot==0){
          	$table3->easyCell('','align:C;bgcolor:#acaeaf;');
        }else{
          	$table3->easyCell($stot,'align:C;bgcolor:#acaeaf;');
        };
		$table3->printrow(); 
		
		$table3->endTable(5);
		$tots=$ssakit+$sijin+$salfa;
		$total=$connect->query("select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt'")->num_rows;
		$efek=$connect->query("select * from hari_efektif where bulan='$bulan' and tapel='$tapel'")->fetch_assoc();
		if($efek['hari']==0){
			$harim=23;
		}else{
			$harim=$efek['hari'];
		};
		$hefek=round(($tots*100)/($harim*$total),2);		
		
		//Tertanda Wali Kelas 
		$ttd=new easyTable($pdf, '{50,71,6,72,111}');
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('Jumlah Absensi');
		$ttd->easyCell(':');
		$ttd->easyCell($tots);
		$ttd->easyCell('Gabuswetan, '.$hari.' '.$bulan1[(int)$bulan-1].' '.$tahun,'align:C; valign:T');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('Jumlah Siswa');
		$ttd->easyCell(':');
		$ttd->easyCell($total);
		$ttd->easyCell('Guru Kelas '.$kelas,'align:C; valign:T');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('Jumlah Hari Efektif');
		$ttd->easyCell(':');
		$ttd->easyCell($harim.' Hari');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('Prosentase Absensi');
		$ttd->easyCell(':');
		$ttd->easyCell($hefek.' %');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$nromb=$connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$idwks=$nromb['wali_kelas'];
		$wks=$connect->query("select * from ptk where ptk_id='$idwks'")->fetch_assoc();
		if($wks['gelar']==''){
			$namawali=strtoupper($wks['nama']);
		}else{
			$namawali=strtoupper($wks['nama']).', '.$wks['gelar'];
		};
		$ttd->easyCell($namawali,'align:C; valign:T;border:B');
		$ttd->printRow();
		$ttd->endTable();
		
			//$pdf->Output();  
			$pdf->Output();
	}
?>