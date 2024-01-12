<?php 

# check if image sent
if (isset($_FILES['my_image'])) {

	# database connection file
	include "../config/db_connect.php";
	
	# getting image data and store them in var
	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error    = $_FILES['my_image']['error'];

	# if there is not error occurred while uploading
	if ($error === 0) {
		if ($img_size > 1000000) {
			# error message
			$em = "Sorry, your file is too large.";

			# response array
			$error = array('error' => 1, 'em'=> $em);

			/** 
		    printing out php array and 
		    converting it into JSON format
		    **/

		    echo json_encode($error);
		    exit();
		}else {
			# get image extension store it in var
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

			/** 
			convert the image extension into lower case 
			and store it in var 
			**/
			$img_ex_lc = strtolower($img_ex);

			/** 
			crating array that stores allowed
			to upload image extensions.
			**/
			$allowed_exs = array("jpg", "jpeg", "png");

			/** 
			check if the the image extension 
			is present in $allowed_exs array
			**/
			if (in_array($img_ex_lc, $allowed_exs)) {
				/** 
				 renaming the image name with 
				 with random string
				**/
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;

				# crating upload path on root directory
				$img_upload_path = "images/".$new_img_name;

				# move uploaded image to 'uploads' folder
				move_uploaded_file($tmp_name, $img_upload_path);

				# inserting imge name into database
                $sql = "UPDATE konfigurasi SET image_login='$img_upload_path' WHERE id_conf='1'";
                $query = $connect->query($sql);
                
                # response array
				$res = array('error' => 0, 'src'=> $img_upload_path);

                echo json_encode($res);
			    exit();

			}else {
				# error message
				$em = "You can't upload files of this type";

				# response array
				$error = array('error' => 1, 'em'=> $em);

				/** 
			    printing out php array and 
			    converting it into JSON format
			    **/

			    echo json_encode($error);
			    exit();
			}
		}
	}else {
		# error message
		$em = "unknown error occurred!";

		# response array
		$error = array('error' => 1, 'em'=> $em);

		/** 
	    printing out php array and 
	    converting it into JSON format
	    **/

	    echo json_encode($error);
	    exit();
	}
}