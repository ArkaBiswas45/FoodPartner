<?php
$servername = "localhost";
$username = "root"; // Change this if your MySQL username is different
$password = "";     // Change this if your MySQL password is set
$dbname = "Users1345";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
