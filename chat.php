<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$logged_in_user = $_SESSION['email'];

// Check if contact email is set in the URL
if (isset($_GET['contact'])) {
    $contact_email = filter_var($_GET['contact'], FILTER_SANITIZE_EMAIL);
} else {
    echo "No contact specified.";
    exit();
}

// Connect to the database
include 'db_connection.php';

// Fetch profile picture URL if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Corrected: Use the logged-in user's email to fetch the profile picture
    $stmt = $conn->prepare("SELECT profile_pic FROM user_details WHERE email = ?");
    $stmt->bind_param("s", $logged_in_user);  // Changed $email to $logged_in_user
    $stmt->execute();
    $stmt->bind_result($profilePicUrl);

    if (!$stmt->fetch() || empty($profilePicUrl)) {
        // If profile picture not found or empty, use default
        $profilePicUrl = 'assets/Images/default-profile.png';
    }
    $stmt->close();
}

// Fetch contact details from users and user_details tables
$contactQuery = "
    SELECT u.firstname, u.lastname, u.status, ud.profile_pic 
    FROM users u
    JOIN user_details ud ON u.email = ud.Email
    WHERE u.email = ?";
$stmt = $conn->prepare($contactQuery);
$stmt->bind_param('s', $contact_email);
$stmt->execute();
$result = $stmt->get_result();
$contactDetails = $result->fetch_assoc();
$stmt->close();

// Store the fetched details in variables
$firstname = $contactDetails['firstname'];
$lastname = $contactDetails['lastname'];
$status = $contactDetails['status'];
$profile_pic = $contactDetails['profile_pic'];

// If contact is not found
if (!$contactDetails) {
    echo "Contact details not found.";
    exit();
}

// Update the read status for messages from and to this contact
$updateQuery = "UPDATE messages SET read_status = 1 
                WHERE (incoming_email_id = ? AND outgoing_email_id = ?) 
                   OR (incoming_email_id = ? AND outgoing_email_id = ?) 
                AND read_status = 0";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param('ssss', $contact_email, $logged_in_user, $logged_in_user, $contact_email);
$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?php echo htmlspecialchars($contactDetails['firstname'] . ' ' . $contactDetails['lastname']); ?></title>
    <link rel="stylesheet" href="chat.css">
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

<div class="chat-container">
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
        <!-- <button id="closeChat" class="close-btn">&times;</button> -->
    </div>

    <div id="messageDisplay" class="message-display"></div>
    <div class="chat-footer">
        <input type="text" id="messageInput" placeholder="Type a message here...">
        <button id="sendMessage"><img src="assets/Images/send-icon.jpg" alt="Send"></button>
    </div>
</div>

<script>
    // Set global JavaScript variable for the recipient email
    window.incoming_email_id = "<?php echo htmlspecialchars($contact_email); ?>";

    document.addEventListener('DOMContentLoaded', function() {
        const messageInput = document.getElementById('messageInput');
        const sendMessageButton = document.getElementById('sendMessage');
        const messageDisplay = document.getElementById('messageDisplay');

        let autoScrollEnabled = true; // Track whether auto-scroll is enabled

        // Function to send message
        function sendMessage() {
            const message = messageInput.value.trim();
            if (message === "") {
                alert("Message cannot be empty");
                return;
            }

            const incoming_email_id = window.incoming_email_id;
            if (!incoming_email_id) {
                alert("No recipient email found!");
                return;
            }

            sendMessageButton.disabled = true; // Disable button
            // Send AJAX request to store_message.php
            fetch('store_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `incoming_email_id=${encodeURIComponent(incoming_email_id)}&msg=${encodeURIComponent(message)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    messageInput.value = ""; // Clear message input
                    fetchMessages(true); // Fetch updated messages and scroll to bottom
                } else {
                    alert("Failed to send message: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred while sending the message.");
            })
            .finally(() => {
                sendMessageButton.disabled = false; // Re-enable button
            });
        }

        // Send message when 'Send' button is clicked
        sendMessageButton.addEventListener('click', sendMessage);

        // Send message on Enter key press
        messageInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        });

        // Detect user scroll activity to disable auto-scroll when the user scrolls up
        messageDisplay.addEventListener('scroll', function() {
            // Check if the user is not at the bottom of the message display
            const isAtBottom = messageDisplay.scrollHeight - messageDisplay.scrollTop <= messageDisplay.clientHeight + 10; // with a margin
            autoScrollEnabled = isAtBottom;
        });

        // Fetch messages function
        function fetchMessages(forceScroll = false) {
            const incoming_email_id = window.incoming_email_id;
            if (!incoming_email_id) {
                console.error("No recipient email found for real-time message fetch!");
                return;
            }

            // Fetch messages from get_messages.php
            fetch('get_messages.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `incoming_email_id=${encodeURIComponent(incoming_email_id)}`
            })
            .then(response => response.text()) // get_messages.php returns HTML of the messages
            .then(data => {
                const isScrollAtBottom = messageDisplay.scrollHeight - messageDisplay.scrollTop <= messageDisplay.clientHeight + 10;

                messageDisplay.innerHTML = data; // Update chat window

                // Scroll to the latest message only if:
                // 1. The user is at the bottom of the chat before the update (isScrollAtBottom is true)
                // 2. The user just entered the chat (forceScroll is true)
                if (autoScrollEnabled || forceScroll) {
                    messageDisplay.scrollTop = messageDisplay.scrollHeight; // Scroll to latest message
                }
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
        }

        // Call fetchMessages initially to load messages on page load and force scroll
        fetchMessages(true); // Force scroll when entering chat

        // Fetch messages every 2 seconds (for real-time updates)
        setInterval(fetchMessages, 2000);
    });
</script>


</body>
</html>
