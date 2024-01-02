<?phprequire_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];$mp=$_GET['mp'];$smt=$_GET['smt'];
$ab=substr($kelas,0,1);$sql = "select * from lingkup_materi where kelas='$ab' and smt='$smt' and mapel='$mp' order by lm asc";$query = $connect->query($sql);echo "<option value='0'>Pilih Materi</option>";while($s=$query->fetch_assoc()) {	$mpid=$s['id_mapel'];	if(($ab==1 and $mpid==5)){			}else{		echo "<option value='".$s['lm']."'>[".$s['lm']."] ".$s['nama_lm']."</option>";	}}
?>