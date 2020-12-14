<?php
$servername = "localhost";
$username = "root";
$password = "helloworld";
$dbname = "drunksump";

$rootDir = "/drunksump/";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "<script>var rootDir='".$rootDir."';</script>";
?>
