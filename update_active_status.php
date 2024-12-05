<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Get the incoming email and outgoing email from POST data
    $incoming_email_id = isset($_POST['incoming_email_id']) ? filter_var($_POST['incoming_email_id'], FILTER_SANITIZE_EMAIL) : null;
    $outgoing_email_id = isset($_POST['outgoing_email_id']) ? filter_var($_POST['outgoing_email_id'], FILTER_SANITIZE_EMAIL) : null;

    // Ensure both parameters are provided
    if (empty($incoming_email_id) || empty($outgoing_email_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
        exit;
    }

    // Update the accept_status to 0
    $updateQuery = "
        UPDATE messages 
        SET accept_status = 0 
        WHERE incoming_email_id = ? AND outgoing_email_id = ?
    ";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param('ss', $incoming_email_id, $outgoing_email_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'accept_status updated to 0 successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update accept_status: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
