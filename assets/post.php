<?php
$banner=$_FILES['UserImgfile']['name'];	
$filetype=$_FILES['UserImgfile']['type'];
 
//check file type
if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif' or $filetype=='image/jpg')
{
		// Check file size
		if ($_FILES["UserImgfile"]["size"] > 1000000) {
			echo "file size should be less than 1MB";
		}else{
			$bannerpath="images/".$banner;
			move_uploaded_file($_FILES["UserImgfile"]["tmp_name"],$bannerpath);
			//echo "File uploaded successfully";
			?>
			<img src="images/<?php echo $banner; ?>"/>
			<p class="text-center">Image Preview</p>
			<?php
		}
}else{
	echo "File should be jpg, jpeg, gif and png";
}
?>