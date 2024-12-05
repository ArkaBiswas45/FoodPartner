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

// Prepare SQL query to fetch user details
$sql = "SELECT u.firstname, u.lastname, ud.profile_pic, ud.designation, ud.date_of_birth, ud.food_preferences 
        FROM users u 
        JOIN user_details ud ON u.email = ud.email 
        WHERE u.email = ?";

// Prepare statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameters and execute the query
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $profile_pic = $row['profile_pic'];
    $designation = $row['designation'];
    $date_of_birth = $row['date_of_birth'];
    $food_preferences = $row['food_preferences'];

    // Calculate age
    $date_of_birth_obj = new DateTime($date_of_birth);
    $current_date = new DateTime();
    $age = $current_date->diff($date_of_birth_obj)->y;
} else {
    echo "User data not found!";
    exit();
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
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
                    <li><a href="login.html">Login</a></li>
                    <li><a href="signup1.html">Sign Up</a></li>
                    <!-- Profile Dropdown -->
                    <li class="profile-dropdown">
                        <a href="#" class="profile-toggle">
                            <img src="assets/Images/default-profile.png" alt="Profile" id="profileImage">
                            <span id="profileInitial"><?php echo $initials; ?></span>
                        </a>
                        <div class="profile-menu">
                            <a href="profile.html">Profile</a>
                            <a href="settings.html">Settings</a>
                            <a href="logout.html">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="separation"></div>
    </header>
    <div class="profile">
        <div class="profile-pic">
            <!-- Profile Picture -->
            <div class="img">
                <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" class="profile-image">
            </div>
            <!-- Button to trigger file input -->
            <div class="cbtn">
                <button type="button" onclick="triggerFileInput()">Change Picture</button>
            </div>
        </div>
        <div class="info">
            <h1><?php echo htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname); ?></h1>
            <p class="designation">
            <?php echo htmlspecialchars($designation); ?>
                <a href="edit_designation.php">Edit</a>
            </p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($date_of_birth); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
                <a href="edit_email.php">Edit</a>
            </p>
            <p><strong>Food Preferences:</strong> <?php echo htmlspecialchars($food_preferences); ?>
                <a href="edit_food_preferences.php">Edit</a>
            </p>
            <a href="change_password.php" class="change-password">Change Password</a>
        </div>
        <!-- Form to handle file upload -->
        <form id="uploadForm" action="upload_picture.php" method="post" enctype="multipart/form-data" style="display: none;">
            <input type="file" id="fileInput" name="profile_pic" accept="image/*" onchange="document.getElementById('uploadForm').submit();">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </form>
    </div>


    <script>
        function triggerFileInput() {
            document.getElementById('fileInput').click();
        }
    </script>
    <script src="home1.js"></script>
    <script src="home.js"></script>
</body>


</html>