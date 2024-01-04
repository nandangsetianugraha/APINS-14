<?php
include("../config/db.php");
$id_kab = $_GET['id_kabupaten'];
$sql_mk=mysqli_query($koneksi, "select * from kecamatan where id_kabupaten='$id_kab'");
echo "<option value='0'>Pilih Kecamatan</option>";
while($nk=mysqli_fetch_array($sql_mk)){
  echo "<option data-nilai='".$nk['nama']."' value='".$nk['id']."'>".$nk['nama']."</option>";
}
?>