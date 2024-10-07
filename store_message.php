<?php
session_start();

// Check if the request is an AJAX POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json'); // Ensure correct response type

    // Check if the user is logged in by checking the session
    if (isset($_SESSION['email'])) {
        $outgoing_email_id = $_SESSION['email'];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit;
    }

    // Get the incoming email and message from the POST data
    $incoming_email_id = isset($_POST['incoming_email_id']) ? filter_var($_POST['incoming_email_id'], FILTER_SANITIZE_EMAIL) : null;
    $msg = isset($_POST['msg']) ? filter_var($_POST['msg'], FILTER_SANITIZE_STRING) : null;

    // Check if required fields are provided
    if (empty($incoming_email_id) || empty($msg)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
        exit;
    }

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    // Prepare the SQL statement to insert the message
    $sql = "INSERT INTO messages (incoming_email_id, outgoing_email_id, msg) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }

    // Bind the parameters and execute the statement
    if ($stmt->bind_param("sss", $incoming_email_id, $outgoing_email_id, $msg) === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to bind parameters: ' . $stmt->error]);
        exit;
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message: ' . $stmt->error]);
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
