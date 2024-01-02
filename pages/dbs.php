<?php 
include_once 'config/db_connect.php';

// Database settings 
define('DB_HOST', $host); 
define('DB_USERNAME', $username); 
define('DB_PASSWORD', $password); 
define('DB_NAME', $db_name); 
 
// Upload settings 
$uploadDir = 'uploads/'; 
$allowTypes = array('jpg','png','jpeg','gif'); 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
?>