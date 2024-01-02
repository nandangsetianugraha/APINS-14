<?php      
session_start();
$level = $_SESSION['level'];
// Include database configuration file  
require_once '../../config/db_connect.php'; 
 
// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input'); 
$jsonObj = json_decode($jsonStr); 
 
if($jsonObj->request_type == 'addEvent'){ 
	if($level==11){
		$start = $jsonObj->start; 
		$end = $jsonObj->end; 
	 
		$event_data = $jsonObj->event_data; 
		$eventTitle = !empty($event_data[0])?$event_data[0]:'-'; 
		$eventDesc = !empty($event_data[1])?$event_data[1]:''; 
		$eventURL = !empty($event_data[2])?$event_data[2]:''; 
		 
		if(!empty($eventTitle)){ 
			// Insert event data into the database 
			$sqlQ = "INSERT INTO events (title,description,url,start,end) VALUES (?,?,?,?,?)"; 
			$stmt = $connect->prepare($sqlQ); 
			$stmt->bind_param("sssss", $eventTitle, $eventDesc, $eventURL, $start, $end); 
			$insert = $stmt->execute(); 
	 
			if($insert){ 
				$output = [ 
					'status' => 1 
				]; 
				echo json_encode($output); 
			}else{ 
				echo json_encode(['error' => 'Event Add request failed!']); 
			} 
		} 
	}else{
		echo json_encode(['error' => 'Hanya Admin yang bisa menginput kalendar']); 
	}
}elseif($jsonObj->request_type == 'deleteEvent'){ 
    $id = $jsonObj->event_id; 
	if($level==11){
		$sql = "DELETE FROM events WHERE id=$id"; 
		$delete = $connect->query($sql); 
		if($delete){ 
			$output = [ 
				'status' => 1 
			]; 
			echo json_encode($output); 
		}else{ 
			echo json_encode(['error' => 'Event Delete request failed!']); 
		} 
	}else{
		echo json_encode(['error' => 'Hanya Admin yang bisa menginput kalendar']); 
	}
}