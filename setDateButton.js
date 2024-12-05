document.getElementById('setDateButton').addEventListener('click', function () {
    // Get recipient email from PHP-generated script variable
    let incoming_email_id = window.incoming_email_id;

    // Ensure incoming_email_id is set
    if (!incoming_email_id) {
        alert("No recipient email found!");
        return;
    }

    const message = "Let's talk";

    // Send the message using an AJAX request
    fetch('store_message1.php', {  // Changed to 'store_message1.php'
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `incoming_email_id=${encodeURIComponent(incoming_email_id)}&msg=${encodeURIComponent(message)}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert("Message sent successfully!");
            } else {
                alert("Failed to send message: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
