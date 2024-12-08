<?php
session_start();

$initials = '';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Extract the first character and convert it to uppercase
    $initials = strtoupper($email[0]);
}

$email = $_SESSION['email'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users1345";

// Create connection
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


// Update location if a new one is selected
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_location'])) {
    $new_location = $_POST['new_location'];
    $update_sql = "UPDATE users SET location = ? WHERE email = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ss", $new_location, $email);
    $stmt->execute();
    $stmt->close();
    // Refresh the page to apply the new location
    header("Location: foodpartner.php");
    exit();
}

// Fetch current user's food preferences and location
$sql = "SELECT ud.food_preferences, u.location FROM user_details ud 
        JOIN users u ON u.email = ud.email WHERE u.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($current_user_food_prefs, $current_user_location);
$stmt->fetch();
$stmt->close();

// Decode the current user's food preferences from JSON
$current_user_food_prefs = json_decode($current_user_food_prefs, true);

// Fetch matching profiles based on location and food preferences
$sql = "
    SELECT u.firstname, u.lastname, ud.date_of_birth, ud.profile_pic, ud.food_preferences, ud.designation, u.area
    FROM users u
    JOIN user_details ud ON u.email = ud.email
    WHERE u.email != ? AND u.location = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $current_user_location);
$stmt->execute();
$result = $stmt->get_result();

$profiles = [];
while ($row = $result->fetch_assoc()) {
    $user_food_prefs = json_decode($row['food_preferences'], true);

    // Find common food preferences
    $common_foods = array_intersect($current_user_food_prefs, $user_food_prefs);

    // Only include profiles with at least 2 common food preferences
    if (count($common_foods) > 1) {
        $profiles[] = $row;
    }
}

$stmt->close();
$conn->close();

// Set profile index if not set
if (!isset($_SESSION['profile_index'])) {
    $_SESSION['profile_index'] = 0;
} else if (isset($_GET['next'])) {
    $_SESSION['profile_index']++;
    if ($_SESSION['profile_index'] >= count($profiles)) {
        $_SESSION['profile_index'] = 0; // Loop back to the start
    }
}

$profile = $profiles[$_SESSION['profile_index']] ?? null;

// Function to calculate age
function calculateAge($dob)
{
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    $age = $birthDate->diff($today)->y;
    return $age;
}

if ($profile) {
    $firstname = $profile['firstname'];
    $lastname = $profile['lastname'];
    $designation = $profile['designation']; // Fetching designation from the database
    $date_of_birth = $profile['date_of_birth'];
    $profile_pic = $profile['profile_pic']; // Path to the profile picture
    $status = $profile['status']; // Fetching status from the database
    $age = calculateAge($date_of_birth);
    $area = $profile['area']; // Fetching area
    $email = $profile['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Partner</title>
    <link rel="stylesheet" href="foodpartnerc.css">
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

    <?php if ($profile): ?>
        <div class="profile">
            <!-- Display the profile picture -->
            <div class="profile-pic">
                <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
            </div>

            <div class="info">
                <h2><?php echo htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname); ?></h2>
                <p><?php echo htmlspecialchars($designation); ?></p> <!-- Displaying designation -->
                <p>Age: <?php echo $age; ?></p>
                <p>Location: <?php echo htmlspecialchars($area); ?></p>
                <div class="button">
                    <a href="set_date.php" class="b1">Set Date</a>
                    <a href="foodpartner.php?next=true" class="b2">Next</a>
                </div>
                <!-- Location Dropdown -->
                <div class="change_location">
                    <form method="POST" action="">
                        <label for="location">Change Location:</label>
                        <select name="new_location" id="location" onchange="this.form.submit()">
                            <option value="">Select District</option>
                            <option value="Bagerhat">Bagerhat</option>
                            <option value="Bandarban">Bandarban</option>
                            <option value="Barguna">Barguna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Bhola">Bhola</option>
                            <option value="Bogra">Bogra</option>
                            <option value="Brahmanbaria">Brahmanbaria</option>
                            <option value="Chandpur">Chandpur</option>
                            <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Chuadanga">Chuadanga</option>
                            <option value="Comilla">Comilla</option>
                            <option value="Cox's Bazar">Cox's Bazar</option>
                            <option value="Dinajpur">Dinajpur</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Faridpur">Faridpur</option>
                            <option value="Feni">Feni</option>
                            <option value="Gaibandha">Gaibandha</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Gopalganj">Gopalganj</option>
                            <option value="Habiganj">Habiganj</option>
                            <option value="Jamalpur">Jamalpur</option>
                            <option value="Jessore">Jessore</option>
                            <option value="Jhalokathi">Jhalokathi</option>
                            <option value="Jhenaidah">Jhenaidah</option>
                            <option value="Khagrachari">Khagrachari</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Kishoreganj">Kishoreganj</option>
                            <option value="Kurigram">Kurigram</option>
                            <option value="Kushtia">Kushtia</option>
                            <option value="Lakshmipur">Lakshmipur</option>
                            <option value="Lalmonirhat">Lalmonirhat</option>
                            <option value="Madaripur">Madaripur</option>
                            <option value="Magura">Magura</option>
                            <option value="Manikganj">Manikganj</option>
                            <option value="Meherpur">Meherpur</option>
                            <option value="Moulvibazar">Moulvibazar</option>
                            <option value="Munshiganj">Munshiganj</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Naogaon">Naogaon</option>
                            <option value="Narayanganj">Narayanganj</option>
                            <option value="Narsingdi">Narsingdi</option>
                            <option value="Natore">Natore</option>
                            <option value="Netrokona">Netrokona</option>
                            <option value="Nilphamari">Nilphamari</option>
                            <option value="Noakhali">Noakhali</option>
                            <option value="Pabna">Pabna</option>
                            <option value="Panchagarh">Panchagarh</option>
                            <option value="Patuakhali">Patuakhali</option>
                            <option value="Pirojpur">Pirojpur</option>
                            <option value="Rajbari">Rajbari</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangamati">Rangamati</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Satkhira">Satkhira</option>
                            <option value="Shariatpur">Shariatpur</option>
                            <option value="Sherpur">Sherpur</option>
                            <option value="Sirajganj">Sirajganj</option>
                            <option value="Sunamganj">Sunamganj</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Tangail">Tangail</option>
                            <option value="Thakurgaon">Thakurgaon</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>No matching profiles found!</p>
        <div class="change_location">
            <form method="POST" action="">
                <label for="location">Change Location:</label>
                <select name="new_location" id="location" onchange="this.form.submit()">
                    <option value="">Select District</option>
                    <option value="Bagerhat">Bagerhat</option>
                    <option value="Bandarban">Bandarban</option>
                    <option value="Barguna">Barguna</option>
                    <option value="Barisal">Barisal</option>
                    <option value="Bhola">Bhola</option>
                    <option value="Bogra">Bogra</option>
                    <option value="Brahmanbaria">Brahmanbaria</option>
                    <option value="Chandpur">Chandpur</option>
                    <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Chuadanga">Chuadanga</option>
                    <option value="Comilla">Comilla</option>
                    <option value="Cox's Bazar">Cox's Bazar</option>
                    <option value="Dinajpur">Dinajpur</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Faridpur">Faridpur</option>
                    <option value="Feni">Feni</option>
                    <option value="Gaibandha">Gaibandha</option>
                    <option value="Gazipur">Gazipur</option>
                    <option value="Gopalganj">Gopalganj</option>
                    <option value="Habiganj">Habiganj</option>
                    <option value="Jamalpur">Jamalpur</option>
                    <option value="Jessore">Jessore</option>
                    <option value="Jhalokathi">Jhalokathi</option>
                    <option value="Jhenaidah">Jhenaidah</option>
                    <option value="Khagrachari">Khagrachari</option>
                    <option value="Khulna">Khulna</option>
                    <option value="Kishoreganj">Kishoreganj</option>
                    <option value="Kurigram">Kurigram</option>
                    <option value="Kushtia">Kushtia</option>
                    <option value="Lakshmipur">Lakshmipur</option>
                    <option value="Lalmonirhat">Lalmonirhat</option>
                    <option value="Madaripur">Madaripur</option>
                    <option value="Magura">Magura</option>
                    <option value="Manikganj">Manikganj</option>
                    <option value="Meherpur">Meherpur</option>
                    <option value="Moulvibazar">Moulvibazar</option>
                    <option value="Munshiganj">Munshiganj</option>
                    <option value="Mymensingh">Mymensingh</option>
                    <option value="Naogaon">Naogaon</option>
                    <option value="Narayanganj">Narayanganj</option>
                    <option value="Narsingdi">Narsingdi</option>
                    <option value="Natore">Natore</option>
                    <option value="Netrokona">Netrokona</option>
                    <option value="Nilphamari">Nilphamari</option>
                    <option value="Noakhali">Noakhali</option>
                    <option value="Pabna">Pabna</option>
                    <option value="Panchagarh">Panchagarh</option>
                    <option value="Patuakhali">Patuakhali</option>
                    <option value="Pirojpur">Pirojpur</option>
                    <option value="Rajbari">Rajbari</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Rangamati">Rangamati</option>
                    <option value="Rangpur">Rangpur</option>
                    <option value="Satkhira">Satkhira</option>
                    <option value="Shariatpur">Shariatpur</option>
                    <option value="Sherpur">Sherpur</option>
                    <option value="Sirajganj">Sirajganj</option>
                    <option value="Sunamganj">Sunamganj</option>
                    <option value="Sylhet">Sylhet</option>
                    <option value="Tangail">Tangail</option>
                    <option value="Thakurgaon">Thakurgaon</option>
                </select>
            </form>
        </div>
    <?php endif; ?>

    <script src="home1.js"></script>
    <script src="home.js"></script>
</body>

</html>


// Query to fetch restaurants containing "pizza" in their menu_items column from search_mapping
$query = "SELECT restaurant_name, restu_logo,page_name FROM search_mappings WHERE location LIKE '%Gulshan%'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}