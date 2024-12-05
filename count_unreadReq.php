<?php
session_start();

$initials = '';
$profilePicUrl = 'assets/Images/default-profile.png'; // Default profile image

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Extract the first character of email and convert it to uppercase
    $initials = strtoupper($email[0]);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Count unread messages in the message list
    $unreadMessagesQuery = "
        SELECT COUNT(*) AS unread_count 
        FROM messages 
        WHERE read_status = 0 
        AND accept_status = 1 
        AND incoming_email_id = ?
    ";
    $unreadMessagesStmt = $conn->prepare($unreadMessagesQuery);
    $unreadMessagesStmt->bind_param('s', $email);
    $unreadMessagesStmt->execute();
    $unreadMessagesStmt->bind_result($unreadCount);
    $unreadMessagesStmt->fetch();
    $unreadMessagesStmt->close();

    $totalUnreadMessages += $unreadCount; // Add unread messages to total

    // Count message requests
    $messageRequestsQuery = "
        SELECT COUNT(*) AS request_count 
        FROM messages 
        WHERE accept_status = 0 
        AND incoming_email_id = ?
    ";
    $messageRequestsStmt = $conn->prepare($messageRequestsQuery);
    $messageRequestsStmt->bind_param('s', $email);
    $messageRequestsStmt->execute();
    $messageRequestsStmt->bind_result($requestCount);
    $messageRequestsStmt->fetch();
    $messageRequestsStmt->close();

    $totalUnreadMessages += $requestCount; // Add message requests to total
}