<?php
@ob_start();
@session_start();
ini_set('max_execution_time', '300');//480=8mins, 300=5mins


$localhost	="localhost";
$user		="root";
$password	=""; 
$database   ="clinical_db";
 
$conn	= mysqli_connect($localhost, $user, $password,$database) or die("couldn't connect to the server");



?> 