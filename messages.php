<?php
session_start();
include 'count_unreadReq.php';

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


}

// Fetch the latest messages for each conversation where the logged-in user is involved
$query = "
    SELECT 
        m1.incoming_email_id, 
        m1.outgoing_email_id, 
        m1.msg, 
        m1.msg_id, 
        m1.read_status, 
        (CASE 
            WHEN m1.incoming_email_id = ? THEN m1.outgoing_email_id 
            ELSE m1.incoming_email_id 
        END) AS contact_email 
    FROM messages m1 
    WHERE m1.msg_id IN (
        SELECT MAX(m2.msg_id) 
        FROM messages m2 
        WHERE (m2.incoming_email_id = ? OR m2.outgoing_email_id = ?)
        GROUP BY (CASE 
            WHEN m2.incoming_email_id = ? THEN m2.outgoing_email_id 
            ELSE m2.incoming_email_id 
        END)
    ) 
    AND m1.accept_status = 1 -- Only include accepted messages
    ORDER BY m1.msg_id DESC
";


$stmt = $conn->prepare($query);
$stmt->bind_param('ssss', $email, $email, $email, $email);
$stmt->execute();
$result = $stmt->get_result();

// Fetch message requests
$requestsQuery = "
    SELECT 
        m1.incoming_email_id, 
        m1.outgoing_email_id, 
        m1.msg, 
        m1.msg_id, 
        m1.read_status, 
        (CASE 
            WHEN m1.incoming_email_id = ? THEN m1.outgoing_email_id 
            ELSE m1.incoming_email_id 
        END) AS contact_email 
    FROM messages m1
    WHERE m1.msg_id IN (
        SELECT MAX(m2.msg_id) 
        FROM messages m2 
        WHERE m2.accept_status = 0 
        AND m2.incoming_email_id = ? -- Pending requests for the logged-in user
        GROUP BY (CASE 
            WHEN m2.incoming_email_id = ? THEN m2.outgoing_email_id 
            ELSE m2.incoming_email_id 
        END)
    )
    ORDER BY m1.msg_id DESC
";
$requestsStmt = $conn->prepare($requestsQuery);
$requestsStmt->bind_param('sss', $email, $email, $email);
$requestsStmt->execute();
$requestsResult = $requestsStmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="messages.css">
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
                        <li>
                            <div class="msg">
                                <a href="messages.php">
                                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M50 100C77.6142 100 100 77.6142 100 50C100 22.3858 77.6142 0 50 0C22.3858 0 0 22.3858 0 50C0 77.6142 22.3858 100 50 100ZM27.1967 32.1967C28.6032 30.7902 30.5109 30 32.5 30H67.5C69.4891 30 71.3968 30.7902 72.8033 32.1967C74.2098 33.6032 75 35.5109 75 37.5V62.5C75 64.4891 74.2098 66.3968 72.8033 67.8033C71.3968 69.2098 69.4891 70 67.5 70H32.5C30.5109 70 28.6032 69.2098 27.1967 67.8033C25.7902 66.3968 25 64.4891 25 62.5V37.5C25 35.5109 25.7902 33.6032 27.1967 32.1967ZM51.775 49.7L66.475 35H33.525L48.225 49.7C48.4574 49.9343 48.7339 50.1203 49.0386 50.2472C49.3432 50.3741 49.67 50.4395 50 50.4395C50.33 50.4395 50.6568 50.3741 50.9614 50.2472C51.2661 50.1203 51.5426 49.9343 51.775 49.7ZM69.2678 64.2678C69.7366 63.7989 70 63.163 70 62.5V38.525L55.3 53.225C53.8937 54.6295 51.9875 55.4184 50 55.4184C48.0125 55.4184 46.1063 54.6295 44.7 53.225L30 38.525V62.5C30 63.163 30.2634 63.7989 30.7322 64.2678C31.2011 64.7366 31.837 65 32.5 65H67.5C68.163 65 68.7989 64.7366 69.2678 64.2678Z" fill="#1344bf"></path>
                                    </svg>
                                    <?php if ($totalUnreadMessages > 0): ?>
                                        <span class="badge"><?php echo $totalUnreadMessages; ?></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </li>


                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="separation"></div>
    </header>

    <div class="container">
        <header>
            <h2>Messages</h2>
        </header>

        <div class="message-list">
            <h2>Message List</h2>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()) :
                    $contact_email = $row['contact_email'];

                    // Join query to fetch full name from users and profile picture from user_details
                    $detailsQuery = "
                    SELECT u.firstname, u.lastname, ud.profile_pic 
                    FROM users u
                    JOIN user_details ud ON u.email = ud.email
                    WHERE u.email = ?";

                    $detailsStmt = $conn->prepare($detailsQuery);
                    $detailsStmt->bind_param('s', $contact_email);
                    $detailsStmt->execute();
                    $detailsResult = $detailsStmt->get_result();
                    $contact_details = ($detailsResult->num_rows > 0) ? $detailsResult->fetch_assoc() : null;

                    // Set full name and profile picture, use default if not found
                    $full_name = htmlspecialchars($contact_details['firstname']) . ' ' . htmlspecialchars($contact_details['lastname']);
                    $profilePic = !empty($contact_details['profile_pic']) ? htmlspecialchars($contact_details['profile_pic']) : 'assets/Images/default-profile.png';
                    $last_message = htmlspecialchars($row['msg']); // Escape for HTML
                    $is_unread = ($row['read_status'] == 0 && $row['incoming_email_id'] == $email) ? 'unread' : '';
                ?>
                    <a href="chat.php?contact=<?php echo urlencode($contact_email); ?>" class="conversation <?php echo $is_unread; ?>">

                        <div class="convo">
                            <div class="conversation-info">
                                <!-- Profile picture before the message -->
                                <img src="<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-img">
                                <div class="contact">
                                    <h3><?php echo $full_name; ?></h3>
                                </div>
                            </div>
                            <div class="last-message"><?php echo $last_message; ?></div>
                        </div>

                        <div class="message-status">
                            <?php if ($is_unread): ?>
                                <span class="unread-badge">New</span>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php
                    $detailsStmt->close();
                endwhile; ?>
            <?php else: ?>
                <div class="no-messages">No conversations available.</div>
            <?php endif; ?>
        </div>
        <div class="message-requests">
            <h2>Message Requests</h2>
            <?php if ($requestsResult->num_rows > 0): ?>
                <?php while ($row = $requestsResult->fetch_assoc()) :
                    $contact_email = $row['contact_email'];

                    // Fetch the full name and profile picture of the sender
                    $detailsQuery = "
            SELECT u.firstname, u.lastname, ud.profile_pic 
            FROM users u
            JOIN user_details ud ON u.email = ud.email
            WHERE u.email = ?";

                    $detailsStmt = $conn->prepare($detailsQuery);
                    $detailsStmt->bind_param('s', $contact_email);
                    $detailsStmt->execute();
                    $detailsResult = $detailsStmt->get_result();
                    $contact_details = ($detailsResult->num_rows > 0) ? $detailsResult->fetch_assoc() : null;

                    // Set full name and profile picture, use default if not found
                    $full_name = htmlspecialchars($contact_details['firstname']) . ' ' . htmlspecialchars($contact_details['lastname']);
                    $profilePic = !empty($contact_details['profile_pic']) ? htmlspecialchars($contact_details['profile_pic']) : 'assets/Images/default-profile.png';
                    $last_message = htmlspecialchars($row['msg']); // Escape for HTML
                ?>
                    <div class="conversation">
                        <div class="convo">
                            <div class="conversation-info">
                                <img src="<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-img">
                                <div class="contact">
                                    <h3><?php echo $full_name; ?></h3>
                                </div>
                            </div>
                            <div class="last-message"><?php echo $last_message; ?></div>
                        </div>
                        <div class="message-actions">
                            <button class="accept-button" data-msg-id="<?php echo $row['msg_id']; ?>">Accept</button>
                        </div>
                    </div>
                <?php
                    $detailsStmt->close();
                endwhile; ?>
            <?php else: ?>
                <div class="no-requests">No message requests available.</div>
            <?php endif; ?>
        </div>



    </div>
    <script src="handleAcceptButton.js"></script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>