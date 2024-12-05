<?php
session_start();

$initials = '';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Extract the first character and convert it to uppercase
    $initials = strtoupper($email[0]);
}

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
    
    // Check if the user has a profile picture
    if (!$stmt->fetch() || empty($profilePicUrl)) {
        // If profile picture not found or empty, use default
        $profilePicUrl = 'assets/Images/default-profile.png';
    }
    $stmt->close();
} else {
    // If not logged in, use default profile picture
    $profilePicUrl = 'assets/Images/default-profile.png';
}


// Fetch current user's food preferences
$sql = "SELECT food_preferences FROM user_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($current_user_food_prefs);
$stmt->fetch();
$stmt->close();

$current_user_food_prefs = json_decode($current_user_food_prefs, true);

// Fetch matching profiles and their status
$sql = "
    SELECT u.firstname, u.lastname, u.email, ud.date_of_birth, ud.profile_pic, ud.food_preferences, ud.designation, u.status
    FROM users u
    JOIN user_details ud ON u.email = ud.email
    WHERE u.email != ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$profiles = [];
while ($row = $result->fetch_assoc()) {
    $user_food_prefs = json_decode($row['food_preferences'], true);
    $common_foods = array_intersect($current_user_food_prefs, $user_food_prefs);

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

$profile = $profiles[$_SESSION['profile_index']];



// Function to calculate age
function calculateAge($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    $age = $birthDate->diff($today)->y;
    return $age;
}

$firstname = $profile['firstname'];
$lastname = $profile['lastname'];
$designation = $profile['designation']; // Fetching designation from the database
$date_of_birth = $profile['date_of_birth'];
$profile_pic = $profile['profile_pic']; // This variable holds the path to the profile picture
$status = $profile['status']; // Fetching status from the database
$age = calculateAge($date_of_birth);
$email = $profile['email'];
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

<div class="profile">
    <div class="profile-pic">
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
    </div>

    <div class="info">
        <h2>
            <?php echo htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname); ?>
            <?php if ($status == 1): ?>
                    <span class="status-indicator" style="display: inline-block; background-color: #27d727; width: 10px; height: 10px; border-radius: 50%; margin-left: 10px;"></span>
            <?php endif; ?>
        </h2>
        
        <p><?php echo htmlspecialchars($designation); ?></p>
        <p>Age: <?php echo $age; ?></p>
        <div class="button">
            <div class="msg b1">
                 <button id="setDateButton">Set Date</button>
            </div>

            <a href="foodpartner.php?next=true" class="b2">Next</a>
        </div>
    </div>
</div>

<!-- Chat Popup Structure-->
<div id="chatPopup" class="chat-popup">
    <div class="chat-header">
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile" class="profile-pic">
        <div class="profile-info">
            <div class="name" style="font-size:20px"><?php echo htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname); ?></div>
            <?php if ($status == 1): ?>
                <p id="onlineStatus" style="margin-top: 0px; color:#03C03C">Online</p>
            <?php else: ?>
                <p id="onlineStatus" style="margin-top: 0px; color: gray;">Offline</p>
            <?php endif; ?>
        </div>
        <button id="closeChat" class="close-btn">&times;</button>
    </div>
    <div class="chat-body">
        <div class="message-display" id="messageDisplay">
            <!-- Chat messages will appear here-->
        </div>
    </div>
    <div class="chat-footer">
        <input type="text" id="messageInput" placeholder="Type a message here...">
        <button id="sendMessage"><img src="assets/Images/send-icon.jpg" alt="Send"></button>
    </div>
</div> 

<!-- Adding the necessary PHP script to pass the incoming email ID -->
<script>
    var incoming_email_id = "<?php echo htmlspecialchars($email); ?>";
</script>

<!-- Include JS files -->
 <script src="setDateButton.js"></script>
<script src="chat-popup.js"></script>
<script src="send_msg.js"></script>
<script src="home1.js"></script>
<script src="home.js"></script>

</body>
</html>
