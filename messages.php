<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];

// Fetch latest messages for each conversation
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
        WHERE (m2.incoming_email_id = m1.incoming_email_id AND m2.outgoing_email_id = m1.outgoing_email_id) 
        OR (m2.incoming_email_id = m1.outgoing_email_id AND m2.outgoing_email_id = m1.incoming_email_id)
        GROUP BY (CASE 
            WHEN m2.incoming_email_id = ? THEN m2.outgoing_email_id 
            ELSE m2.incoming_email_id 
        END)
    )
    ORDER BY m1.msg_id DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $email, $email);
$stmt->execute();
$result = $stmt->get_result();
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
    <div class="container">
        <header>
            <h2>Messages</h2>
        </header>
        
        <div class="message-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()) : 
                    $contact_email = htmlspecialchars($row['contact_email']); // Escape for HTML
                    $last_message = htmlspecialchars($row['msg']); // Escape for HTML
                    $is_unread = ($row['read_status'] == 0 && $row['incoming_email_id'] == $email) ? 'unread' : '';
                ?>
                <a href="chat.php?contact=<?php echo urlencode($contact_email); ?>" class="conversation <?php echo $is_unread; ?>">
                    <div class="conversation-info">
                        <div class="contact"><?php echo $contact_email; ?></div>
                        <div class="last-message"><?php echo $last_message; ?></div>
                    </div>
                    <div class="message-status">
                        <?php if ($is_unread): ?>
                            <span class="unread-badge">New</span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-messages">No conversations available.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
