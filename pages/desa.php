<?php
include("../config/db.php");
$id_kec = $_GET['id_kecamatan'];
$sql_mk=mysqli_query($koneksi, "select * from desa where id_kecamatan='$id_kec'");
echo "<option value='0'>Pilih Desa</option>";
while($nk=mysqli_fetch_array($sql_mk)){
  echo "<option data-nilai='".$nk['nama']."' value='".$nk['id']."'>".$nk['nama']."</option>";
}
?>