<?php
include("../config/db.php");
$provinsi_id = $_GET['prov_id'];
$sql_mk=mysqli_query($koneksi, "select * from kabupaten where id_provinsi='$provinsi_id'");
echo "<option value='0'>Pilih Kabupaten</option>";
while($nk=mysqli_fetch_array($sql_mk)){
  echo "<option data-nilai='".$nk['nama']."' value='".$nk['id']."'>".$nk['nama']."</option>";
}
?>