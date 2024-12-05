<?php
session_start();

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
// Query to get the top 10 most popular foods
$sql = "SELECT food_name, food_link, food_logo, popularity_count FROM popular_food ORDER BY popularity_count DESC LIMIT 10";
$result = $conn->query($sql);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Popular Food</title>
    <link rel="stylesheet" href="most_visited.css">
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
                        <li class="profile-dropdown">
                            <button class="profile-toggle">
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
    <table>
            <thead>
                <tr>
                    <th>Food Item</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php if (!empty($row['food_logo'])): ?>
                                    <img src="<?php echo htmlspecialchars($row['food_logo']); ?>" alt="<?php echo htmlspecialchars($row['food_name']); ?> Logo" width="50">
                                <?php else: ?>
                                    <img src="path/to/default/logo.png" alt="Default Logo" width="50"> <!-- Add a default logo path -->
                                <?php endif; ?>
                                <a href="<?php echo htmlspecialchars($row['food_link']); ?>"><?php echo htmlspecialchars($row['food_name']); ?></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td>No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>