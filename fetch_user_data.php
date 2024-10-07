<?php
session_start();

$response = array();

if (isset($_SESSION['firstname'])) {
    // User is logged in
    $response['loggedIn'] = true;
    $response['firstname'] = $_SESSION['firstname'];
    $response['email'] = $_SESSION['email']; // Optionally include email if needed
    // Example: You might fetch profile image URL from database or any other source
    // $response['profileImageUrl'] = 'path_to_profile_image'; // Set this if you have a profile image URL

    // For now, setting profileImageUrl as null since no specific data available
    $response['profileImageUrl'] = null;
} else {
    // User is not logged in
    $response['loggedIn'] = false;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
