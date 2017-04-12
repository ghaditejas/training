<?php
/*
  * Connection is established with the data base  
*/
$servername = "localhost";
$username = "root";
$password = "root";
$database="assignment_4";
$conn = mysqli_connect($servername,$username,$password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>