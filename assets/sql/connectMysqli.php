<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cmm007";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//echo "Connected Successfuly";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

?>