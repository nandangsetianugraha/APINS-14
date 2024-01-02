<?php

//insert.php

if(isset($_POST["image"]))
{
	include('../config/config.php');
 include('../config/db.php');
 $idp=$_GET['idp'];
 $data = $_POST["image"];
 $image_array_1 = explode(";", $data);
 $image_array_2 = explode(",", $image_array_1[1]);
 $data = base64_decode($image_array_2[1]);
 $imageName = time() . '.png';
 file_put_contents('siswa/'.$imageName, $data);
 //file_put_contents('siswa/'.$imageName, $data);
 //$image_file = addslashes(file_get_contents('siswa/'.$imageName));
 $sql_query = "SELECT * FROM siswa WHERE peserta_didik_id = '".mysqli_escape_string($koneksi, $idp)."'";		
		$resultset = mysqli_query($koneksi, $sql_query) or die("database error:". mysqli_error($koneksi));		
		if(mysqli_num_rows($resultset)) {     
			$ava=mysqli_fetch_array($resultset);
			$flama=$ava['avatar'];
			$hapusFile = "siswa/".$flama;
			if(file_exists($hapusFile)){
				unlink($hapusFile);
			};
			$sql_update = "UPDATE siswa set avatar='".mysqli_escape_string($koneksi,$imageName)."' WHERE peserta_didik_id = '".mysqli_escape_string($koneksi, $idp)."'";
			mysqli_query($koneksi, $sql_update) or die("database error:". mysqli_error($koneksi));
		};
	echo '<img src="'.base_url().'images/siswa/'.$imageName.'" alt="..." class="rounded-circle profile-widget-picture">';

}

?>