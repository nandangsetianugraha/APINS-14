<?php 
require_once '../../config/db.php';
$kelas=$_REQUEST['kelas'];
$mpid=$_REQUEST['mp'];
$tapel=$_REQUEST['tapel'];
$smt=$_REQUEST['smt'];
$idp=$_REQUEST['pdid'];
$ab=substr($kelas, 0, 1);
$validator = array('success' => false, 'messages' => array());

	$nm=mysqli_fetch_array(mysqli_query($koneksi, "select * from siswa where peserta_didik_id='$idp'"));
	$adar=mysqli_num_rows(mysqli_query($koneksi, "select * from raport_k13 where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and jns='k4'"));
		$sqkd=mysqli_query($koneksi, "select * from kd where kelas='$ab' and aspek='4' and mapel='$mpid'");
		$ra1=0;$ra2=0;
		while($ze=mysqli_fetch_array($sqkd)){
			$kd1=$ze['kd'];
			$sqln1=mysqli_fetch_array(mysqli_query($koneksi, "select avg(nilai) as rni from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and kd='$kd1'"));
			$nak=$sqln1['rni'];
			$ra1=$ra1+$nak;
			if($nak>0){
				$ra2=$ra2+1;
			};
			$bbb=mysqli_query($koneksi, "select * from nk_temp where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and kd='$kd1'");
			$chin=mysqli_num_rows($bbb);
			$sqin=mysqli_fetch_array($bbb);
			if($chin>0){
				$idtemp=$sqin['id_nh'];
				if($nak>0)
					mysqli_query($koneksi, "update nk_temp set nph='$nak' where id_nh='$idtemp'");
			}else{
				if($nak>0)
					mysqli_query($koneksi, "insert into nk_temp(id_pd,kelas,smt,tapel,mapel,kd,nph) values('$idp','$ab','$smt','$tapel','$mpid','$kd1','$nak')");
			};
		}; //kd
		if($ra2>0){
			$nakhir=round($ra1/$ra2,0);
		}else{
			$nakhir=0;
		};
		$mkkm=mysqli_fetch_array(mysqli_query($koneksi, "select min(nilai) as kkmsekolah from kkm where tapel='$tapel'"));
		if(empty($mkkm['kkmsekolah'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$mkkm['kkmsekolah'];
		};
		$jarak=round((100-$kkmsaya)/3,0);
		$renC=$kkmsaya;
		$renB=$renC+$jarak;
		$renA=$renB+$jarak;
		if($nakhir>$renA){
			$predikat="A";
		}elseif($nakhir>$renB){
			$predikat="B";
		}elseif($nakhir>=$renC){
			$predikat="C";
		}else{
			$predikat="D";
		};
		$nakhir=number_format($nakhir,0);
		$smax=mysqli_fetch_array(mysqli_query($koneksi, "select * from nk_temp where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' order by nph desc limit 1"));
		$smin=mysqli_fetch_array(mysqli_query($koneksi, "select * from nk_temp where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' order by nph asc limit 1"));
		$kdmax=$smax['kd'];
		$kdx=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd where kelas='$kelas' and aspek='4' and mapel='$mpid' and kd='$kdmax'"));
		$kdmin=$smin['kd'];
		$kdm=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd where kelas='$kelas' and aspek='4' and mapel='$mpid' and kd='$kdmin'"));
		if($smax['nph']==$smin['nph']){
			if($smax['nph']>$renA){
				$desk="Alhamdulillah, Ananda ".$nm['nama']." Sangat Baik dalam ".$kdx['nama_kd'];
			}elseif($smax['nph']>$renB){
				$desk="Alhamdulillah, Ananda ".$nm['nama']." Baik dalam ".$kdx['nama_kd'];
			}elseif($smax['nph']>$renC){
				$desk="Alhamdulillah, Ananda ".$nm['nama']." Cukup Baik dalam ".$kdx['nama_kd'];
			}else{
				$desk="Alhamdulillah, Ananda ".$nm['nama']." Perlu Bimbingan dalam ".$kdx['nama_kd'];
			};
		}else{
			if($smax['nph']>$renA){
				$pmax=4;
				$dmax="Sangat Baik";
			}elseif($smax['nph']>$renB){
				$pmax=3;
				$dmax="Baik";
			}elseif($smax['nph']>$renC){
				$pmax=2;
				$dmax="Cukup Baik";
			}else{
				$pmax=1;
				$dmax="Perlu Bimbingan";
			};
			if($smin['nph']>$renA){
				$pmin=4;
				$dmin="Sangat Baik";
			}elseif($smin['nph']>$renB){
				$pmin=3;
				$dmin="Baik";
			}elseif($smin['nph']>$renC){
				$pmin=2;
				$dmin="Cukup Baik";
			}else{
				$pmin=1;
				$dmin="Perlu Bimbingan";
			};
			if($pmax==$pmin){
				$desk="Alhamdulillah, Ananda ".$nm['nama']." ".$dmax." dalam ".$kdx['nama_kd']." dan ".$kdm['nama_kd'];
			}else{
				$desk="Alhamdulillah, Ananda ".$nm['nama']." ".$dmax." dalam ".$kdx['nama_kd']." , ".$dmin." dalam ".$kdm['nama_kd'];
			};
		};
		$desk=mysqli_real_escape_string($koneksi,$desk);
		$ada=mysqli_num_rows(mysqli_query($koneksi, "select * from raport_k13 where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and jns='k4'"));
		$srapor=mysqli_fetch_array(mysqli_query($koneksi, "select * from raport_k13 where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and jns='k4'"));
		if($ada>0){
			$idn=$srapor['id_raport'];
			mysqli_query($koneksi, "UPDATE raport_k13 SET nilai='$nakhir',predikat='$predikat',deskripsi='$desk' WHERE id_raport='$idn'");
		}else{
			mysqli_query($koneksi, "INSERT INTO raport_k13(id_pd,kelas,smt,tapel,mapel,jns,nilai,predikat,deskripsi) VALUES('$idp','$ab','$smt','$tapel','$mpid','k4','$nakhir','$predikat','$desk')");
		};
		mysqli_query($koneksi, "DELETE FROM nk_temp WHERE id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mpid'");

$validator['success'] = true;
$validator['messages'] = "Rapor Ketrampilan atas nama ".$nm['nama']." berhasil di Generate!";
echo json_encode($validator);