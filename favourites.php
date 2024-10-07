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

    // Fetch profile picture URL if the user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Prepare and execute query to get profile picture URL
        $stmt = $conn->prepare("SELECT profile_pic FROM user_details WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($profilePicUrl);

        if (!$stmt->fetch() || empty($profilePicUrl)) {
            // If profile picture not found or empty, use default
            $profilePicUrl = 'assets/Images/default-profile.png';
        }
        $stmt->close();
    }
/*
    // Handle search query
    if (isset($_GET['search'])) {
        $searchQuery = strtolower(trim($_GET['search']));

        // Query the search_mappings table
        $sql = "SELECT page_name FROM search_mappings WHERE search_term LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$searchQuery%"; // Use wildcard search pattern
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $stmt->bind_result($page_name);
        $stmt->fetch();
        $stmt->close();

        // Redirect to the corresponding page if found
        if (!empty($page_name)) {
            header("Location: " . $page_name);
            exit();
        } else {
            // Handle the case where no match is found
            echo "No matching page found for the search term.";
        }
    }
*/
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Partner</title>
    <link rel="stylesheet" href="favouritesc.css">
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

        <div class="section3">
            <div class="h1">
                <span>My Favourites</span>
                <span class="text"><a href="see-all">See all</a></span>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="assets/Images/KFC-2024-04-26 at 2.30.21 AM.png" alt="">
                    <div class="text"><a href="resturants/kfc.html">KFC-Dhanmondi</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/unicafe.jpeg" alt="">
                    <div class="text"><a href="uni-cafe">UniCafe-Wari</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/Pizzaburg.jpg" alt="">
                    <div class="text"><a href="PizzaBurg-wari">PizzaBurg-Wari</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/sultans_kacchi.jpg" alt="">
                    <div class="text"><a href="Sultan's-Dine">Sultan's-Dine-Dhanmondi</a></div>
                </div>
            </div>
        </div>

        <div class="separation"></div>

        <div class="section3">
            <div class="h1">
                <span>Save Later</span>
                <span class="text"><a href="see-all">See all</a></span>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="assets/Images/KFC-2024-04-26 at 2.30.21 AM.png" alt="">
                    <div class="text"><a href="KFC-Dhanmondi">KFC-Dhanmondi</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/unicafe.jpeg" alt="">
                    <div class="text"><a href="uni-cafe">UniCafe-Wari</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/Pizzaburg.jpg" alt="">
                    <div class="text"><a href="PizzaBurg-wari">PizzaBurg-Wari</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/sultans_kacchi.jpg" alt="">
                    <div class="text"><a href="Sultan's-Dine">Sultan's-Dine-Dhanmondi</a></div>
                </div>
            </div>
        </div>

        <div class="separation"></div>

    </main>
    <script src="home1.js"></script>
    <script src="home.js"></script>
</body>