<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "assignment_4_sample";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection failed: " . $e->getMessage();
    header("Location: error/db.php");
    exit();
}
