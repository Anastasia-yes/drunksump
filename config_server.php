<?php
$servername = "localhost";
$username = "drunksump";
$password = "zxcvasdfqwer1234Z";
$dbname = "drunksump";
$rootDir = "/";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>
