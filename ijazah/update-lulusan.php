<?php 
$uploadDir = 'sd/'; 
$allowTypes = array('pdf', 'jpg', 'png', 'jpeg');
require_once '../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['ptkid'];
	$tanggalmutasi=$_POST['tanggalmutasi'];
	$alasan=strip_tags($connect->real_escape_string($_POST['alasan']));
	$sekolah_mutasi=strip_tags($connect->real_escape_string($_POST['sekolah_mutasi']));
	$nopes=strip_tags($connect->real_escape_string($_POST['nopes']));
	$noijazah=strip_tags($connect->real_escape_string($_POST['ijazah']));
	$filesArr = $_FILES["files"];
	$fileNames = array_filter($filesArr['name']);
	$uploadedFile = ''; 
	$jenisfile = '';
		$cekreg = $connect->query("select * from data_register where peserta_didik_id='$ids'")->num_rows;
		if($cekreg>0){
			if(!empty($fileNames)){
                foreach($filesArr['name'] as $key=>$val){  
                // File upload path  
                    $fileName = time().'_'.basename(strip_tags($connect->real_escape_string($filesArr['name'][$key]))); 
                    $targetFilePath = $uploadDir . $fileName;  
                        //$ukuran = $filesArr['size'][$key];
                        // Check whether file type is valid  
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                    if(in_array($fileType, $allowTypes)){  
                            // Upload file to server  
                        if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                            $uploadedFile .= $fileName.',';
                            $jenisfile .= $fileType.',';
                        }else{  
                            
                            $validator['messages'] = 'Sorry, there was an error uploading your file.'; 
                        }  
                    }else{  
                        
                        $validator['messages'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                    } 
                }
                $uploadedFileStr = trim($uploadedFile, ','); 
	            $jenisFileStr = trim($jenisfile, ',');
				$sql1 = "UPDATE data_register SET tgl_mutasi='$tanggalmutasi', alasan='$alasan', sekolah_mutasi='$sekolah_mutasi', nopes='$nopes', ijazah='$noijazah', file_ijazah='$uploadedFileStr' WHERE peserta_didik_id='$ids'";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Data Registrasi berhasil diperbaharui!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error yaaaaaaaa???";
				};
			}else{
				$sql1 = "UPDATE data_register SET tgl_mutasi='$tanggalmutasi', alasan='$alasan', sekolah_mutasi='$sekolah_mutasi', nopes='$nopes', ijazah='$noijazah' WHERE peserta_didik_id='$ids'";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Data Registrasi berhasil diperbaharui!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			}
		}else{
			if(!empty($fileNames)){
                foreach($filesArr['name'] as $key=>$val){  
                // File upload path  
                    $fileName = time().'_'.basename(strip_tags($connect->real_escape_string($filesArr['name'][$key]))); 
                    $targetFilePath = $uploadDir . $fileName;  
                        //$ukuran = $filesArr['size'][$key];
                        // Check whether file type is valid  
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                    if(in_array($fileType, $allowTypes)){  
                            // Upload file to server  
                        if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                            $uploadedFile .= $fileName.',';
                            $jenisfile .= $fileType.',';
                        }else{  
                            
                            $validator['messages'] = 'Sorry, there was an error uploading your file.'; 
                        }  
                    }else{  
                        
                        $validator['messages'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                    } 
                }
                $uploadedFileStr = trim($uploadedFile, ','); 
	            $jenisFileStr = trim($jenisfile, ',');
				$sql1 = "INSERT INTO data_register(peserta_didik_id,tgl_mutasi,alasan,sekolah_mutasi,nopes,ijazah,file_ijazah) VALUES('$ids','$tanggalmutasi','$alasan','$sekolah_mutasi','$nopes','$noijazah','$uploadedFileStr')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Data Lulusan berhasil dibuat!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error yassssss???";
				};
			}else{
				$sql1 = "INSERT INTO data_register(peserta_didik_id,tgl_mutasi,alasan,sekolah_mutasi,nopes,ijazah) VALUES('$ids','$tanggalmutasi','$alasan','$sekolah_mutasi','$nopes','$noijazah')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Data Lulusan berhasil dibuat!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error yadddddd???";
				};
			}
		}
	
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}