<?php

$dbhost = "localhost"; 
$dbuser = "root";     
$dbpass = "";    
$dbname = "homeworkdb";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

?>