<?php 
$servername = "sql205.byetcluster.com";
$username = "epiz_29148775";
$password = "msingh8701";
$dbname = "epiz_29148775_splitwise";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
  die("connecction failed: " . $conn->connect_error);
}

?>