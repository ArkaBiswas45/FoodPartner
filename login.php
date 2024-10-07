<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Enter your database password here
$dbname = "Users1345";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true; // Set loggedin variable
            $_SESSION['firstname'] = $user['firstname']; // Optional
            $_SESSION['email'] = $user['email']; // Optional

            // Update status to 1 (logged in)
            $update_stmt = $conn->prepare("UPDATE users SET status = 1 WHERE email = ?");
            $update_stmt->bind_param("s", $email);
            $update_stmt->execute();
            $update_stmt->close();

            // Redirect to home page
            header("Location: home1.php");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password.";
        }
    } else {
        // Email not found
        echo "Email not found. Sign up first.";
    }

    $stmt->close();
}

$conn->close();
?>
