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

// Page name (you can dynamically set this based on the current page)
$page_name = basename($_SERVER['PHP_SELF'], ".php");

// Prepare SQL statement to update visit count only if the page exists in the database
$sql = "UPDATE visit_count SET visit_count = visit_count + 1 WHERE page_name = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare statement failed
if (!$stmt) {
    die("Prepare statement failed: " . $conn->error);  // Output the error message
}

// Bind the parameters
$stmt->bind_param("s", $page_name);

// Execute the statement
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);  // Output the execution error message if it fails
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();