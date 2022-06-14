<?php 
$servername = "";               //here put your server name if you gonna use this project
$username = "";                //put username
$password = "";               //password
$dbname = "";                //database name

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
  die("connecction failed: " . $conn->connect_error);
}

?>

//I have removed my info for security reasons
