<?php 
$uploadDir = 'uploads/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
include_once '../config/db_connect.php'; 
$errMsg = ''; 
$valid = 1; 
if(isset($_POST['idptk']) || isset($_POST['judul']) || isset($_POST['files'])){ 
    // Get the submitted form data 
    $ptkid = $_POST['idptk']; 
    $judul = strip_tags($connect->real_escape_string($_POST['judul'])); 
    $filesArr = $_FILES["files"]; 
     
    if(empty($ptkid)){ 
        $valid = 0; 
        $errMsg .= '<br/>Please enter your name.'; 
    } 
     
    if(empty($judul)){ 
        $valid = 0; 
        $errMsg .= '<br/>Please enter your judul.'; 
    } 
     
    
     
    // Check whether submitted data is not empty 
    if($valid == 1){ 
        $uploadStatus = 1; 
        $fileNames = array_filter($filesArr['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr['name'] as $key=>$val){  
                // File upload path  
                $fileName = basename($filesArr['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    }else{  
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    }  
                }else{  
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                }  
            }  
        } 
         
        if($uploadStatus == 1){ 
            // Include the database config file 
            
             
            // Insert form data in the database 
            $uploadedFileStr = trim($uploadedFile, ','); 
			$sql1 = "INSERT INTO form_data(ptk_id,judul,file_names) VALUES('$ptkid', '$judul', '$uploadedFileStr')";
			$query1 = $connect->query($sql1);
			$aktivitas="Upload File ".$uploadedFileStr;
			$akt = strip_tags($connect->real_escape_string($aktivitas));
			$sql1 = "INSERT INTO log(ptk_id,activity) VALUES('$ptkid', '$akt')";
			$query1 = $connect->query($sql1);
			$query2 = $connect->query($sql2);
            //$insert = $db->query("INSERT INTO form_data (ptkid,judul,file_names) VALUES ('".$ptkid."', '".$judul."', '".$uploadedFileStr."')"); 
             
            if($query1){ 
                $response['status'] = 1; 
                $response['message'] = 'Dokumen berhasil di upload!'; 
            } 
        } 
    }else{ 
         $response['message'] = 'Please fill all the mandatory fields!'.$errMsg; 
    } 
} 
 
// Return response 
echo json_encode($response);