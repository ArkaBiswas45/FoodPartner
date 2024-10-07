document.addEventListener('DOMContentLoaded', function() {
    const messageInput = document.getElementById('messageInput');
    const sendMessageButton = document.getElementById('sendMessage');
    const messageDisplay = document.getElementById('messageDisplay');
    
    // Function to send message
    function sendMessage() {
        let message = messageInput.value.trim();

        // Ensure the message is not empty
        if (message === "") {
            alert("Message cannot be empty");
            return;
        }

        // Get recipient email from PHP-generated script variable
        let incoming_email_id = window.incoming_email_id;

        // Ensure incoming_email_id is set
        if (!incoming_email_id) {
            alert("No recipient email found!");
            return;
        }

        // Send the AJAX request using Fetch API to store the message
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
                // Clear the message input field
                messageInput.value = "";

                // Fetch and display updated messages
                fetchMessages();
            } else {
                alert("Failed to send message: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while sending the message.");
        });
    }

    // Send message when 'Send' button is clicked
    sendMessageButton.addEventListener('click', function() {
        sendMessage();
    });

    // Send message when Enter key is pressed
    messageInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter' && !event.shiftKey) { // Check if Enter key is pressed (not Shift+Enter for new line)
            event.preventDefault(); // Prevent default Enter key behavior
            sendMessage();
        }
    });

    // Consolidated function to fetch new messages in real-time
    function fetchMessages() {
        let incoming_email_id = window.incoming_email_id;

        if (!incoming_email_id) {
            console.error("No recipient email found for real-time message fetch!");
            return;
        }

        // Send an AJAX request to fetch new messages from get_messages.php
        fetch('get_messages.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `incoming_email_id=${encodeURIComponent(incoming_email_id)}`
        })
        .then(response => response.text()) // get_messages.php returns HTML of the messages
        .then(data => {
            messageDisplay.innerHTML = data; // Update the chat window with new messages

            // Scroll to the latest message
            messageDisplay.scrollTop = messageDisplay.scrollHeight;
        })
        .catch(error => {
            console.error('Error fetching messages:', error);
        });
    }

    // Call fetchMessages at regular intervals (e.g., every 2 seconds)
    setInterval(fetchMessages, 2000);

    // Ensure chat window is scrolled to the latest message on page load
    messageDisplay.scrollTop = messageDisplay.scrollHeight;
});
