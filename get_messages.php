<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once "db_connection.php"; // Updated to include db_connection.php

if (isset($_SESSION['email']) && isset($_POST['incoming_email_id'])) {
    $outgoing_email_id = $_SESSION['email'];
    $incoming_email_id = mysqli_real_escape_string($conn, $_POST['incoming_email_id']);
    
    // Query to fetch messages and profile pictures
    $sql = "SELECT m.*, u1.profile_pic AS outgoing_pic, u2.profile_pic AS incoming_pic 
            FROM messages m
            LEFT JOIN user_details u1 ON m.outgoing_email_id = u1.email
            LEFT JOIN user_details u2 ON m.incoming_email_id = u2.email
            WHERE 
            (m.outgoing_email_id = '{$outgoing_email_id}' AND m.incoming_email_id = '{$incoming_email_id}') 
            OR (m.outgoing_email_id = '{$incoming_email_id}' AND m.incoming_email_id = '{$outgoing_email_id}')
            ORDER BY m.msg_id ASC";
    
    $query = mysqli_query($conn, $sql);
    
    if (!$query) {
        die("Error executing query: " . mysqli_error($conn));
    }
    
    $output = "";
    
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $message = htmlspecialchars($row['msg']);
            $outgoing_pic = htmlspecialchars($row['outgoing_pic']);
            // $incoming_pic = htmlspecialchars($row['incoming_pic']);
            
            if ($row['outgoing_email_id'] === $outgoing_email_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $message . '</p>
                                </div>
                                <div class="profile-pic">
                                    <img src="' . $outgoing_pic . '" alt="Profile Picture">
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <div class="profile-pic">
                                    <img src="' . $outgoing_pic . '" alt="Profile Picture">
                                </div>
                                <div class="details">
                                    <p>' . $message . '</p>
                                </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available yet. Start the conversation!</div>';
    }
    
    echo $output;
} else {
    echo "Error: Missing parameters.";
}
?>
