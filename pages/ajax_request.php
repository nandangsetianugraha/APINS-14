<?php 
// Include and initialize DB class 
require_once 'DB.class.php'; 
$db = new DB(); 
 
// Retrieve JSON from POST body  
$jsonStr = file_get_contents('php://input');  
$jsonObj = json_decode($jsonStr);  
 
if($jsonObj->request_type == 'image_delete'){  
    $row_id = !empty($jsonObj->row_id)?$jsonObj->row_id:''; 
 
    // Fetch previous file name from database 
    $prevData = $db->get_image_row($row_id); 
    $file_name_prev = $prevData['file_name']; 
 
    $condition = array('id' => $row_id); 
    $delete = $db->delete_images($condition); 
    if($delete){ 
        // Remove physical file from the server 
        @unlink($uploadDir.$file_name_prev); 
         
        $output = array(  
            'status' => 1, 
            'msg' => 'Deleted!' 
        ); 
    }else{ 
        $output = array( 
            'status' => 0, 
            'msg' => 'Image deletion failed!' 
        ); 
    } 
 
    // Return response 
    echo json_encode($output);  
} 
?>