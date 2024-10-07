<?php
session_start();

if (isset($_SESSION['email']) && isset($_POST['incoming_email_id']) && isset($_POST['msg'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
    }

    // Get the logged-in user's email (sender)
    $outgoing_email_id = $_SESSION['email'];
    
    // Get the recipient's email (receiver) and the message content
    $incoming_email_id = mysqli_real_escape_string($conn, $_POST['incoming_email_id']);
    $message = mysqli_real_escape_string($conn, $_POST['msg']);

    // Insert the message into the database
    $sql = "INSERT INTO messages (incoming_email_id, outgoing_email_id, msg) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit();
    }

    $stmt->bind_param("sss", $incoming_email_id, $outgoing_email_id, $message);

    if ($stmt->execute()) {
        // On successful message insertion
        echo json_encode(["status" => "success", "message" => "Message sent successfully"]);
    } else {
        // If the message fails to insert
        echo json_encode(["status" => "error", "message" => "Failed to send message"]);
    }

    $stmt->close();
    $conn->close();
} else {
    // If required fields are not set
    echo json_encode(["status" => "error", "message" => "Invalid request, required fields missing"]);
}
?>
