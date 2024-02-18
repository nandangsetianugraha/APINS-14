<?php
	include_once("config/config.php");
	include_once("config/db_connect.php");
    session_start();
	session_destroy();
    header("location:./");
