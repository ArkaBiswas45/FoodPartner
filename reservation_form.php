<?php
session_start();

// Retrieve the restaurant title from the URL (query parameter)
$restaurant_name = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'Unknown Restaurant';

// Store the referring page and title when the user first accesses the form page
if (!isset($_SESSION['referrer']) && isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['referrer'] = $_SERVER['HTTP_REFERER'];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $reservation_date = $_POST['reservation_date'] ?? null;
    $reservation_time = $_POST['reservation_time'] ?? null;
    $num_of_persons = $_POST['num_of_persons'] ?? null;
    $phone_number = $_POST['phone_number'] ?? null;
    $restaurant_name = $_POST['restaurant_name'] ?? null;

    // Validate inputs
    if (empty($reservation_date) || empty($reservation_time) || empty($num_of_persons) || empty($phone_number) || empty($restaurant_name)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Users1345";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO reservation (reservation_date, reservation_time, num_of_persons, phone_number, restaurant_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $reservation_date, $reservation_time, $num_of_persons, $phone_number, $restaurant_name);

        // Execute the statement
        if ($stmt->execute()) {
            // Show success message and redirect to the referring page
            $referrer = $_SESSION['referrer'] ?? 'index.php'; // Default to 'index.php' if no referrer is stored
            unset($_SESSION['referrer']); // Clear the referrer to avoid unnecessary redirects

            echo "<script>
                    alert('Reservation successfully saved! You\'ll be confirmed soon.');
                    window.location.href = '$referrer';
                  </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="reservation.css">
    <!-- <script>
        // Capture the title of the referring page
        document.addEventListener('DOMContentLoaded', function () {
            const referrerTitle = document.referrer ? document.referrer : 'Unknown Restaurant';
            document.getElementById('restaurant_name').value = referrerTitle;
        });
    </script> -->
</head>
<body>
    <h1>Make a Reservation at <?php echo $restaurant_name; ?></h1>
    <form method="POST" action="">
        <label for="reservation_date">Date:</label>
        <input type="date" id="reservation_date" name="reservation_date" required><br><br>

        <label for="reservation_time">Time:</label>
        <input type="time" id="reservation_time" name="reservation_time" required><br><br>

        <label for="num_of_persons">Number of Persons:</label>
        <input type="number" id="num_of_persons" name="num_of_persons" min="1" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <!-- Hidden input for restaurant name -->
        <input type="hidden" id="restaurant_name" name="restaurant_name" value="<?php echo $restaurant_name; ?>">

        <button type="submit">Submit</button>
    </form>
</body>
</html>
