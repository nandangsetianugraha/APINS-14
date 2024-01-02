<?php
function compress($source, $destination, $quality){
	$info = getimagesize($source);
	if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);
	elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source);
	elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source);
	imagejpeg($image, $destination, $quality);
	return $destination;
};
function UploadGambar($img_name){
	header("Content-type: image/jpeg");
	 
	//tempat direktory gambar
	$vdir_upload = "image/";
	$vfile_upload = $vdir_upload . $img_name;
	 
	//Simpan gambar dalam ukuran asli
	move_uploaded_file($_FILES["img"]["tmp_name"], $vfile_upload);
	 
	//identitas file asli
	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height
	= imageSY($im_src);
	 
	//Simpan dalam versi small 110px
	$dst_width = 110;
	$dst_height = ($dst_width/$src_width)*$src_height;
	 
	//proses perubahan ukuran
	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
	 
	//Simpan gambar
	imagejpeg($im,$vdir_upload . "small_" . $img_name);
	 
	//Simpan dalam ukuran medium 320px
	$dst_width = 320;
	$dst_height = ($dst_width/$src_width)*$src_height;
	 
	//proses untuk perubahan ukuran
	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
	 
	//menyimpan gambar
	imagejpeg($im,$vdir_upload . "medium_" . $img_name);
	 
	imagedestroy($im_src);
	imagedestroy($im);
}
require_once "../config/db_connect.php";
header('Content-Type: application/json');
$idp=strip_tags($connect->real_escape_string($_GET['idptk']));

if(isset($_FILES['image']['type'])){

	$validextensions = array('jpeg', 'jpg', 'png');
	$temporary = explode('.', $_FILES['image']['name']);
	$file_extension = end($temporary);

	if (

		(($_FILES['image']['type'] == 'image/png') || 
		($_FILES['image']['type'] == 'image/jpg') || 
		($_FILES['image']['type'] == 'image/jpeg'))

		&& 
		
		($_FILES['image']['size'] < 600000)//Approx. 100kb files can be up.
		
		&& 
		
		in_array($file_extension, $validextensions)){

		if ($_FILES['image']['error'] > 0){

			$data = array(
				'error' => $_FILES['image']['error']
				);

			echo json_encode($data);

		}else{
			
			if (file_exists('ptk/' . $_FILES['image']['name'])) {

				$data = array(
					'error' => $_FILES['image']['name'] . ' already exists' 
				);
			
				echo json_encode($data);
			
			}else{
				$exte = $_FILES['image']['type'];
				$imageName = 'avatar_'.rand(). '.png';
				$filename = $_FILES['image']['name'];
				$sourcePath = $_FILES['image']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = 'ptk/'.$imageName; // Target path where file is to be stored
				
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Up file
				
				$resultset=$connect->query("SELECT * FROM ptk WHERE ptk_id = '$idp'")->num_rows;
				if($resultset>0) {     
					$ava=$connect->query("SELECT * FROM ptk WHERE ptk_id = '$idp'")->fetch_assoc();
					$flama=$ava['gambar'];
					$hapusFile = "./ptk/".$flama;
					if(file_exists($hapusFile)){
						unlink($hapusFile);
					};
					$namaGBR=strip_tags($connect->real_escape_string($imageName));
					$sql_update = "UPDATE ptk set gambar='$namaGBR' WHERE ptk_id = '$idp'";
					$query1 = $connect->query($sql_update);
				};
				
				$data = array(
					'message'	=> 'Image Up Successfully',
					'image' 		=> $targetPath
				);
			
				echo json_encode($data);
			}
		}

	}else{

		$data = array(
			'error'	=> 'Invalid file Size or Type',
		);
	
		echo json_encode($data);

	}
}
?>