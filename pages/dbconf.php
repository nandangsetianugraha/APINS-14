<?php
//DATABASE CONNECTION VARIABLES
include "../config/db_connect.php";

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

$tbl_prefix = ""; //***PLANNED FEATURE, LEAVE VALUE BLANK FOR NOW*** Prefix for all database tables
$tbl_members = $tbl_prefix."pengguna";
$tbl_attempts = $tbl_prefix."loginAttempts";
$tbl_logs = $tbl_prefix."log";
