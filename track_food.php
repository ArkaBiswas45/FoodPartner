<?php
session_start();

// Assuming you already have the database connection in place
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users1345";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the food name based on the current page (without .php)
$food_name = basename($_SERVER['PHP_SELF'], ".php");

// Prepare SQL statement to update popularity_count for the food_name
$sql = "UPDATE popular_food SET popularity_count = popularity_count + 1 WHERE food_name = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare statement failed
if (!$stmt) {
    die("Prepare statement failed: " . $conn->error);
}

// Bind the correct parameter ($food_name)
$stmt->bind_param("s", $food_name);

// Execute the statement and check if it succeeded
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);  // Output the execution error message if it fails
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>