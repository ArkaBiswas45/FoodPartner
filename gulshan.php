<?php
// session_start();
 include 'nav.php';
 // Include tracking at the beginning

$initials = '';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $initials = strtoupper($email[0]);
}

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

// Fetch profile picture URL if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $stmt = $conn->prepare("SELECT profile_pic FROM user_details WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($profilePicUrl);

    if (!$stmt->fetch() || empty($profilePicUrl)) {
        $profilePicUrl = 'assets/Images/default-profile.png';
    }
    $stmt->close();
}

// Query to fetch restaurants containing "pizza" in their menu_items column from search_mapping
$query = "SELECT restaurant_name, restu_logo,page_name FROM search_mappings WHERE location LIKE '%Gulshan%'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burgers</title>
    <link rel="stylesheet" href="burger.css">
    
</head>
<body>


    <main>
        <div class="result">
        <?php
        // Display query results under the header and separation part
        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Reasturants in Gulshan Area</h1>";
            echo "<ul>";
            // Loop through and display each restaurant name with a link to its page
            while ($row = mysqli_fetch_assoc($result)) {
                $restaurant_name = htmlspecialchars($row['restaurant_name']);
                $page_name = htmlspecialchars($row['page_name']);
                $restu_logo = htmlspecialchars($row['restu_logo']); // Assuming the path of the logo

                echo "<li>";
                // Show the restaurant logo if available
                if (!empty($restu_logo)) {
                    echo "<img src='$restu_logo' alt='$restaurant_name Logo'>";
                }
                // Display restaurant name as a clickable link to the corresponding page
                echo "<a href='$page_name'>$restaurant_name</a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No restaurants found with burgers on the menu.</p>";
        }
        ?>
        </div>
    </main>
</body>
</html>