<?php
// db_connect.php

$host = "localhost";      // usually localhost for XAMPP
$user = "root";           // default MySQL username
$pass = "";               // default password for XAMPP is empty
$dbname = "wardrobe_db";   // database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    //die("Database Connection Failed: " . $conn->connect_error);
    
}

?>
