<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the message ID and new accept status
    $msg_id = isset($_POST['msg_id']) ? intval($_POST['msg_id']) : null;
    $accept_status = isset($_POST['accept_status']) ? intval($_POST['accept_status']) : null;

    if (!$msg_id || $accept_status === null) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request parameters']);
        exit;
    }

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    // Update the accept_status in the messages table
    $stmt = $conn->prepare("UPDATE messages SET accept_status = ? WHERE msg_id = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
        $conn->close();
        exit;
    }

    $stmt->bind_param('ii', $accept_status, $msg_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Accept status updated']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update accept status: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
