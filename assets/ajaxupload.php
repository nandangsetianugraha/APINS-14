<?php
require_once '../config/db_connect.php';
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'images/'; // upload directory

    $img = $_FILES['userImage']['name'];
		$tmp = $_FILES['userImage']['tmp_name'];
		$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		$final_image = rand(1000,1000000).$img;
		if(in_array($ext, $valid_extensions)) { 
			$path = $path.strtolower($final_image); 
			
        if(move_uploaded_file($tmp,$path)) {
			$sql = "UPDATE konfigurasi SET image_login='$path' WHERE id_conf='1'";
				$query = $connect->query($sql);
?>
		<img src="<?=base_url();?>assets/<?=$path;?>" width="50%" />
<?php
        }
		}
    

?>