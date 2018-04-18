<?php
$servername = "localhost";
$username = "pg216938";
$password = "ier0phie6phahT8ahpai";
$dbname = "pg216938";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>