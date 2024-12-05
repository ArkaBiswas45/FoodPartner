<?php
session_start();

// Include the database connection file
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "User not logged in!";
    exit();
}

$email = $_SESSION['email'];

// Check if a file was uploaded
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
    // Get the file details
    $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
    $fileName = $_FILES['profile_pic']['name'];
    $fileSize = $_FILES['profile_pic']['size'];
    $fileType = $_FILES['profile_pic']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Sanitize the file name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // Directory where the file should be uploaded
    $uploadFileDir = 'uploads/';
    $dest_path = $uploadFileDir . $newFileName;

    // Check if the file is an image
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // Move the file to the target directory
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            // Update the database with the new profile picture path
            $sql = "UPDATE user_details SET profile_pic = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the statement: " . $conn->error);
            }

            // Bind parameters and execute the query
            $stmt->bind_param("ss", $dest_path, $email);
            if ($stmt->execute()) {
                // Successfully updated profile picture in the database
                header("Location: profile.php"); // Redirect back to the profile page
                exit();
            } else {
                echo "Error updating profile picture in the database.";
            }
        } else {
            echo "There was an error moving the uploaded file.";
        }
    } else {
        echo "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
    }
} else {
    if (isset($_FILES['profile_pic'])) {
        echo "Error: " . $_FILES['profile_pic']['error'];
    } else {
        echo "No file uploaded.";
    }
}

$conn->close();
?>