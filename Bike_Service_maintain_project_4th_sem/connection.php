<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Infinity_Service";
$conn = new mysqli($host, $username, $password, $dbname);
if($conn->connect_error)
{
    die("Error:".$conn->connect_error);
}
//echo 'Registration successful';
?>