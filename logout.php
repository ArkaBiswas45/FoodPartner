<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the logged-in user's email (assuming it's stored in the session)
    $email = $_SESSION['email'];

    // Update the user's status to 0 (logged out)
    $sql = "UPDATE users SET status = 0 WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->error) {
        // Return JSON response with error if the update fails
        header('Content-Type: application/json');
        echo json_encode(['loggedOut' => false, 'error' => 'Failed to update user status.']);
        exit;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to home1.php
    header("Location: home1.php");
    exit;
} else {
    // Return JSON response with error if not logged in
    header('Content-Type: application/json');
    echo json_encode(['loggedOut' => false, 'error' => 'User is not logged in.']);
    exit;
}
