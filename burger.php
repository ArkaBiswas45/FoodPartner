<?php
// session_start();
 include 'track_food.php';
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
$query = "SELECT restaurant_name, restu_logo,page_name FROM search_mappings WHERE menu_items LIKE '%burger%'";

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
<header>
        <nav>
            <div class="logo">
                <img src="assets/Images/logo2.png" alt="img">
                <p>Food Partner</p>
            </div>
            <div class="nav1">
                <ul>
                    <li><a href="home1.php">Home</a></li>
                    <li><a href="resturants.php">Restaurants</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="favourites.php">Favourites</a></li>
                    <li><a href="foodpartner.php">Food Partner</a></li>
                </ul>
            </div>
            <div class="nav2">
                <ul>
                    <?php if (!isset($_SESSION['loggedin'])): ?>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="signup1.html">Sign Up</a></li>
                    <?php else: ?>

                        <!-- Profile Dropdown -->
                        
                    <li class="profile-dropdown">
                        <button class="profile-toggle">
                            <!-- Always display profile picture -->
                            <img src="<?php echo htmlspecialchars($profilePicUrl); ?>" alt="Profile Picture" class="profile-img">
                        </button>
                        <div class="profile-menu">
                            <a href="profile.php">Profile</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>


                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="separation"></div>
    </header>

    <main>
        <div class="result">
        <?php
        // Display query results under the header and separation part
        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Restaurants Offering Burgers</h1>";
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