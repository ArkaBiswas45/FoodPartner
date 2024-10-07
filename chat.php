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
    <title>Chat with <?php echo htmlspecialchars($contact_email); ?></title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>

<div class="chat-container">
    <div id="messageDisplay" class="message-display"></div>
    <textarea id="messageInput" placeholder="Type your message here" rows="3"></textarea>
    <button id="sendMessage">Send</button>
</div>

<script>
    // Set global JavaScript variable for the recipient email
    window.incoming_email_id = "<?php echo htmlspecialchars($contact_email); ?>";

    document.addEventListener('DOMContentLoaded', function() {
        const messageInput = document.getElementById('messageInput');
        const sendMessageButton = document.getElementById('sendMessage');
        const messageDisplay = document.getElementById('messageDisplay');

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
                    fetchMessages(); // Fetch updated messages
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

        // Fetch messages function
        function fetchMessages() {
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
                messageDisplay.innerHTML = data; // Update chat window
                // Scroll to latest message
                messageDisplay.scrollTop = messageDisplay.scrollHeight; 
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
        }

        // Call fetchMessages initially to load messages on page load
        fetchMessages();

        // Fetch messages every 2 seconds (for real-time updates)
        setInterval(fetchMessages, 2000);
    });
</script>

</body>
</html>
